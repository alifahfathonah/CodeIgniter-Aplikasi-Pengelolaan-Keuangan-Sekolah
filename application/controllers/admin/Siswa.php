<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["data_siswa"] = $this->siswa_model->getAll();
        $this->load->view("admin/siswa/list", $data);
    }

    public function getSiswaByKelas()
    {
        $data["data_siswa"] = $this->siswa_model->getSiswaByKelas();
        $this->load->view("admin/siswa/list", $data);
    }

    public function import_siswa()
    {
        $this->load->view("admin/siswa/import_siswa");
    }

    public function add()
    {
        $siswa = $this->siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($siswa->rules());
        $post = $this->input->post();

        if ($validation->run()) {
            if ($siswa->ceknis($post["nis"]) == 0){
                $siswa->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');    
            }else{
                $this->session->set_flashdata('error', 'NIS sudah ada');
            }
            
        }

        redirect('admin/siswa');
    }

    public function edit($nis)
    {
        if (!isset($nis)) redirect('admin/siswa');
       
         $siswa = $this->siswa_model;
         $siswa->update($nis);
         $this->session->set_flashdata('success', 'Berhasil disimpan');

         redirect(site_url('admin/siswa'));
    }

   

    public function delete($nis=null)
    {
        if (!isset($nis)) show_404();
        
        if ($this->siswa_model->delete($nis)) {
            redirect(site_url('admin/siswa'));
        }
    }


    public function setBiayaSPP1()
    {
        
            $this->siswa_model->updateSPP();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        
        $this->load->view("admin/siswa/set_biaya_spp");
    }

    public function setBiayaSPP()
    {
         $siswa = $this->siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($siswa->rulesSetSPP());

        if ($validation->run()) {
            $this->siswa_model->updateSPP();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        
        // if ($this->siswa_model->updateSPP()) {
        //     $this->session->set_flashdata('success', 'Berhasil disimpan');
        // }
        
        $this->load->view("admin/siswa/set_biaya_spp");
    }

    public function setNaikKelas()
    {
         $siswa = $this->siswa_model;
       
            $this->siswa_model->naikKelas();
            $this->session->set_flashdata('success', 'Naik Kelas Berhasil');
        
       redirect(site_url('admin/siswa'));
    }



// file upload functionality
    public function upload() {
        $data = array();
         // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');

            // If file uploaded
            if(!empty($_FILES['fileURL']['name'])) { 
                // get file extension
                $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
                // array Count
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                $createArray = array('NIS', 'Nama_Siswa', 'Kelas', 'Nama_Kelas', 'Biaya_SPP');
                $makeArray = array('NIS' => 'NIS', 'Nama_Siswa' => 'Nama_Siswa', 'Kelas' => 'Kelas', 'Nama_Kelas' => 'Nama_Kelas','Biaya_SPP' => 'Biaya_SPP');
                $SheetDataKey = array();
                foreach ($allDataInSheet as $dataInSheet) {
                    foreach ($dataInSheet as $key => $value) {
                        if (in_array(trim($value), $createArray)) {
                            $value = preg_replace('/\s+/', '', $value);
                            $SheetDataKey[trim($value)] = $key;
                        } 
                    }
                }
                $dataDiff = array_diff_key($makeArray, $SheetDataKey);
                if (empty($dataDiff)) {
                    $flag = 1;
                }
                // match excel sheet column
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $addresses = array();
                        $NIS = $SheetDataKey['NIS'];
                        $nama_siswa = $SheetDataKey['Nama_Siswa'];
                        $kelas = $SheetDataKey['Kelas'];
                        $nama_kelas = $SheetDataKey['Nama_Kelas'];
                        $biaya_spp = $SheetDataKey['Biaya_SPP'];

                        
                        $NIS = filter_var(trim($allDataInSheet[$i][$NIS]), FILTER_SANITIZE_STRING);
                        $nama_siswa = filter_var(trim($allDataInSheet[$i][$nama_siswa]), FILTER_SANITIZE_STRING);
                        $kelas = filter_var(trim($allDataInSheet[$i][$kelas]), FILTER_SANITIZE_EMAIL);
                        $nama_kelas = filter_var(trim($allDataInSheet[$i][$nama_kelas]), FILTER_SANITIZE_STRING);
                        $biaya_spp = filter_var(trim($allDataInSheet[$i][$biaya_spp]), FILTER_SANITIZE_STRING);
                        $fetchData[] = array('NIS' => $NIS, 'nama_siswa' => $nama_siswa, 'kelas' => $kelas, 'nama_kelas' => $nama_kelas, 'biaya_spp' => $biaya_spp);
                    }
                    $data['data_siswa'] = $fetchData;
                    $this->siswa_model->setBatchImport($fetchData);
                    $this->siswa_model->importData();
                } else {
                    echo "Please import correct file, did not match excel sheet column";
                }
                $this->load->view('admin/siswa/hasil_import', $data);
            }            
        
    }
 
    // checkFileValidation
    public function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
        'text/comma-separated-values', 
        'application/octet-stream', 
        'application/vnd.ms-excel', 
        'application/x-csv', 
        'text/x-csv', 
        'text/csv', 
        'application/csv', 
        'application/excel', 
        'application/vnd.msexcel', 
        'text/plain', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }




}
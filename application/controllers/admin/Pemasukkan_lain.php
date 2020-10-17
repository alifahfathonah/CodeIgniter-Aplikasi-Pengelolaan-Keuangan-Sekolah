<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukkan_lain extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pemasukkan_lain_model");
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["pemasukkan_lain"] = $this->pemasukkan_lain_model->getAll();
        $data["kategori"] = $this->pemasukkan_lain_model->getKategori();
        $data["tahun"] = $this->pemasukkan_lain_model->getTahunPemasukkanLain();
        //$data["tahun"] = $this->pemasukkan_lain_model->getTahunByPemasukkanLain();

        $this->load->view("admin/pemasukkan_lain/list_pemasukkan_lain", $data);
    }

    public function getPemasukkanLainByKategoriBulanTahun()
    {
        $data["pemasukkan_lain"] = $this->pemasukkan_lain_model->getPemasukkanLainByKategoriBulanTahun();
        $data["kategori"] = $this->pemasukkan_lain_model->getKategori();
        $data["tahun"] = $this->pemasukkan_lain_model->getTahunPemasukkanLain();
        //$data["tahun"] = $this->pemasukkan_lain_model->getTahunByPemasukkanLain();

        $this->load->view("admin/pemasukkan_lain/list_pemasukkan_lain", $data);
    }

    public function list_kategori_pemasukkan_lain()
    {
        $data["kategori"] = $this->pemasukkan_lain_model->getKategori();
        $this->load->view("admin/pemasukkan_lain/list_kategori_pemasukkan_lain", $data);
    }

    public function add()
    {
        $data["kategori"] = $this->pemasukkan_lain_model->getKategori();
        $data["bulan"] = date('m');
        $data["tahun"] = date('Y');
        $data["tanggal"] = date('d/m/Y');
        
        $pemasukkan_lain = $this->pemasukkan_lain_model;
        $validation = $this->form_validation;
        $validation->set_rules($pemasukkan_lain->rulesPemasukkanLain());
         if ($validation->run()) {
            $pemasukkan_lain->savePemasukkanLain();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

         $this->load->view("admin/pemasukkan_lain/tambah_pemasukkan_lain", $data);
    }

    public function addKategori()
    {
        $pemasukkan_lain = $this->pemasukkan_lain_model;
        $validation = $this->form_validation;
        $validation->set_rules($pemasukkan_lain->rulesKategori());
        $post = $this->input->post();

        if ($validation->run()) {
            if ($pemasukkan_lain->cekKodePL($post["kode_kategori"]) == 0){
                $pemasukkan_lain->saveKategori();
                $this->session->set_flashdata('success', 'Berhasil disimpan');   
            }else{
                $this->session->set_flashdata('error', 'Kode Kategori sudah ada');

            }            
            $this->list_kategori_pemasukkan_lain();
        }
    }

    public function addPemasukkanLain()
    {
        $pemasukkan_lain = $this->pemasukkan_lain_model;
        $validation = $this->form_validation;
        $validation->set_rules($pemasukkan_lain->rulesPemasukkanLain());
        if ($validation->run()) {
            $pemasukkan_lain->savePemasukkanLain();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        redirect(site_url('admin/pemasukkan_lain'));

        
    }



    public function editKategori($id_kategori)
    {
        if (!isset($id_kategori)) redirect('admin/pemasukkan_lain/list_kategori_pemasukkan_lain');
        $post = $this->input->post();
        $pemasukkan_lain = $this->pemasukkan_lain_model;
        $kode_lama = $pemasukkan_lain->getKodeById($id_kategori);

        if($kode_lama->kode == $post["kode_kategori"]){
            $pemasukkan_lain->updateKategori($id_kategori);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pemasukkan_lain/list_kategori_pemasukkan_lain'));    
        }else{
            if($pemasukkan_lain->cekKodePL($post["kode_kategori"]) == 0){
              $pemasukkan_lain->updateKategori($id_kategori);
              $this->session->set_flashdata('success', 'Berhasil disimpan');
              redirect(site_url('admin/pemasukkan_lain/list_kategori_pemasukkan_lain'));  
            }else{
            $this->session->set_flashdata('error', 'Kode Kategori sudah ada');
            redirect(site_url('admin/pemasukkan_lain/list_kategori_pemasukkan_lain'));
            }

        }
    }

public function editPemasukkanLain($no)
{
    if (!isset($no)) redirect('admin/pemasukkan_lain');

    $pemasukkan_lain = $this->pemasukkan_lain_model;
    $pemasukkan_lain->updatePemasukkanLain($no);
    $this->session->set_flashdata('success', 'Berhasil disimpan');

    redirect(site_url('admin/pemasukkan_lain'));
}

    // public function delete($no=null)
    // {
    //     if (!isset($no)) show_404();

    //     if ($this->bayar_spp_model->delete($no)) {
    //         redirect(site_url('admin/bayar_spp'));

    //     }
    // }

public function deleteKategori($no=null)
{
    if (!isset($no)) show_404();

    if ($this->pemasukkan_lain_model->deleteKategori($no)) {
        redirect(site_url('admin/pemasukkan_lain/list_kategori_pemasukkan_lain'));

    }
}

public function deletePemasukkanLain($no=null)
{
    if (!isset($no)) show_404();
    if ($this->pemasukkan_lain_model->deletePemasukkanLain($no)) {
     redirect(site_url('admin/pemasukkan_lain/'));
 }
}


public function rekapPemasukkanLain(){
    $bulan = date('m');
    $tahun = date('Y');

    $pemasukkan_lain = $this->pemasukkan_lain_model;
    $data["bulan"] = $bulan;
    $data["tahun"] = $tahun;
    $data["tahun_pemasukkan_lain"] = $this->pemasukkan_lain_model->getTahunPemasukkanLain();
    $data["nominal_pemasukkan_lain"] = $pemasukkan_lain->getNominalPemasukkanLain($bulan,$tahun);
    $data["pemasukkan_lain_group"] = $pemasukkan_lain->getPemasukkanLainGroupByBulanTahun($bulan,$tahun);
    $data["list_pemasukkan_lain"] = $pemasukkan_lain->getListPemasukkanLainByBulanTahun($bulan,$tahun);
    $this->load->view("admin/pemasukkan_lain/rekapPemasukkanLain", $data);
}

public function rekapPemasukkanLainGo(){
    $post = $this->input->post();
    $bulan = $post["bulan"];
    $tahun = $post["tahun"];

    if((!isset($post["bulan"])) OR (!isset($post["tahun"]))) {
        redirect(site_url('admin/pemasukkan_lain/rekapPemasukkanLain'));
    }

    $pemasukkan_lain = $this->pemasukkan_lain_model;
    $data["bulan"] = $bulan;
    $data["tahun"] = $tahun;
    $data["tahun_pemasukkan_lain"] = $pemasukkan_lain->getTahunPemasukkanLain();
    $data["nominal_pemasukkan_lain"] = $pemasukkan_lain->getNominalPemasukkanLain($bulan,$tahun);
    $data["pemasukkan_lain_group"] = $pemasukkan_lain->getPemasukkanLainGroupByBulanTahun($bulan,$tahun);
    $data["list_pemasukkan_lain"] = $pemasukkan_lain->getListPemasukkanLainByBulanTahun($bulan,$tahun);
    $this->load->view("admin/pemasukkan_lain/rekapPemasukkanLain", $data);
}

    // public function konfirmasiBayarSpp()
    // {
    //     $bayar_spp = $this->bayar_spp_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($bayar_spp->rulesBayar());

    //     if ($validation->run()) {
    //         $bayar_spp->konfirmasiBayarSpp();
    //         $this->session->set_flashdata('success', 'Berhasil disimpan');
    //     } else {
    //         $this->session->set_flashdata('Error', 'Error');
    //     }
    //     $data["bayar_spp"] = $this->bayar_spp_model->getAll();
    //     $this->load->view("admin/bayar_spp/list_bayar_spp", $data);

    // }

    // function get_autocomplete(){
    //     if (isset($_GET['term'])) {
    //         $result = $this->bayar_spp_model->search_blog($_GET['term']);
    //         if (count($result) > 0) {
    //         foreach ($result as $row)
    //             $arr_result[] = array(
    //                 'label' => $row->nama_siswa,
    //                 'nomor'   => $row->NIS,
    //                 'kelas'   => $row->kelas,
    //                 'biaya'   => $row->biaya_spp,
    //             );
    //             echo json_encode($arr_result);
    //         }
    //     }
    // }



}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pengeluaran_model");
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["pengeluaran"] = $this->pengeluaran_model->getAll();
        $data["kategori"] = $this->pengeluaran_model->getKategori();
//        $data["tahun"] = $this->pengeluaran_model->getTahunPengeluaran();
        //$data["tahun"] = $this->pemasukkan_lain_model->getTahunByPemasukkanLain();

        $this->load->view("admin/pengeluaran/list_pengeluaran", $data);
    }

    public function getPengeluaranByKategoriBulanTahun()
    {
        $data["pengeluaran"] = $this->pengeluaran_model->getPengeluaranByKategoriBulanTahun();
        $data["kategori"] = $this->pengeluaran_model->getKategori();
        $data["tahun"] = $this->pengeluaran_model->getTahunPengeluaran();
        //$data["tahun"] = $this->pemasukkan_lain_model->getTahunByPemasukkanLain();

        $this->load->view("admin/pengeluaran/list_pengeluaran", $data);
    }


    public function list_kategori_pengeluaran()
     {
         $data["kategori"] = $this->pengeluaran_model->getKategori();
         $this->load->view("admin/pengeluaran/list_kategori_pengeluaran", $data);
     }

    public function addKategori()
    {
        $pengeluaran = $this->pengeluaran_model;
        $validation = $this->form_validation;
        $validation->set_rules($pengeluaran->rulesKategori());
        $post = $this->input->post();

        if ($validation->run()) {
            if ($pengeluaran->cekKodePL($post["kode_kategori"]) == 0){
                $pengeluaran->saveKategori();
                $this->session->set_flashdata('success', 'Berhasil disimpan');   
            }else{
                $this->session->set_flashdata('error', 'Kode Kategori sudah ada');
            }            
           redirect(site_url('admin/pengeluaran/list_kategori_pengeluaran'));
        }
    }

    public function addPengeluaran()
     {
         $pengeluaran = $this->pengeluaran_model;
         $validation = $this->form_validation;
         $validation->set_rules($pengeluaran->rulesPengeluaran());
         if ($validation->run()) {
             $pengeluaran->savePengeluaran();
                 $this->session->set_flashdata('success', 'Berhasil disimpan');
             }
          redirect(site_url('admin/pengeluaran'));
     }

    
    public function editKategori($id_kategori)
     {
        if (!isset($id_kategori)) redirect('admin/pengeluaran/list_kategori_pengeluaran');

        $post = $this->input->post();
        $pengeluaran = $this->pengeluaran_model;
        $kode_lama = $pengeluaran->getKodeById($id_kategori);

        if($kode_lama->kode == $post["kode_kategori"]){
            $pengeluaran->updateKategori($id_kategori);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/pengeluaran/list_kategori_pengeluaran'));   
        }else{
            if($pengeluaran->cekKodePL($post["kode_kategori"]) == 0){
              $pengeluaran->updateKategori($id_kategori);
              $this->session->set_flashdata('success', 'Berhasil disimpan');
              redirect(site_url('admin/pengeluaran/list_kategori_pengeluaran')); 
            }else{
            $this->session->set_flashdata('error', 'Kode Kategori sudah ada');
            redirect(site_url('admin/pengeluaran/list_kategori_pengeluaran'));
            }
        }
     }

    public function editPengeluaran($no)
     {
         if (!isset($no)) redirect('admin/pengeluaran');
       
         $pengeluaran = $this->pengeluaran_model;
         $pengeluaran->updatePengeluaran($no);
         $this->session->set_flashdata('success', 'Berhasil disimpan');

         redirect(site_url('admin/pengeluaran'));
     }

    public function deleteKategori($no)
     {
         if (!isset($no)) show_404();
        
         if ($this->pengeluaran_model->deleteKategori($no)) {
             redirect(site_url('admin/pengeluaran/list_kategori_pengeluaran'));
         }
     }

    public function deletePengeluaran($no=null)
     {
         if (!isset($no)) show_404();
         if ($this->pengeluaran_model->deletePengeluaran($no)) {
            redirect(site_url('admin/pengeluaran/'));
         }
     }

    public function rekapPengeluaran(){
        $bulan = date('m');
        $tahun = date('Y');
  
        $pengeluaran = $this->pengeluaran_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tahun_pengeluaran"] = $pengeluaran->getTahunPengeluaran();
        $data["nominal_pengeluaran"] = $pengeluaran->getNominalPengeluaran($bulan,$tahun);
        $data["pengeluaran_group"] = $pengeluaran->getPengeluaranGroupByBulanTahun($bulan,$tahun);
        $data["list_pengeluaran"] = $pengeluaran->getListPengeluaranByBulanTahun($bulan,$tahun);
        $this->load->view("admin/pengeluaran/rekapPengeluaran", $data);
    }

    public function rekapPengeluaranGo(){
        $post = $this->input->post();
        $bulan = $post["bulan"];
        $tahun = $post["tahun"];

        if((!isset($post["bulan"])) OR (!isset($post["tahun"]))) {
            redirect(site_url('admin/pengeluaran/rekapPengeluaran'));
        }

        $pengeluaran = $this->pengeluaran_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tahun_pengeluaran"] = $pengeluaran->getTahunPengeluaran();
        $data["nominal_pengeluaran"] = $pengeluaran->getNominalPengeluaran($bulan,$tahun);
        $data["pengeluaran_group"] = $pengeluaran->getPengeluaranGroupByBulanTahun($bulan,$tahun);
        $data["list_pengeluaran"] = $pengeluaran->getListPengeluaranByBulanTahun($bulan,$tahun);
        $this->load->view("admin/pengeluaran/rekapPengeluaran", $data);
    }


}
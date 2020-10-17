<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("daftar_ulang_model");
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["daftar_ulang"] = $this->daftar_ulang_model->getAll();
        $data["tahun_ajaran"] = $this->daftar_ulang_model->getTahunAjaran();
        $this->load->view("admin/daftar_ulang/list_daftar_ulang", $data);

    }

    public function listCicil()
    {
        $data["cicil"] = $this->daftar_ulang_model->getAllCicil();
        $data["tahun_ajaran"] = $this->daftar_ulang_model->getTahunAjaran();
        $this->load->view("admin/daftar_ulang/list_cicil", $data);

    }

    public function getDaftarUlangByKelasPeriodeTahun()
    {
        $data["daftar_ulang"] = $this->daftar_ulang_model->getDaftarUlangByKelasPeriodeTahun();
        $data["tahun_ajaran"] = $this->daftar_ulang_model->getTahunAjaran();
        $this->load->view("admin/daftar_ulang/list_daftar_ulang", $data);
    }

    public function getCicilByKelasPeriodeTahun()
    {
        $data["cicil"] = $this->daftar_ulang_model->getCicilByKelasPeriodeTahun();
        $data["tahun_ajaran"] = $this->daftar_ulang_model->getTahunAjaran();
        $this->load->view("admin/daftar_ulang/list_cicil", $data);
    }

    public function add()
        {
            $daftar_ulang = $this->daftar_ulang_model;
            $validation = $this->form_validation;
            $validation->set_rules($daftar_ulang->rules());
            if ($validation->run()) {
                if($daftar_ulang->cekNisTransaksi() == 0){
                    $this->session->set_flashdata('error', 'NIS tidak ditemukan');
                }else if($daftar_ulang->cekTransaksi() > 0){
                    $this->session->set_flashdata('error', 'Transaksi Sudah Tersedia');
                }else{
                    $daftar_ulang->save();
                    $this->session->set_flashdata('success', 'Berhasil disimpan');
                }
            }
            $this->load->view("admin/daftar_ulang/tambah_daftar_ulang");
        }

    public function addSatuKelas()
        {
            $daftar_ulang = $this->daftar_ulang_model;
            $validation = $this->form_validation;
            $validation->set_rules($daftar_ulang->rules1());
            if ($validation->run()) {
                $daftar_ulang->saveSatuKelas();
                    $this->session->set_flashdata('success', 'Berhasil disimpan');
                    redirect(site_url('admin/daftar_ulang'));
                }
            
            $this->load->view("admin/daftar_ulang/tambah_daftar_ulang_satu_kelas");
        }

    

    public function detail($no)
        {
            $daftar_ulang = $this->daftar_ulang_model;
            $daftar_ulang->updateTerbayar($no);
            if (!isset($no)) 
                redirect('admin/bayar_catering');
            $data["daftar_ulang_detail"] = $this->daftar_ulang_model->getByNoDaftarUlang($no);
            $data["cicil"] = $this->daftar_ulang_model->getCicilByNoDaftarUlang($no);
            if (!$data["daftar_ulang_detail"]) 
                show_404();
            $this->load->view("admin/daftar_ulang/detail_daftar_ulang", $data);
        }

    public function editCicil($no)
        {
            if (!isset($no)) redirect('admin/daftar_ulang');
            $daftar_ulang = $this->daftar_ulang_model;
            $daftar_ulang->updateCicil($no);
            
            $no_daftar_ulang = $this->daftar_ulang_model->getNoDaftarUlangByNoCicil($no);
            $this->detail($no_daftar_ulang->no_bayar_daftar_ulang);

            $this->session->set_flashdata('success', 'Berhasil disimpan');    
        }

    public function viewEditDaftarUlang($no)
        {
            $daftar_ulang = $this->daftar_ulang_model;
            if (!isset($no)) 
                redirect('admin/bayar_catering');
            $data["daftar_ulang_detail"] = $this->daftar_ulang_model->getByNoDaftarUlang($no);
            
            $this->load->view("admin/daftar_ulang/edit_daftar_ulang", $data);
        }

    public function editDaftarUlang($no)
        {
            if (!isset($no)) redirect('admin/daftar_ulang');
            $daftar_ulang = $this->daftar_ulang_model;
            
            $daftar_ulang->updateDaftarUlang($no);
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            
            $this->viewEditDaftarUlang($no);
        }


    public function delete($no=null)
        {
            if (!isset($no)) show_404();
                if ($this->daftar_ulang_model->delete($no)) {
                    redirect(site_url('admin/daftar_ulang'));
            }
        }

    public function addCicil($no)
        {
            $daftar_ulang = $this->daftar_ulang_model;
            $daftar_ulang->saveCicil();
            $this->session->set_flashdata('success', 'Pembayaran Berhasil disimpan');

            $daftar_ulang->updateTerbayar($no);

            $data["daftar_ulang_detail"] = $this->daftar_ulang_model->getByNoDaftarUlang($no);
            $data["cicil"] = $this->daftar_ulang_model->getCicilByNoDaftarUlang($no);
            if (!$data["daftar_ulang_detail"]) 
                show_404();
            
            redirect(site_url('admin/daftar_ulang/detail/'.$no));
            
        }

    public function delete_cicil($no)
        {
            $daftar_ulang = $this->daftar_ulang_model;
                if (!isset($no)) show_404();
                $no_daftar_ulang = $this->daftar_ulang_model->getNoDaftarUlangByNoCicil($no);

                if ($this->daftar_ulang_model->delete_cicil($no)) {
                    $daftar_ulang->updateTerbayar($no_daftar_ulang->no_bayar_daftar_ulang);
                    $this->session->set_flashdata('success', 'Berhasil dihapus');
                }
                redirect(site_url('admin/daftar_ulang/detail/'.$no_daftar_ulang->no_bayar_daftar_ulang));
            }

    public function rekapDaftarUlang(){
            
            $daftar_ulang = $this->daftar_ulang_model;
           
            $tahunAjaran = $daftar_ulang->getLastTahunAjaran();
            $data["tahunAjaran"] = $tahunAjaran;
            $data["tahun_ajaran"] = $daftar_ulang->getTahunAjaran();
      
           
            $data["tahunAjaran"] = $tahunAjaran->tahun_ajaran;
            $data["jumlah_lunas"] = count($daftar_ulang->getLunasByPeriodeTahun($tahunAjaran->tahun_ajaran));
            $data["jumlah_blmlunas"] = count($daftar_ulang->getBelumLunasByPeriodeTahun($tahunAjaran->tahun_ajaran));
            $data["siswa_lunas"] = $daftar_ulang->getLunasByPeriodeTahun($tahunAjaran->tahun_ajaran);
            $data["siswa_blmlunas"] = $daftar_ulang->getBelumLunasByPeriodeTahun($tahunAjaran->tahun_ajaran);
            $data["daftar_ulang_terbayar"] = $daftar_ulang->getDaftarUlangTerbayar($tahunAjaran->tahun_ajaran);
            $data["daftar_ulang_belum_terbayar"] = $daftar_ulang->getDaftarUlangBelumTerbayar($tahunAjaran->tahun_ajaran);
            $data["target_pembayaran"] = $daftar_ulang->getTotalPembayaran($tahunAjaran->tahun_ajaran);
            
            for($i=1;$i<=6;$i++){
                $data['listSiswaDaftarUlang'.$i] = $daftar_ulang->getListSiswaDaftarUlang($tahunAjaran->tahun_ajaran,$i);
            };

            $data["lapDaftarUlangByKelas"] = $daftar_ulang->getLapDaftarUlangByKelas($tahunAjaran->tahun_ajaran);

            $this->load->view("admin/daftar_ulang/rekapDaftarUlang", $data);
        }

    public function rekapDaftarUlangGo(){
        $post = $this->input->post();
        $tahunAjaran = $post["tahun_ajaran"];

        if((!isset($post["tahun_ajaran"]))) {
            redirect(site_url('admin/daftar_ulang/rekapDaftarUlang'));
        }

        $daftar_ulang = $this->daftar_ulang_model;
        
        $data["tahunAjaran"] = $tahunAjaran;   
        $data["tahun_ajaran"] = $daftar_ulang->getTahunAjaran();
        $data["jumlah_lunas"] = count($daftar_ulang->getLunasByPeriodeTahun($tahunAjaran));
        $data["jumlah_blmlunas"] = count($daftar_ulang->getBelumLunasByPeriodeTahun($tahunAjaran));
        $data["siswa_lunas"] = $daftar_ulang->getLunasByPeriodeTahun($tahunAjaran);
        $data["siswa_blmlunas"] = $daftar_ulang->getBelumLunasByPeriodeTahun($tahunAjaran);
        $data["daftar_ulang_terbayar"] = $daftar_ulang->getDaftarUlangTerbayar($tahunAjaran);
        $data["daftar_ulang_belum_terbayar"] = $daftar_ulang->getDaftarUlangBelumTerbayar($tahunAjaran);
        $data["target_pembayaran"] = $daftar_ulang->getTotalPembayaran($tahunAjaran);

        for($i=1;$i<=6;$i++){
                $data['listSiswaDaftarUlang'.$i] = $daftar_ulang->getListSiswaDaftarUlang($tahunAjaran,$i);
            };

        $data["lapDaftarUlangByKelas"] = $daftar_ulang->getLapDaftarUlangByKelas($tahunAjaran);

        $this->load->view("admin/daftar_ulang/rekapDaftarUlang", $data);
    }

    

}
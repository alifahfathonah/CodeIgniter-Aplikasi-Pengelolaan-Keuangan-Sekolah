<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_spp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("bayar_spp_model");
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["bayar_spp"] = $this->bayar_spp_model->getAll();
        $this->load->view("admin/bayar_spp/list_bayar_spp", $data);
    }

    public function getSppByNoBulanTahun()
    {
        $data["bayar_spp"] = $this->bayar_spp_model->getSppByNoBulanTahun();
        $this->load->view("admin/bayar_spp/list_bayar_spp", $data);
    }

    public function add()
    {
        $bayar_spp = $this->bayar_spp_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_spp->rulesBayar());
        if ($validation->run()) {
            if($bayar_spp->cekNisTransaksi() == 0){
                $this->session->set_flashdata('error', 'NIS tidak ditemukan');
            }else if($bayar_spp->cekTransaksi() > 0){
                $this->session->set_flashdata('error', 'Transaksi Sudah Tersedia');
            }else{
                $bayar_spp->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }            
        }
        $data["bulan"] = date('m');
        $data["tahun"] = date('Y');
        $data["tanggal"] = date('d/m/Y');

        $this->load->view("admin/bayar_spp/tambah_bayar_spp", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/bayar_spp');
       
        $bayar_spp = $this->bayar_spp_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_spp->rulesBayar());

        if ($validation->run()) {
            $bayar_spp->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["bayar_spp"] = $bayar_spp->getByNoSPP($no);
        if (!$data["bayar_spp"]) show_404();
        
        $this->load->view("admin/bayar_spp/edit_bayar_spp", $data);
    }

    public function delete($no=null)
    {
        if (!isset($no)) show_404();
        
        if ($this->bayar_spp_model->delete($no)) {
            redirect(site_url('admin/bayar_spp'));

        }
    }

    public function rekapSPP(){
        $bulan = date('m');
        $tahun = date('Y');
  
        $bayar_spp = $this->bayar_spp_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
        $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
        $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
        $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);


        $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
        $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
        $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
        $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);


        $this->load->view("admin/bayar_spp/rekap_spp", $data);
    }

    public function rekapSPPGo(){
        $post = $this->input->post();
        $bulan = $post["bulan"];
        $tahun = $post["tahun"];

        if((!isset($post["bulan"])) OR (!isset($post["tahun"]))) {
            redirect(site_url('admin/bayar_spp/rekapSPP'));
        }

        $bayar_spp = $this->bayar_spp_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
        $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
        $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
        $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);

        $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
        $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
        $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
        $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);

        
        $spp_terbayar = $bayar_spp->getSPPTerbayar($bulan,$tahun);
        $spp_belum_terbayar = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);
        $data["target_spp"] = 5000 ;
        $this->load->view("admin/bayar_spp/rekap_spp", $data);
    }


    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->bayar_spp_model->search_blog($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_siswa." (".$row->NIS.")",
                    'nomor'   => $row->NIS,
                    'kelas'   => $row->kelas.$row->nama_kelas,
                    'biaya'   => $row->biaya_spp,
                );
                echo json_encode($arr_result);
            }
        }
    }
    

}
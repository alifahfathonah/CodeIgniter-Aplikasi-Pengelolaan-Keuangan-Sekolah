<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_catering extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("bayar_catering_model");
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["bayar_catering"] = $this->bayar_catering_model->getAll();
        $this->load->view("admin/bayar_catering/list_bayar_catering", $data);
    }

    public function getCateringByNoBulanTahun()
    {
        $data["bayar_catering"] = $this->bayar_catering_model->getCateringByNoBulanTahun();
        $this->load->view("admin/bayar_catering/list_bayar_catering", $data);
    }

    public function add()
    {
        $bayar_catering = $this->bayar_catering_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_catering->rulesBayar());
        if ($validation->run()) {
            if($bayar_catering->cekNisTransaksi() == 0){
                $this->session->set_flashdata('error', 'NIS tidak ditemukan');
            }else if($bayar_catering->cekTransaksi() > 0){
                $this->session->set_flashdata('error', 'Transaksi Sudah Tersedia');
            }else{
                $bayar_catering->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }              
        }

        $data["bulan"] = date('m');
        $data["tahun"] = date('Y');
        $data["tanggal"] = date('d/m/Y');
        $data["biayaCatering"] = $bayar_catering->getTemporaryCatering() ;
        $this->load->view("admin/bayar_catering/tambah_bayar_catering", $data);
    }

    public function edit($no)
    {
        if (!isset($no)) redirect('admin/bayar_catering');
        $bayar_catering = $this->bayar_catering_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_catering->rulesBayar());
        if ($validation->run()) {
            $bayar_catering->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data["bayar_catering"] = $bayar_catering->getByNoCatering($no);
        if (!$data["bayar_catering"]) show_404();
        $this->load->view("admin/bayar_catering/edit_bayar_catering", $data);
    }

    public function delete($no=null)
    {
        if (!isset($no)) show_404();
        if ($this->bayar_catering_model->delete($no)) {
            redirect(site_url('admin/bayar_catering'));
        }
    }


    public function rekapCatering(){
        $bulan = date('m');
        $tahun = date('Y');
  
        $bayar_catering = $this->bayar_catering_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["jumlah_lunas"] = count($bayar_catering->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas"] = count($bayar_catering->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["siswa_lunas"] = $bayar_catering->getLunasByBulanTahun($bulan,$tahun);
        $data["siswa_blmlunas"] = $bayar_catering->getBelumLunasByBulanTahun($bulan,$tahun);
        $data["catering_terbayar"] = $bayar_catering->getCateringTerbayar($bulan,$tahun);
        $this->load->view("admin/bayar_catering/rekap_catering", $data);
    }

    public function rekapCateringGo(){
        $post = $this->input->post();
        $bulan = $post["bulan"];
        $tahun = $post["tahun"];

        if((!isset($post["bulan"])) OR (!isset($post["tahun"]))) {
            redirect(site_url('admin/bayar_catering/rekapCatering'));
        }

        $bayar_catering = $this->bayar_catering_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["jumlah_lunas"] = count($bayar_catering->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas"] = count($bayar_catering->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["siswa_lunas"] = $bayar_catering->getLunasByBulanTahun($bulan,$tahun);
        $data["siswa_blmlunas"] = $bayar_catering->getBelumLunasByBulanTahun($bulan,$tahun);
        $data["catering_terbayar"] = $bayar_catering->getCateringTerbayar($bulan,$tahun);
        // $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);
        $this->load->view("admin/bayar_catering/rekap_catering", $data);
    }



    public function konfirmasiBayarCatering()
    {       
        $bayar_catering = $this->bayar_catering_model;
        $validation = $this->form_validation;
        $validation->set_rules($bayar_catering->rulesBayar());
        if ($validation->run()) {
            $bayar_catering->konfirmasiBayarCatering();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }else {
            $this->session->set_flashdata('success', 'Error');
        }
        $data["bayar_catering"] = $this->bayar_catering_model->getAll();
        $this->load->view("admin/bayar_catering/list_bayar_catering", $data);
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->bayar_catering_model->search_blog($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_siswa." (".$row->NIS.")",
                    'nomor'   => $row->NIS,
                    'kelas'   => $row->kelas.$row->nama_kelas,
                );
                echo json_encode($arr_result);
            }
        }
    }

    

}
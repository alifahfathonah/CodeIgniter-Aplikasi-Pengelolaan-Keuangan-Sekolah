<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $this->load->view("admin/profile");
    }

    public function edit($no)
     {
        $post = $this->input->post();
         if (!isset($no)) show_404();
       
         $user_model = $this->user_model;
         $validation = $this->form_validation;
         $validation->set_rules($user_model->rules());

         if ($validation->run()) {
             if($post["password_baru"] == $post["password_baru_konfirm"]){
                $user_model->update($no);  
             }else{
                $this->session->set_flashdata('error', 'konfirmasi password baru tidak sama');
             }
         }
         redirect(site_url('admin/profile'));
     }

    // public function delete($no=null)
    // {
    //     if (!isset($no)) show_404();
        
    //     if ($this->bayar_spp_model->delete($no)) {
    //         redirect(site_url('admin/bayar_spp'));

    //     }
    // }

    // public function rekapSPP(){
    //     $bulan = date('m');
    //     $tahun = date('Y');
  
    //     $bayar_spp = $this->bayar_spp_model;
    //     $data["bulan"] = $bulan;
    //     $data["tahun"] = $tahun;
    //     $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
    //     $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
    //     $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
    //     $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
    //     $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);


    //     $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
    //     $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
    //     $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
    //     $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);


    //     $this->load->view("admin/bayar_spp/rekap_spp", $data);
    // }

    // public function rekapSPPGo(){
    //     $post = $this->input->post();
    //     $bulan = $post["bulan"];
    //     $tahun = $post["tahun"];

    //     $bayar_spp = $this->bayar_spp_model;
    //     $data["bulan"] = $bulan;
    //     $data["tahun"] = $tahun;
    //     $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
    //     $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
    //     $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
    //     $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
    //     $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);

    //     $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
    //     $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
    //     $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
    //     $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);

        
    //     $spp_terbayar = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $spp_belum_terbayar = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);
    //     $data["target_spp"] = 5000 ;
    //     $this->load->view("admin/bayar_spp/rekap_spp", $data);
    // }


    // function get_autocomplete(){
    //     if (isset($_GET['term'])) {
    //         $result = $this->bayar_spp_model->search_blog($_GET['term']);
    //         if (count($result) > 0) {
    //         foreach ($result as $row)
    //             $arr_result[] = array(
    //                 'label' => $row->nama_siswa." (".$row->NIS.")",
    //                 'nomor'   => $row->NIS,
    //                 'kelas'   => $row->kelas,
    //                 'biaya'   => $row->biaya_spp,
    //             );
    //             echo json_encode($arr_result);
    //         }
    //     }
    // }
    

}
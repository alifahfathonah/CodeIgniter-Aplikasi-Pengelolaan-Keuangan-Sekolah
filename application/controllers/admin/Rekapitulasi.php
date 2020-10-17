<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekapitulasi_model");
        $this->load->model("siswa_model");
        $this->load->model("bayar_catering_model");
        $this->load->model("bayar_spp_model");
        $this->load->model("daftar_ulang_model");
        $this->load->model("pemasukkan_lain_model");
        $this->load->model("pengeluaran_model");

        
        $this->load->library('form_validation');
        $this->load->helper('rupiah_helper');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
       
        $bulan = date('m');
        $tahun = date('Y');
        $tanggal = date('d F Y');
  
        $rekapitulasi = $this->rekapitulasi_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tanggal"] = $tanggal;
        $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        $data["spptotal"] = $rekapitulasi->biayaTotalSPP($bulan,$tahun);
        $data["sppkelas"] = $rekapitulasi->biayaSPPByKelas($bulan,$tahun);
        $data["catering"] = $rekapitulasi->biayaTotalCatering($bulan,$tahun);
        $data["daftar_ulang"] = $rekapitulasi->biayaTotalDaftarUlang($bulan,$tahun);
        $data["pemasukkan_lain"] = $rekapitulasi->biayaTotalPemasukkanLainByKategori($bulan,$tahun);
        $data["pengeluaran2"] = $rekapitulasi->biayaPengeluaranByKategori($bulan,$tahun);

        $data["tes2"] = array_merge($data["spptotal"], $data["sppkelas"], $data["daftar_ulang"], $data["pemasukkan_lain"], $data["catering"] );


        $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        $data["pengeluaran"] = $pengeluaran->total;
        $data["saldo"] = $data["pemasukkan"] - $data["pengeluaran"];
        $data["PerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/rekapitulasi/rekapBulanan", $data);
    }

    public function rekapBulananGo(){
        $post = $this->input->post();
        
        if((!isset($post["bulan"])) OR (!isset($post["tahun"]))) {
            redirect(site_url('admin/rekapitulasi'));
        }

        $bulan = $post["bulan"];
        $tahun = $post["tahun"];
        $tanggal = date('d F Y');

        $rekapitulasi = $this->rekapitulasi_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tanggal"] = $tanggal;
        $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        $data["spptotal"] = $rekapitulasi->biayaTotalSPP($bulan,$tahun);
        $data["sppkelas"] = $rekapitulasi->biayaSPPByKelas($bulan,$tahun);
        $data["catering"] = $rekapitulasi->biayaTotalCatering($bulan,$tahun);
        $data["daftar_ulang"] = $rekapitulasi->biayaTotalDaftarUlang($bulan,$tahun);
        $data["pemasukkan_lain"] = $rekapitulasi->biayaTotalPemasukkanLainByKategori($bulan,$tahun);
        $data["pengeluaran2"] = $rekapitulasi->biayaPengeluaranByKategori($bulan,$tahun);

        $data["tes2"] = array_merge($data["spptotal"], $data["sppkelas"], $data["daftar_ulang"], $data["pemasukkan_lain"], $data["catering"] );


        $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        $data["pengeluaran"] = $pengeluaran->total;
        $data["saldo"] = $data["pemasukkan"] - $data["pengeluaran"];
        $data["PerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/rekapitulasi/rekapBulanan", $data);
    }

    public function printRekapBulananExcel(){
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $tanggal = date('d F Y');

        $rekapitulasi = $this->rekapitulasi_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tanggal"] = $tanggal;
        $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        $data["spptotal"] = $rekapitulasi->biayaTotalSPP($bulan,$tahun);
        $data["sppkelas"] = $rekapitulasi->biayaSPPByKelas($bulan,$tahun);
        $data["catering"] = $rekapitulasi->biayaTotalCatering($bulan,$tahun);
        $data["daftar_ulang"] = $rekapitulasi->biayaTotalDaftarUlang($bulan,$tahun);
        $data["pemasukkan_lain"] = $rekapitulasi->biayaTotalPemasukkanLainByKategori($bulan,$tahun);
        $data["pengeluaran2"] = $rekapitulasi->biayaPengeluaranByKategori($bulan,$tahun);

        $data["tes2"] = array_merge($data["spptotal"], $data["sppkelas"], $data["daftar_ulang"], $data["pemasukkan_lain"], $data["catering"] );
        $data["title"] = "Pemasukkan Pengeluaran $bulan-$tahun ";


        $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        $data["pengeluaran"] = $pengeluaran->total;
        $data["saldo"] = $data["pemasukkan"] - $data["pengeluaran"];

        $data["pemasukkanPengeluaranPerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/rekapitulasi/printBulananExcel", $data);
    }

    public function printRekapBulananPertanggalExcel(){
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $tanggal = date('d F Y');

        $rekapitulasi = $this->rekapitulasi_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tanggal"] = $tanggal;
        $data["title"] = "List Pemasukkan Pengeluaran $bulan-$tahun ";

        $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        $data["pengeluaran"] = $pengeluaran->total;
        
        $data["PerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/rekapitulasi/printBulananPertanggalExcel", $data);
    }

    public function printRekapSPPExcel(){
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        $tanggal = date('d F Y');

        $rekapitulasi = $this->rekapitulasi_model;
        
        $bayar_spp = $this->bayar_spp_model;
        $data["tanggal"] = $tanggal;
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

        $data["title"] = "Rekap SPP $bulan-$tahun ";


        $this->load->view("admin/rekapitulasi/printSPPExcel", $data);
    }

    public function printRekapDaftarUlang(){
        
        $tahunAjaran1 = $this->uri->segment(4);
        $tahunAjaran2 = $this->uri->segment(5);
        $tahunAjaran = $tahunAjaran1."/".$tahunAjaran2;
        $tanggal = date('d F Y');
        $data["tanggal"] = $tanggal;

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
        $data["title"] = "Rekap Daftar Ulang $tahunAjaran ";

        $this->load->view("admin/rekapitulasi/printDaftarUlang", $data);
    }

    public function rekapTotal(){
        $bulan = date('m');
        $tahun = date('Y');
        $tanggal = date('d F Y');
  
        // $rekapitulasi = $this->rekapitulasi_model;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;
        $data["tanggal"] = $tanggal;
        // $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        // $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        // $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        // $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        // $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);

        // $data["spptotal"] = $rekapitulasi->biayaTotalSPP($bulan,$tahun);
        // $data["sppkelas"] = $rekapitulasi->biayaSPPByKelas($bulan,$tahun);
        // $data["catering"] = $rekapitulasi->biayaTotalCatering($bulan,$tahun);
        // $data["daftar_ulang"] = $rekapitulasi->biayaTotalDaftarUlang($bulan,$tahun);
        // $data["pemasukkan_lain"] = $rekapitulasi->biayaTotalPemasukkanLainByKategori($bulan,$tahun);
        // $data["pengeluaran2"] = $rekapitulasi->biayaPengeluaranByKategori($bulan,$tahun);

        // $data["tes2"] = array_merge($data["spptotal"], $data["sppkelas"], $data["daftar_ulang"], $data["pemasukkan_lain"], $data["catering"] );


        // $data["pemasukkan"] = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        // $data["pengeluaran"] = $pengeluaran->total;
        // $data["saldo"] = $data["pemasukkan"] - $data["pengeluaran"];
        // $data["PerTanggal"] =$rekapitulasi->listPengeluaranPemasukkanByBulan($bulan,$tahun);

        $this->load->view("admin/rekapitulasi/rekapTotal", $data);
    }

    


}
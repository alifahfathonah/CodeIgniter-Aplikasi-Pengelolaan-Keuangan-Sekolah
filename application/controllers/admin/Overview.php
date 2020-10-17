<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller 
{
    public function __construct()
    {
		parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("bayar_spp_model");
		$this->load->model("user_model");
		$this->load->model("bayar_catering_model");
		$this->load->model("daftar_ulang_model");
		$this->load->model("pemasukkan_lain_model");
		$this->load->model("pengeluaran_model");

        if($this->user_model->isNotLogin()) redirect(site_url('login'));
	}

	public function index()
	{	
		$bulan = date('m');
        $tahun = date('Y');

        $data["jumlah_blmlunas_SPP"] = count($this->bayar_spp_model->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas_Catering"] = count($this->bayar_catering_model->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas_du"] = count($this->daftar_ulang_model->getBelumLunasDaftarUlang());
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;

        $catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($bulan,$tahun);
        $spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($bulan,$tahun);
        $daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($bulan,$tahun);
        $pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($bulan,$tahun);
        $pengeluaran = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);
        $pemasukkan = $catering->total + $spp->total + $daftar_ulang->total + $pemasukkan_lain->total;
        $pengeluaran = $pengeluaran->total;



        $cateringAll = $this->bayar_catering_model->getAllCateringTerbayar();
        $sppAll = $this->bayar_spp_model->getAllSPPTerbayar($bulan,$tahun);
        $daftar_ulangAll = $this->daftar_ulang_model->getAllDaftarUlangTerbayar();
        $pemasukkan_lainAll = $this->pemasukkan_lain_model->getAllPemasukkanLain();
        $pengeluaranAll = $this->pengeluaran_model->getAllPengeluaran();
        $pemasukkanAll = $cateringAll->total + $sppAll->total + $daftar_ulangAll->total + $pemasukkan_lainAll->total;
        $pengeluaranAll = $pengeluaranAll->total;

        $data["saldo"] = $pemasukkanAll - $pengeluaranAll;
        //$data["saldo"] = 300;

        $data["nominal_pemasukkan_lain"] = $pemasukkan_lain;
        $data["pemasukkan_lain_group"] = $this->pemasukkan_lain_model->getPemasukkanLainGroupByBulanTahun($bulan,$tahun);
        $data["nominal_pengeluaran"] = $this->pengeluaran_model->getNominalPengeluaran($bulan,$tahun);
        $data["pengeluaran_group"] = $this->pengeluaran_model->getPengeluaranGroupByBulanTahun($bulan,$tahun);

        $data["jumlah_lunas_spp"] = count($this->bayar_spp_model->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas_spp"] = count($this->bayar_spp_model->getBelumLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_lunas_catering"] = count($this->bayar_catering_model->getLunasByBulanTahun($bulan,$tahun));
        $data["jumlah_blmlunas_catering"] = count($this->bayar_catering_model->getBelumLunasByBulanTahun($bulan,$tahun));


        $grafPengeluaran = array($pengeluaran);
        $grafPemasukkan = array($pemasukkan);

        $grafBulan = $bulan;
        $grafTahun = $tahun;
        
        $i = 1;
        while($i<=6){
            if($grafBulan != 1){
               $grafBulan = $grafBulan -1;

               $temp_catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($grafBulan,$grafTahun);
                $temp_pengeluaran_total = $this->pengeluaran_model->getNominalPengeluaran($grafBulan,$grafTahun);
                $temp_pemasukkan = $temp_catering->total + $temp_spp->total + $temp_daftar_ulang->total + $temp_pemasukkan_lain->total;
                $temp_pengeluaran = $temp_pengeluaran_total->total;
               

               array_push($grafPengeluaran, $temp_pengeluaran);
               array_push($grafPemasukkan, $temp_pemasukkan);
            } else {
               $grafBulan = 12;
               $grafTahun = $grafTahun -1;

               $temp_catering = $this->bayar_catering_model->getCateringTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_spp = $this->bayar_spp_model->getSPPTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_daftar_ulang = $this->daftar_ulang_model->getDaftarUlangTerbayarByTanggal($grafBulan,$grafTahun);
                $temp_pemasukkan_lain = $this->pemasukkan_lain_model->getNominalPemasukkanLain($grafBulan,$grafTahun);
                $temp_pengeluaran_total = $this->pengeluaran_model->getNominalPengeluaran($grafBulan,$grafTahun);
                $temp_pemasukkan = $temp_catering->total + $temp_spp->total + $temp_daftar_ulang->total + $temp_pemasukkan_lain->total;
                $temp_pengeluaran = $temp_pengeluaran_total->total;
               

               array_push($grafPengeluaran, $temp_pengeluaran);
               array_push($grafPemasukkan, $temp_pemasukkan);

            }
            $i++;
        }


        $grafPengeluaran = array_reverse($grafPengeluaran);
        $grafPemasukkan = array_reverse($grafPemasukkan);
        
        $data["grafPengeluaran"] = $grafPengeluaran;
        $data["grafPemasukkan"] = $grafPemasukkan;




        //$data["line_bulan"] = $this->dashboard_model->getLabelBulan($bulan,$tahun);
        $this->load->helper('bulan_helper'); 
        //bulan($bulan);
        $grafBulan = $bulan;
        $grafTahun = $tahun;
        $bulanTahun = bulan($grafBulan)." ".$grafTahun;
        $labelBulan = array($bulanTahun);

        $i = 1;
        while($i<=6){
        	if($grafBulan != 1){
        	   $grafBulan = $grafBulan -1;
        	   $bulanTahun = bulan($grafBulan)." ".$grafTahun;
        	   array_push($labelBulan, $bulanTahun);
        	} else {
        	   $grafBulan = 12;
               $grafTahun = $grafTahun-1;
               $bulanTahun = bulan($grafBulan)." ".$grafTahun;
               array_push($labelBulan, $bulanTahun);
        	}
        	$i++;
        }

        $labelBulan = array_reverse($labelBulan);
        
        $data["labelBulan"] = $labelBulan;
 





		$data['banyak_siswa'] = $this->dashboard_model->banyak_siswa();
        // load view admin/overview.php
        $this->load->view("admin/overview", $data);
	}
}
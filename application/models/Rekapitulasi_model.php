<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi_model extends CI_Model
{
    public $no_bayar_spp;
    public $nis;
    public $tanggal_bayar_spp;
    public $bulan_spp;
    public $tahun_spp;
    public $jumlah;
    public $status_spp;
    

    public function biayaTotalSPP($bulan,$tahun){
        $sql = "SELECT '20.2'as kode , CONCAT('SPP (', count(bayar_spp.NIS), ' siswa)') as uraian, '' as jumlah, SUM(bayar_spp.jumlah) as total FROM bayar_spp, data_siswa WHERE SUBSTRING(bayar_spp.tanggal_bayar_spp, -4) = $tahun AND SUBSTRING(bayar_spp.tanggal_bayar_spp, -7, 2) = $bulan AND data_siswa.NIS = bayar_spp.NIS";
        return $this->db->query($sql)->result();
    }

    public function biayaSPPByKelas($bulan,$tahun){
        $sql = "SELECT 'spp' as kode, CONCAT('SPP Kelas ', data_siswa.kelas,data_siswa.nama_kelas, ' (', count(bayar_spp.NIS), ' siswa)') as uraian, SUM(bayar_spp.jumlah) as jumlah, '' as total, CONCAT(data_siswa.kelas,data_siswa.nama_kelas) as kode_kelas FROM bayar_spp, data_siswa WHERE SUBSTRING(bayar_spp.tanggal_bayar_spp, -4) = $tahun AND SUBSTRING(bayar_spp.tanggal_bayar_spp, -7, 2) = $bulan AND data_siswa.NIS = bayar_spp.NIS GROUP BY data_siswa.kelas, data_siswa.nama_kelas ORDER BY data_siswa.kelas";
        return $this->db->query($sql)->result();   
    }

    public function biayaTotalCatering($bulan,$tahun){
        $sql = "SELECT  '24.6'as kode, CONCAT('Katering (', count(bayar_catering.NIS), ' siswa)') as uraian, '' as jumlah, SUM(bayar_catering.biaya_catering) as total FROM bayar_catering WHERE SUBSTRING(bayar_catering.tanggal_bayar_catering, -4) = $tahun AND SUBSTRING(bayar_catering.tanggal_bayar_catering, -7, 2) = $bulan";
        return $this->db->query($sql)->result();
    }

    public function biayaTotalDaftarUlang($bulan,$tahun){
        $sql = "SELECT '22.2' as kode, CONCAT('Daftar Ulang (', count(d.no_bayar_daftar_ulang), ' siswa)') as uraian, '' as jumlah, SUM(d.nominal) as total FROM cicil_daftar_ulang as d WHERE SUBSTRING(d.tanggal_bayar_daftarulang, -4) = $tahun AND SUBSTRING(d.tanggal_bayar_daftarulang, -7, 2) = $bulan";
        return $this->db->query($sql)->result();
    }

    public function biayaTotalPemasukkanLainByKategori($bulan,$tahun){
        $sql = "SELECT b.kode_pemasukkan_lain as kode, CONCAT(b.nama_kategori_pemasukkan_lain,' (', COUNT(a.id_kategori_pemasukkan_lain), ')') as uraian, '' as jumlah, SUM(a.nominal_pemasukkan_lain) as total FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan GROUP BY a.id_kategori_pemasukkan_lain ORDER BY b.kode_pemasukkan_lain";

        return $this->db->query($sql)->result();
    }


    public function biayaPengeluaranByKategori($bulan,$tahun){
        $sql = "SELECT b.kode_pengeluaran as kode, b.nama_kategori_pengeluaran as uraian, '' as jumlah, SUM(a.nominal_pengeluaran) as total FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan GROUP BY a.id_kategori_pengeluaran ORDER BY b.kode_pengeluaran";
        return $this->db->query($sql)->result(); 
    }

    public function listPengeluaranPemasukkanByBulan($bulan,$tahun){
        $sql = "
        SELECT '24.6' as kode, a.tanggal_bayar_catering as tanggal, CONCAT(b.nama_siswa, ' | Catering') as keterangan , a.biaya_catering as debet, '' as kredit, '' as ket
        FROM bayar_catering as a, data_siswa as b 
        WHERE a.NIS = b.NIS AND SUBSTRING(tanggal_bayar_catering, -4) = $tahun AND SUBSTRING(tanggal_bayar_catering, -7, 2) = $bulan
        UNION
        SELECT 'spp' as kode, a.tanggal_bayar_spp as tanggal, CONCAT(b.nama_siswa, ' | SPP') as keterangan , a.jumlah as debet, '' as kredit, CONCAT(b.kelas,b.nama_kelas) as ket
        FROM bayar_spp as a, data_siswa as b 
        WHERE a.NIS = b.NIS AND SUBSTRING(tanggal_bayar_spp, -4) = $tahun AND SUBSTRING(tanggal_bayar_spp, -7, 2) = $bulan
        UNION
        SELECT '22.2' as kode, a.tanggal_bayar_daftarulang as tanggal, CONCAT(c.nama_siswa, ' | DU ') as keterangan , a.nominal as debet, '' as kredit, '' as ket
        FROM cicil_daftar_ulang as a, daftar_ulang as b, data_siswa as c 
        WHERE a.no_bayar_daftar_ulang = b.no_bayar_daftar_ulang AND b.NIS = c.NIS AND SUBSTRING(a.tanggal_bayar_daftarulang, -4) = $tahun AND SUBSTRING(a.tanggal_bayar_daftarulang, -7, 2) = $bulan
        UNION
        SELECT b.kode_pemasukkan_lain as kode, a.tanggal_pemasukkan_lain as tanggal, CONCAT(a.keterangan_pemasukkan_lain, ' | ', b.nama_kategori_pemasukkan_lain ) as keterangan , a.nominal_pemasukkan_lain as debet, '' as kredit, '' as ket
        FROM pemasukkan_lain a, kategori_pemasukkan_lain b
        WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan
        UNION
        SELECT b.kode_pengeluaran as kode, a.tanggal_pengeluaran as tanggal, CONCAT(a.keterangan_pengeluaran, ' | ', b.nama_kategori_pengeluaran ) as keterangan , '' as debet, a.nominal_pengeluaran as kredit, '' as ket
        FROM pengeluaran a, kategori_pengeluaran b
        WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan
        ORDER BY SUBSTRING(tanggal, -10, 2) ASC
        ";
        return $this->db->query($sql)->result(); 
    }







}
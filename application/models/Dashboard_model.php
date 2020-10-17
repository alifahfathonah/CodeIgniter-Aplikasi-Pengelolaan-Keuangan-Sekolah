<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    private $_table = "data_siswa";

    public $nis;
    public $nama_siswa;
    public $tahun_masuk;
    public $kelas;
    

    public function banyak_siswa()
    {
    	$sql = "SELECT * FROM data_siswa WHERE data_siswa.kelas != 99";
        return $this->db->query($sql)->num_rows();

    }

    public function getLabelBulan($bulan,$tahun)
    {
        
    }
    
   
}
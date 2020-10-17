<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang_model extends CI_Model
{
    private $_table = "daftar_ulang";
    private $tabel_SPP = "bayar_spp";
    public $no_bayar_daftar_ulang;
    public $nis;
    public $tahun_ajaran;
    public $spp;
    public $seragam;
    public $kegiatan_siswa;
    public $spi;
    public $pembukaan_rek;
    public $jumlah;
    public $terbayar;
    public $status;
    
    public function rules()
    {
        return [
             ['field' => 'nis',
            'label' => 'NIS',
            'rules' => 'required']

        ];
    }

    public function rules1()
    {
        return [
             ['field' => 'kelas',
            'label' => 'Kelas',
            'rules' => 'required']

        ];
    }

    // public function rulesBayar()
    // {
    //     return [            
    //         ['field' => 'tanggal_bayar_spp',
    //         'label' => 'Tanggal_bayar_spp',
    //         'rules' => 'required']
    //     ];
    // }

    //     public function rulesBayar2()
    // {
    //     return [            
    //         ['field' => 'status_spp',
    //         'label' => 'Status_spp',
    //         'rules' => 'required|numeric']
    //     ];
    // }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama,s.kelas, d.* FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS ORDER BY d.tahun_ajaran DESC, s.kelas ASC, d.NIS ASC";

        return $this->db->query($sql)->result();
    }

    public function getAllCicil()
    {
        //return $this->db->get($this->_table)->result();
        $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, d.*, c.*");
        $this->db->where("d.NIS", "s.NIS", FALSE);
        $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
        $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');
        return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
    }


    public function getDaftarUlangByKelasPeriodeTahun()
    {
        $post = $this->input->post();
        $kelas = $post["kelas"];
        $nama_kelas = $post["nama_kelas"];
        $tahun = $post["tahun_ajaran"];
        $status = $post["status_daftar_ulang"];
         
        if(($kelas == 0) and ($nama_kelas == "") and ($tahun == 0) and ($status == "")){
            //0000
            redirect(site_url('admin/daftar_ulang'));   
        }else if(($kelas == 0) and ($nama_kelas == "") and ($tahun == 0) and ($status != "")){
            //0001
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');            
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas == "") and ($tahun != 0) and ($status == "")){
            //0010
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas == "") and ($tahun != 0) and ($status != "")){
            //0011
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->where("b.status", $status, FALSE);     
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');        
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun == 0) and ($status == "")){
            //0100
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);   
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');          
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun == 0) and ($status != "")){
            //0101
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->where("b.status", $status, FALSE);          
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');   
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun != 0) and ($status == "")){
            //0110
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);  
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');           
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun != 0) and ($status != "")){
            //0111
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun == 0) and ($status == "")){
            //1000
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun == 0) and ($status != "")){
            //1001
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);             
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun != 0) and ($status == "")){
            //1010
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);             
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun != 0) and ($status != "")){
            //1011
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun == 0) and ($status == "")){
            //1100
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun == 0) and ($status != "")){
            //1101
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun != 0) and ($status == "")){
            //1110
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun != 0) and ($status != "")){
            //1111
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun, FALSE);
            $this->db->where("b.status", $status, FALSE);
            $this->db->order_by('b.tahun_ajaran DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC');
            return $this->db->get("daftar_ulang as b, data_siswa as s")->result();
        }

    }


    public function getCicilByKelasPeriodeTahun()
    {
        $post = $this->input->post();
        $kelas = $post["kelas"];
        $nama_kelas = $post["nama_kelas"];
        $tahun = $post["tahun_ajaran"];
         
        if(($kelas == 0) and ($nama_kelas == "") and ($tahun == "")){
            //000
            redirect(site_url('admin/daftar_ulang/listCicil'));
        }else if(($kelas == 0) and ($nama_kelas == "") and ($tahun != "")){
            //001
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.* ");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->like("d.tahun_ajaran", $tahun, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');   
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun == "")){
            //010
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');            
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas == 0) and ($nama_kelas != "") and ($tahun != "")){
            //011
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->like("d.tahun_ajaran", $tahun, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');            
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun == "")){
            //100
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas == "") and ($tahun != "")){
            //101
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);             
            $this->db->like("d.tahun_ajaran", $tahun, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun == "")){
            //110
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }else if(($kelas != 0) and ($nama_kelas != "") and ($tahun != "")){
            //111
            $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, d.*, c.*");
            $this->db->where("d.NIS", "s.NIS", FALSE);
            $this->db->where("c.no_bayar_daftar_ulang", "d.no_bayar_daftar_ulang", FALSE);
            $this->db->where("s.kelas", $kelas, FALSE);
            $this->db->like("d.tahun_ajaran", $tahun, FALSE);
            $this->db->like("s.nama_kelas", $nama_kelas, FALSE);
            $this->db->order_by('SUBSTRING(tanggal_bayar_daftarulang, -4) DESC, SUBSTRING(tanggal_bayar_daftarulang, -7, 2) DESC, SUBSTRING(tanggal_bayar_daftarulang, -10, 2) DESC');
            return $this->db->get("cicil_daftar_ulang as c, daftar_ulang as d, data_siswa as s")->result();
        }
    }
    
    public function getByNoDaftarUlang($no)
        {
            $this->db->select("s.nama_siswa, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, s.kelas, b.*");
            $this->db->where("b.NIS", "s.NIS", FALSE);
            $this->db->where("b.no_bayar_daftar_ulang", $no, FALSE);
            return $this->db->get("daftar_ulang as b, data_siswa as s")->row();
        }

    public function getCicilByNoDaftarUlang($no)
        {
            $this->db->select("*");
            $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
            return $this->db->get("cicil_daftar_ulang")->result();
        }

    public function getNoDaftarUlangByNoCicil($no)
        {
            $this->db->select("no_bayar_daftar_ulang");
            $this->db->where("no_cicil_daftar_ulang", $no, FALSE);
            return $this->db->get("cicil_daftar_ulang")->row();
        }

    public function getTahunAjaran()
        {
            $this->db->distinct();
            $this->db->select("tahun_ajaran");
            $this->db->order_by("tahun_ajaran", "desc");
            return $this->db->get("daftar_ulang")->result();
        }

    public function save()
    {
        $cekTable = $this->db->get($this->_table);
        $row = $cekTable->num_rows();

        if ($row > 0){
            $post = $this->input->post();
            $tahun_ajaran1 = $post["tahun_ajaran1"];
            $tahun_ajaran2 = $post["tahun_ajaran2"];

            // if ($post["naikkelas"] == 1) {
            //     $this->naikkelas($post["nis"], $post["kelas_daftar_ulang"]);
            // }
            $this->nis = $post["nis"];
            $this->tahun_ajaran = $tahun_ajaran1.'/'.$tahun_ajaran2;
            $this->spp = $post["spp"];
            $this->seragam = $post["seragam"];
            $this->kegiatan_siswa = $post["kegiatan_siswa"];
            $this->spi = $post["spi"];
            $this->pembukaan_rek = $post["pembukaan_rek"];
            $this->jumlah = $post["total"];
            $this->terbayar = 0;
            $this->status = 0;
            $this->db->insert($this->_table, $this);
        } else {
            $post = $this->input->post();
            $tahun_ajaran1 = $post["tahun_ajaran1"];
            $tahun_ajaran2 = $post["tahun_ajaran2"];

            // if ($post["naikkelas"] == 1) {
            //     $this->naikkelas($post["nis"], $post["kelas_daftar_ulang"]);
            // }
            $this->no_bayar_daftar_ulang = 1;
            $this->nis = $post["nis"];
            $this->tahun_ajaran = $tahun_ajaran1.'/'.$tahun_ajaran2;
            $this->spp = $post["spp"];
            $this->seragam = $post["seragam"];
            $this->kegiatan_siswa = $post["kegiatan_siswa"];
            $this->spi = $post["spi"];
            $this->pembukaan_rek = $post["pembukaan_rek"];
            $this->jumlah = $post["total"];
            $this->terbayar = 0;
            $this->status = 0;
            $this->db->insert($this->_table, $this);
        }
    }

    public function naikkelas($nis, $kelas){
        $this->db->set("kelas", ($kelas)+1);
        $this->db->where("NIS", $nis);
        $this->db->update("data_siswa");
    }

    public function getSiswaByKelas($kelas)
    {
        $this->db->select("*");
        $this->db->where("kelas", $kelas, FALSE);
        $this->db->order_by("data_siswa.kelas, data_siswa.nama_siswa", "ASC");             
        return $this->db->get("data_siswa")->result();
    }

    public function saveSatuKelas()
    {
            $post = $this->input->post();
            $tahun_ajaran1 = $post["tahun_ajaran1"];
            $tahun_ajaran2 = $post["tahun_ajaran2"];

            $kelas = $post["kelas"];
            $tahun_ajaran = $tahun_ajaran1.'/'.$tahun_ajaran2;
            $spp = $post["spp"];
            $seragam = $post["seragam"];
            $kegiatan_siswa = $post["kegiatan_siswa"];
            $spi = $post["spi"];
            $pembukaan_rek = $post["pembukaan_rek"];
            $jumlah = $post["total"];
            $terbayar = 0;
            $status = 0;

            $siswa = $this->getSiswaByKelas($kelas);

            foreach ($siswa as $siswa) {
                $NIS = $siswa->NIS;
                if ($this->cekTransaksi1($NIS,$tahun_ajaran) == 0){
                    $data = array(
                        'NIS' => $NIS,
                        'tahun_ajaran' => $tahun_ajaran,
                        'spp' => $spp,
                        'seragam' => $seragam,
                        'kegiatan_siswa' => $kegiatan_siswa,
                        'spi' => $spi,
                        'pembukaan_rek' => $pembukaan_rek,
                        'jumlah' => $jumlah,
                        'terbayar' => $terbayar,
                        'status' => $status
                        
                    );
                    $this->db->insert('daftar_ulang', $data);
                }

            }
        }


    public function saveCicil()
    {
            $post = $this->input->post();
            $data = array(
                    'no_bayar_daftar_ulang' => $post["no_bayar_daftar_ulang"],
                    'tanggal_bayar_daftarulang' => $post["tanggal_bayar"],
                    'nominal' => $post["nominal_bayar"]
            );

            $this->db->insert("cicil_daftar_ulang", $data);
    }

    public function updateTerbayar($no)
    {
            $this->db->select_sum("nominal");
            $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
            $terbayar = $this->db->get("cicil_daftar_ulang")->row();
            
            $this->db->set("terbayar", $terbayar->nominal);
            $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
            $this->db->update('daftar_ulang');

            $this->db->select("jumlah");
            $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
            $total = $this->db->get("daftar_ulang")->row();

            if($total->jumlah <= $terbayar->nominal){
                $this->setSPPJuli($no); 
                $this->db->set("status", 1);
                $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
                $this->db->update('daftar_ulang');
            }else{
                $this->notSetSPPJuli($no);
                $this->db->set("status", 0);
                $this->db->where("no_bayar_daftar_ulang", $no, FALSE);
                $this->db->update('daftar_ulang');
            }
    }

    public function setSPPJuli($no){
        $tanggal = date("d/m/Y");
        $du = $this->getByNoDaftarUlang($no);
        $tahunSPP = $this->getTahunSPPJuli($no);
        $cekSPPJuli = $this->cekSPPJuli($du->NIS, 7, $tahunSPP->tahun);

        if($cekSPPJuli == 0){
                      
            $data = array(
                'NIS' => $du->NIS,
                'tanggal_bayar_spp' => $tanggal,
                'bulan_spp' => 7,
                'tahun_spp' => $tahunSPP->tahun,
                'jumlah' => $du->spp
            );
            $this->db->insert('bayar_spp', $data);
            }   
    }

    public function notSetSPPJuli($no){
        $du = $this->getByNoDaftarUlang($no);
        $tahunSPP = $this->getTahunSPPJuli($no);
        $cekSPPJuli = $this->cekSPPJuli($du->NIS, 7, $tahunSPP->tahun);
        if($cekSPPJuli == 1){
            $noSPP = $this->getSPPJuli($du->NIS, 7, $tahunSPP->tahun);
            return $this->db->delete("bayar_spp", array("no_bayar_spp" => $noSPP->no_bayar_spp));
            }   
    }

    public function cekSPPJuli($nis, $bulan, $tahun){
        $sql = "SELECT * FROM `bayar_spp` WHERE NIS = $nis AND bulan_spp = $bulan AND tahun_spp = $tahun";
        $cek = $this->db->query($sql)->num_rows();

        if($cek==0){
            return 0;
        }else{
            return 1;
        }

    }

    public function getSPPJuli($nis, $bulan, $tahun){
        $sql = "SELECT * FROM `bayar_spp` WHERE NIS = $nis AND bulan_spp = $bulan AND tahun_spp = $tahun";
        return $this->db->query($sql)->row();
    }

    public function getTahunSPPJuli($no){
        $sql = "SELECT SUBSTRING(tahun_ajaran, -4) as tahun FROM `daftar_ulang` WHERE no_bayar_daftar_ulang = $no";
        return $this->db->query($sql)->row();
    }



    public function cekNisTransaksi()
        {
            $post = $this->input->post();
            $this->db->select("*");
            $this->db->where("s.NIS", $post["nis"], FALSE);
            $query = $this->db->get("data_siswa as s"); 
            return $total = $query->num_rows();
        }

    public function cekNamaTransaksi()
        {
            $post = $this->input->post();
            $this->db->select("CONCAT(s.kelas,s.nama_kelas) as kelas_nama,*");
            $this->db->where("s.NIS", $post["nis"], FALSE);
            $this->db->where("s.nama_siswa", $post["nama_siswa"]);
            $query = $this->db->get("data_siswa as s"); 
            return $total = $query->num_rows();
        }

    public function cekTransaksi()
        {
            $post = $this->input->post();
            $tahun_ajaran1 = $post["tahun_ajaran1"];
            $tahun_ajaran2 = $post["tahun_ajaran2"];
            $tahun_ajaran = $tahun_ajaran1.'/'.$tahun_ajaran2;

            $this->db->select("*");
            $this->db->where("b.NIS", $post["nis"], FALSE);
            $this->db->like("b.tahun_ajaran", $tahun_ajaran, FALSE);
            $query = $this->db->get("daftar_ulang as b"); 
            return $total = $query->num_rows();
        }

    public function cekTransaksi1($NIS,$tahun_ajaran)
        {
            $this->db->select("*");
            $this->db->where("b.NIS", $NIS, FALSE);
            $this->db->like("b.tahun_ajaran", $tahun_ajaran, FALSE);
            $query = $this->db->get("daftar_ulang as b"); 
            return $total = $query->num_rows();
        }


    public function updateCicil($no)
    {
        $post = $this->input->post();

        $this->db->set("nominal", $post["nominal_bayar"]);
        $this->db->set("tanggal_bayar_daftarulang", $post["tanggal_bayar"]);
        $this->db->where("no_cicil_daftar_ulang", $no);
        $this->db->update('cicil_daftar_ulang');
    }

    public function updateDaftarUlang($no)
    {
        $post = $this->input->post();

        $this->db->set("spp", $post["spp"]);
        $this->db->set("seragam", $post["seragam"]);
        $this->db->set("kegiatan_siswa", $post["kegiatan_siswa"]);
        $this->db->set("spi", $post["spi"]);
        $this->db->set("pembukaan_rek", $post["pembukaan_rek"]);
        $this->db->set("jumlah", $post["total"]);
        $this->db->where("no_bayar_daftar_ulang", $no);
        $this->db->update('daftar_ulang');
    }

    public function delete_cicil($no)
        {
            return $this->db->delete("cicil_daftar_ulang", array("no_cicil_daftar_ulang" => $no));
        }

    public function delete($no)
        {
            $this->notSetSPPJuli($no);
            return $this->db->delete("daftar_ulang", array("no_bayar_daftar_ulang" => $no));
        }

    public function getLastTahunAjaran(){
        $sql = "SELECT tahun_ajaran FROM daftar_ulang ORDER BY tahun_ajaran DESC LIMIT 1";
        return $this->db->query($sql)->row();
    }


    public function getLunasByPeriodeTahun($tahunAjaran){
        $sql = "SELECT s.nama_siswa, s.kelas, s.nama_kelas, d.* FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS AND d.status = 1 AND d.tahun_ajaran LIKE '{$tahunAjaran}' ORDER BY s.kelas ASC, s.nama_kelas ASC, s.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getBelumLunasByPeriodeTahun($tahunAjaran){
        $sql = "SELECT s.nama_siswa, s.kelas, s.nama_kelas, d.* FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS AND d.status = 0 AND d.tahun_ajaran LIKE '{$tahunAjaran}' ORDER BY s.kelas ASC, s.nama_kelas ASC, s.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getBelumLunasDaftarUlang(){
        $sql = "SELECT s.nama_siswa, s.kelas, s.nama_kelas, d.* FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS AND d.status = 0 ";
        return $this->db->query($sql)->result();   
    }

    public function getDaftarUlangTerbayar($tahunAjaran){
        $sql = "SELECT SUM(d.terbayar) as total FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS AND d.tahun_ajaran LIKE '{$tahunAjaran}' ";
        return $this->db->query($sql)->row();
    }

    public function getDaftarUlangTerbayarByTanggal($bulan,$tahun){
        $sql = "SELECT SUM(d.nominal) as total FROM cicil_daftar_ulang as d WHERE SUBSTRING(d.tanggal_bayar_daftarulang, -4) = $tahun AND SUBSTRING(d.tanggal_bayar_daftarulang, -7, 2) = $bulan";
        return $this->db->query($sql)->row();
    }

    public function getAllDaftarUlangTerbayar(){
        $sql = "SELECT SUM(d.nominal) as total FROM cicil_daftar_ulang as d";
        return $this->db->query($sql)->row();
    }

    public function getDaftarUlangBelumTerbayar($tahunAjaran){
        $total = $this->getTotalPembayaran($tahunAjaran);
        $terbayar = $this->getDaftarUlangTerbayar($tahunAjaran);
        return ($total->total - $terbayar->total);
    }

    public function getTotalPembayaran($tahunAjaran){
        $sql = "SELECT SUM(d.jumlah) as total FROM daftar_ulang as d, data_siswa as s WHERE d.NIS = s.NIS AND d.tahun_ajaran LIKE '{$tahunAjaran}' ";
        return $this->db->query($sql)->row();
    }

    public function getListSiswaDaftarUlang($tahunAjaran,$kelas){
        $sql = "(SELECT b.nama_siswa as nama, CONCAT(b.kelas,b.nama_kelas) as kelas_nama, a.jumlah as target, a.spp as spp, a.seragam as seragam, a.kegiatan_siswa as keg_siswa, a.spi as spi, a.pembukaan_rek as pembukaan_rek, a.terbayar as terbayar, (a.jumlah - a.terbayar) as hutang FROM daftar_ulang as a, data_siswa as b WHERE a.NIS = b.NIS AND a.tahun_ajaran LIKE '{$tahunAjaran}' AND b.kelas = $kelas) 
            UNION ALL
            SELECT 'TOTAL' as nama, '' as kelas_nama, SUM(a.jumlah) as target, SUM(a.spp) as spp, SUM(a.seragam) as seragam, SUM(a.kegiatan_siswa) as keg_siswa, SUM(a.spi) as spi, SUM(a.pembukaan_rek) as pembukaan_rek, SUM(a.terbayar) as terbayar, (SUM(a.jumlah) - SUM(a.terbayar)) as hutang FROM daftar_ulang as a, data_siswa as b WHERE a.NIS = b.NIS AND a.tahun_ajaran LIKE '{$tahunAjaran}' AND b.kelas = $kelas";
        return $this->db->query($sql)->result();
    }

    public function getLapDaftarUlangByKelas($tahunAjaran){
        $sql = "(SELECT CONCAT(b.kelas,b.nama_kelas) as nama, SUM(a.jumlah) as target, SUM(a.spp) as spp, SUM(a.seragam) as seragam, SUM(a.kegiatan_siswa) as keg_siswa, SUM(a.spi) as spi, SUM(a.pembukaan_rek) as pembukaan_rek, SUM(a.terbayar) as terbayar, SUM((a.jumlah - a.terbayar)) as hutang FROM daftar_ulang as a, data_siswa as b WHERE a.NIS = b.NIS AND a.tahun_ajaran LIKE '{$tahunAjaran}' GROUP BY b.kelas, b.nama_kelas)
            UNION
            SELECT 'TOTAL' as nama, SUM(a.jumlah) as target, SUM(a.spp) as spp, SUM(a.seragam) as seragam, SUM(a.kegiatan_siswa) as keg_siswa, SUM(a.spi) as spi, SUM(a.pembukaan_rek) as pembukaan_rek, SUM(a.terbayar) as terbayar, SUM((a.jumlah - a.terbayar)) as hutang FROM daftar_ulang as a, data_siswa as b WHERE a.NIS = b.NIS AND a.tahun_ajaran LIKE '{$tahunAjaran}'";

        return $this->db->query($sql)->result();
    }

   
}
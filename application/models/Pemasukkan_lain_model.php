<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukkan_lain_model extends CI_Model
{
    private $_table = "bayar_spp";
    private $tableKatPL = "kategori_pemasukkan_lain";
    public $no_bayar_spp;
    public $nis;
    public $tanggal_bayar_spp;
    public $bulan_spp;
    public $tahun_spp;
    public $jumlah;
    public $status_spp;
    
    public function rules()
    {
        return [
            
             ['field' => 'nis',
            'label' => 'NIS',
            'rules' => 'required'],

            ['field' => 'bulan_spp',
            'label' => 'Bulan_spp',
            'rules' => 'required|numeric'],

            ['field' => 'tahun_spp',
            'label' => 'Tahun_spp',
            'rules' => 'required'],

            ['field' => 'biaya_spp',
            'label' => 'Biaya_spp',
            'rules' => 'required|numeric'],

            ['field' => 'status_spp',
            'label' => 'Status_spp',
            'rules' => 'required|numeric']


        ];
    }

    public function rulesKategori()
    {
        return [            
            ['field' => 'nama_kategori',
            'label' => 'Nama_kategori',
            'rules' => 'required']
        ];
    }

        public function rulesPemasukkanLain()
    {
        return [            
            ['field' => 'tanggal_bayar',
            'label' => 'Tanggal_bayar',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();

        $this->db->select("*");
        $this->db->where("a.id_kategori_pemasukkan_lain", "b.id_kategori_pemasukkan_lain", FALSE);
        $this->db->order_by('SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC'); 
        return $this->db->get("pemasukkan_lain as a, kategori_pemasukkan_lain as b")->result();
    }

    public function getKategori()
    {
        //return $this->db->get($this->_table)->result();

        $this->db->select("*");
        $this->db->order_by('kode_pemasukkan_lain', 'ASC');
        return $this->db->get("kategori_pemasukkan_lain")->result();
    }

    public function getPemasukkanLainByKategoriBulanTahun()
    {
        $post = $this->input->post();
        $kategori = $post["kategori"];
        $bulan = $post["bulan"];
        $tahun = $post["tahun"];
         
        if(($kategori == 0) and ($bulan == 0) and ($tahun == "")){
            //0000
            redirect(site_url('admin/pemasukkan_lain'));

            
        }else if(($kategori == 0) and ($bulan == 0) and ($tahun != "")){
            //001
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -4) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori == 0) and ($bulan != 0) and ($tahun == "")){
            //010
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori == 0) and ($bulan != 0) and ($tahun != "")){
            //011
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan == 0) and ($tahun == "")){
            //100
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND a.id_kategori_pemasukkan_lain = $kategori ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan == 0) and ($tahun != "")){
            //101
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND a.id_kategori_pemasukkan_lain = $kategori AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan != 0) and ($tahun == "")){
            //110
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND a.id_kategori_pemasukkan_lain = $kategori AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan != 0) and ($tahun != "")){
            //111
            $sql = "SELECT *, SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND a.id_kategori_pemasukkan_lain = $kategori AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }

    }
    

    public function getTahunPemasukkanLain()
        {
            $sql = "SELECT SUBSTRING(tanggal_pemasukkan_lain, -4) as tahun FROM pemasukkan_lain GROUP BY tahun DESC";
            return $this->db->query($sql)->result();
     }

    // public function save()
    // {
    //     $post = $this->input->post();
    //     $this->nis = $post["nis"];
    //     $this->kelas_bayar_spp = $post["kelas_bayar_spp"];
    //     $this->tanggal_bayar_spp = $post["tanggal_bayar_spp"];
    //     $this->bulan_spp = $post["bulan_spp"];
    //     $this->tahun_spp = $post["tahun_spp"];
    //     $this->jumlah = $post["biaya_spp"];
    //     $this->status_spp = $post["status_spp"];
        
    //     $this->db->insert($this->_table, $this);
    // }

    public function saveKategori()
    {
        $post = $this->input->post();
        $data = array(
            'nama_kategori_pemasukkan_lain' => $post["nama_kategori"],
            'kode_pemasukkan_lain' => $post["kode_kategori"]
        );

        $this->db->insert('kategori_pemasukkan_lain', $data);
    }

    public function cekKodePL($id)
    {
        return $this->db->get_where($this->tableKatPL, ["kode_pemasukkan_lain" => $id])->num_rows();
    }

    public function getKodeById($id_kategori){
            $sql = "SELECT kode_pemasukkan_lain as kode FROM kategori_pemasukkan_lain WHERE id_kategori_pemasukkan_lain = $id_kategori";
            return $this->db->query($sql)->row();
     }


    public function savePemasukkanLain()
    {
        $post = $this->input->post();

        if($post["nama_siswa"] != "" ){
            $keterangan = "Pembayaran atas nama ".$post["nama_siswa"]." - ";
        }


        $data = array(
            'id_kategori_pemasukkan_lain' => $post["kategori"],
            'tanggal_pemasukkan_lain' => $post["tanggal_bayar"],
            'nominal_pemasukkan_lain' => $post["nominal"],
            'keterangan_pemasukkan_lain' => $keterangan.$post["keterangan_pemasukkan_lain"]
        );

        $this->db->insert('pemasukkan_lain', $data);
    }

    public function getNamaKategori($idKategori){
        $sql = "SELECT nama_kategori_pemasukkan_lain as nama FROM `kategori_pemasukkan_lain` WHERE id_kategori_pemasukkan_lain = $idkategori";
            return $this->db->query($sql)->row();
    }

    public function updateKategori($id_kategori)
    {
        $post = $this->input->post();

        $this->db->set("nama_kategori_pemasukkan_lain", $post["nama_kategori"]);
        $this->db->set("kode_pemasukkan_lain", $post["kode_kategori"]);
        $this->db->where("id_kategori_pemasukkan_lain", $id_kategori);
        $this->db->update("kategori_pemasukkan_lain");
    }

    public function updatePemasukkanLain($no_pemasukkan_lain)
    {
        $post = $this->input->post();

        $this->db->set("id_kategori_pemasukkan_lain", $post["kategori"]);
        $this->db->set("tanggal_pemasukkan_lain", $post["tanggal_bayar"]);
        $this->db->set("nominal_pemasukkan_lain", $post["nominal"]);
        $this->db->set("keterangan_pemasukkan_lain", $post["keterangan_pemasukkan_lain"]);
        $this->db->where("no_pemasukkan_lain", $no_pemasukkan_lain);
        $this->db->update("pemasukkan_lain");
    }

    public function deleteKategori($no)
        {
            return $this->db->delete("kategori_pemasukkan_lain", array("id_kategori_pemasukkan_lain" => $no));
        }

    public function deletePemasukkanLain($no)
        {
            return $this->db->delete("pemasukkan_lain", array("no_pemasukkan_lain" => $no));
        }

    public function getNominalPemasukkanLain($bulan,$tahun){
        $sql = "SELECT SUM(nominal_pemasukkan_lain) as total FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan";
        return $this->db->query($sql)->row();
    }

    public function getAllPemasukkanLain(){
        $sql = "SELECT SUM(nominal_pemasukkan_lain) as total FROM pemasukkan_lain as a";
        return $this->db->query($sql)->row();
    }

    public function getPemasukkanLainGroupByBulanTahun($bulan,$tahun){
        $sql = "SELECT b.nama_kategori_pemasukkan_lain as nama_kategori, COUNT(a.id_kategori_pemasukkan_lain) as total_kategori1, SUM(a.nominal_pemasukkan_lain) as total_kategori FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan GROUP BY a.id_kategori_pemasukkan_lain";
        return $this->db->query($sql)->result();
    }

    public function getListPemasukkanLainByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM pemasukkan_lain as a, kategori_pemasukkan_lain as b WHERE a.id_kategori_pemasukkan_lain = b.id_kategori_pemasukkan_lain AND SUBSTRING(a.tanggal_pemasukkan_lain, -4) = $tahun AND SUBSTRING(a.tanggal_pemasukkan_lain, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pemasukkan_lain, -4) DESC, SUBSTRING(tanggal_pemasukkan_lain, -7, 2) DESC, SUBSTRING(tanggal_pemasukkan_lain, -10, 2) DESC";
        return $this->db->query($sql)->result();
    }


    // function search_blog($title){
    //     $this->db->like('nama_siswa', $title , 'both');
    //     $this->db->order_by('nama_siswa', 'ASC');
    //     $this->db->limit(10);
    //     return $this->db->get('data_siswa')->result();
    // }
   
}
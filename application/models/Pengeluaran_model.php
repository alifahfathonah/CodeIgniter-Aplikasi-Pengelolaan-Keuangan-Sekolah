<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model
{
     private $tableKatPengeluaran = "kategori_pengeluaran";
    public $no_bayar_spp;
    public $nis;
    public $tanggal_bayar_spp;
    public $bulan_spp;
    public $tahun_spp;
    public $jumlah;
    public $status_spp;
    

    public function rulesKategori()
    {
        return [            
            ['field' => 'nama_kategori',
             'label' => 'Nama_kategori',
             'rules' => 'required']
        ];
    }

    public function rulesPengeluaran()
     {
         return [            
             ['field' => 'tanggal_bayar',
             'label' => 'Tanggal_bayar',
             'rules' => 'required']
         ];
     }

    public function getAll()
    {
        $this->db->select("*");
        $this->db->where("a.id_kategori_pengeluaran", "b.id_kategori_pengeluaran", FALSE);
        $this->db->order_by('SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC'); 
        return $this->db->get("pengeluaran as a, kategori_pengeluaran as b")->result();
    }

    public function getKategori()
    {
        $this->db->select("*");
        $this->db->order_by('kode_pengeluaran', 'ASC');
        return $this->db->get("kategori_pengeluaran")->result();
    }

    public function getPengeluaranByKategoriBulanTahun()
    {
        $post = $this->input->post();
        $kategori = $post["kategori"];
        $bulan = $post["bulan"];
        $tahun = $post["tahun"];
         
        if(($kategori == 0) and ($bulan == 0) and ($tahun == "")){
            //0000
            redirect(site_url('admin/pengeluaran'));

            
        }else if(($kategori == 0) and ($bulan == 0) and ($tahun != "")){
            //001
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -4) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori == 0) and ($bulan != 0) and ($tahun == "")){
            //010
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori == 0) and ($bulan != 0) and ($tahun != "")){
            //011
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan == 0) and ($tahun == "")){
            //100
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND a.id_kategori_pengeluaran = $kategori ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan == 0) and ($tahun != "")){
            //101
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND a.id_kategori_pengeluaran = $kategori AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan != 0) and ($tahun == "")){
            //110
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND a.id_kategori_pengeluaran = $kategori AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }else if(($kategori != 0) and ($bulan != 0) and ($tahun != "")){
            //111
            $sql = "SELECT *, SUBSTRING(a.tanggal_pengeluaran, -7, 2) FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND a.id_kategori_pengeluaran = $kategori AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
            return $this->db->query($sql)->result();
        }

    }

   
    public function getTahunPengeluaran()
         {
             $sql = "SELECT SUBSTRING(tanggal_pengeluaran, -4) as tahun FROM pengeluaran GROUP BY tahun DESC";
             return $this->db->query($sql)->result();
      }

   

    public function saveKategori()
     {
         $post = $this->input->post();
         $data = array(
            'nama_kategori_pengeluaran' => $post["nama_kategori"],
            'kode_pengeluaran' => $post["kode_kategori"] 
            );
         $this->db->insert('kategori_pengeluaran', $data);
     }

    public function cekKodePL($id)
    {
        return $this->db->get_where($this->tableKatPengeluaran, ["kode_pengeluaran" => $id])->num_rows();
    }

    public function getKodeById($id_kategori){
            $sql = "SELECT kode_pengeluaran as kode FROM kategori_pengeluaran WHERE id_kategori_pengeluaran = $id_kategori";
            return $this->db->query($sql)->row();
     }


    public function savePengeluaran()
     {
         $post = $this->input->post();
         $data = array(
             'id_kategori_pengeluaran' => $post["kategori"],
             'tanggal_pengeluaran' => $post["tanggal_bayar"],
             'nominal_pengeluaran' => $post["nominal"],
             'keterangan_pengeluaran' => $post["keterangan"]
         );

         $this->db->insert('pengeluaran', $data);
     }

    public function updateKategori($id_kategori)
     {
         $post = $this->input->post();

         $this->db->set("nama_kategori_pengeluaran", $post["nama_kategori"]);
         $this->db->set("kode_pengeluaran", $post["kode_kategori"]);
         $this->db->where("id_kategori_pengeluaran", $id_kategori);
         $this->db->update("kategori_pengeluaran");
     }

    public function updatePengeluaran($no_pengeluaran)
     {
         $post = $this->input->post();

         $this->db->set("id_kategori_pengeluaran", $post["kategori"]);
         $this->db->set("tanggal_pengeluaran", $post["tanggal_bayar"]);
         $this->db->set("nominal_pengeluaran", $post["nominal"]);
         $this->db->set("keterangan_pengeluaran", $post["keterangan"]);
         $this->db->where("no_pengeluaran", $no_pengeluaran);
         $this->db->update("pengeluaran");
    }


     public function deleteKategori($no)
         {
             return $this->db->delete("kategori_pengeluaran", array("id_kategori_pengeluaran" => $no));
         }

    public function deletePengeluaran($no)
         {
             return $this->db->delete("pengeluaran", array("no_pengeluaran" => $no));
         }

     public function getNominalPengeluaran($bulan,$tahun){
        $sql = "SELECT SUM(nominal_pengeluaran) as total FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan";
        return $this->db->query($sql)->row();
    }

    public function getAllPengeluaran(){
        $sql = "SELECT SUM(nominal_pengeluaran) as total FROM pengeluaran";
        return $this->db->query($sql)->row();
    }

    public function getPengeluaranGroupByBulanTahun($bulan,$tahun){
        $sql = "SELECT b.nama_kategori_pengeluaran as nama_kategori, COUNT(a.id_kategori_pengeluaran) as total_kategori1, SUM(a.nominal_pengeluaran) as total_kategori FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan GROUP BY a.id_kategori_pengeluaran";
        return $this->db->query($sql)->result();
    }

    public function getListPengeluaranByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM pengeluaran as a, kategori_pengeluaran as b WHERE a.id_kategori_pengeluaran = b.id_kategori_pengeluaran AND SUBSTRING(a.tanggal_pengeluaran, -4) = $tahun AND SUBSTRING(a.tanggal_pengeluaran, -7, 2) = $bulan ORDER BY SUBSTRING(tanggal_pengeluaran, -4) DESC, SUBSTRING(tanggal_pengeluaran, -7, 2) DESC, SUBSTRING(tanggal_pengeluaran, -10, 2) DESC";
        return $this->db->query($sql)->result();
    }
   
}
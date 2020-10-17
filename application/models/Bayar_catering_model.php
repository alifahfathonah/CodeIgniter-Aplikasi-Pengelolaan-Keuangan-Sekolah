<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_catering_model extends CI_Model
{
    private $_table = "bayar_catering";
    public $no_bayar_catering;
    public $nis;
    public $tanggal_bayar_catering;
    public $bulan_catering;
    public $tahun_catering;
    public $biaya_catering;
    public $status_catering;
    
    public function rules()
    {
        return [
            
             ['field' => 'nis',
            'label' => 'NIS',
            'rules' => 'required'],

            ['field' => 'bulan_catering',
            'label' => 'Bulan_catering',
            'rules' => 'required|numeric'],

            ['field' => 'tahun_catering',
            'label' => 'Tahun_catering',
            'rules' => 'required'],

            ['field' => 'biaya_catering',
            'label' => 'Biaya_catering',
            'rules' => 'required|numeric'],

            ['field' => 'status_catering',
            'label' => 'Status_catering',
            'rules' => 'required|numeric']


        ];
    }

    public function rulesBayar()
    {
        return [            
            ['field' => 'tanggal_bayar_catering',
            'label' => 'Tanggal_bayar_catering',
            'rules' => 'required']
        ];
    }

        public function rulesBayar2()
    {
        return [            
            ['field' => 'status_catering',
            'label' => 'Status_catering',
            'rules' => 'required|numeric']
        ];
    }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";

        return $this->db->query($sql)->result();
}

    public function getCateringByNoBulanTahun()
    {
        $post = $this->input->post();
        $bulan = $post["bulan_catering"];
        $tahun = $post["tahun_catering"];
        $kelas = $post["kelas"];
        $nama_kelas = $post["nama_kelas"];

         if(($nama_kelas == "") and ($kelas == 0) and ($bulan == 0) and ($tahun == "")){
            //0000
           redirect(site_url('admin/bayar_catering'));  
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan == 0) and ($tahun != "")){
            //0001
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_catering = $tahun ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan != 0) and ($tahun == "")){
            //0010
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.bulan_catering = $bulan ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan != 0) and ($tahun != "")){
            //0011
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_catering = $tahun AND b.bulan_catering = $bulan ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan == 0) and ($tahun == "")){
            //0100
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan == 0) and ($tahun != "")){
            //0101
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_catering = $tahun ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan != 0) and ($tahun == "")){
            //0110
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.bulan_catering = $bulan ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan != 0) and ($tahun != "")){
            //0111
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_catering = $tahun AND b.bulan_catering = $bulan ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();   
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan == 0) and ($tahun == "")){
            //1000
           $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();  
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan == 0) and ($tahun != "")){
            //1001
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_catering = $tahun AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan != 0) and ($tahun == "")){
            //1010
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.bulan_catering = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan != 0) and ($tahun != "")){
            //1011
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_catering = $tahun AND b.bulan_catering = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan == 0) and ($tahun == "")){
            //1100
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan == 0) and ($tahun != "")){
            //1101
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_catering = $tahun AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan != 0) and ($tahun == "")){
            //1110
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.bulan_catering = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan != 0) and ($tahun != "")){
            //1111
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_catering as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_catering = $tahun AND b.bulan_catering = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_catering DESC, b.bulan_catering DESC, s.kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
            
        }
    }
    
    public function getByNoCatering($no)
    {
        $this->db->select("s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.*");
        $this->db->where("b.NIS", "s.NIS", FALSE);
        $this->db->where("b.no_bayar_catering", $no, FALSE);
        return $this->db->get("bayar_catering as b, data_siswa as s")->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $biayaCatering = $this->getTemporaryCatering();
        if($biayaCatering->nominal != $post["biaya_catering"]){
            $this->updateTempCatering($post["biaya_catering"]);
        }

        $data = array(
            'NIS' => $post["nis"],
            'tanggal_bayar_catering' => $post["tanggal_bayar_catering"],
            'bulan_catering' => $post["bulan_catering"],
            'tahun_catering' => $post["tahun_catering"],
            'biaya_catering' => $post["biaya_catering"]
        );

        $this->db->insert('bayar_catering', $data);

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

        $this->db->select("*");
        $this->db->where("s.NIS", $post["nis"], FALSE);
        $this->db->where("s.nama_siswa", $post["nama_siswa"]);
        $query = $this->db->get("data_siswa as s"); 
        return $total = $query->num_rows();
    }

    public function cekTransaksi()
    {
        $post = $this->input->post();

        $this->db->select("*");
        $this->db->where("b.NIS", $post["nis"], FALSE);
        $this->db->where("b.bulan_catering", $post["bulan_catering"], FALSE);
        $this->db->where("b.tahun_catering", $post["tahun_catering"], FALSE);
        $query = $this->db->get("bayar_catering as b"); 
        return $total = $query->num_rows();
    }

    public function update()
    {
        $post = $this->input->post();

        $this->db->set("tanggal_bayar_catering", $post["tanggal_bayar_catering"]);
        $this->db->set("biaya_catering", $post["biaya_catering"]);
        $this->db->where("no_bayar_catering", $post["no_bayar_catering"]);
        $this->db->update('bayar_catering');
    }


    // public function konfirmasiBayarCatering()
    // {
    //     $post = $this->input->post();
    //     $this->db->set("tanggal_bayar_catering", $post["tanggal_bayar_catering"]);
    //     $this->db->set("status_catering", 1, FALSE);
    //     $this->db->where("no_bayar_catering", $post["no_bayar_catering"]);
    //     $this->db->update('bayar_catering');

    // }

    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_catering" => $no));
    }


    function search_blog($title){
        $this->db->like('nama_siswa', $title , 'both');
        $this->db->where('kelas !=', 99);
        $this->db->order_by('nama_siswa', 'ASC');
        $this->db->limit(10);
        return $this->db->get('data_siswa')->result();
    }


    public function getLunasByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM bayar_catering, data_siswa WHERE bulan_catering = $bulan AND tahun_catering = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_catering.NIS ORDER BY data_siswa.kelas ASC, data_siswa.nama_kelas ASC, data_siswa.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getBelumLunasByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_catering WHERE bulan_catering = $bulan AND tahun_catering = $tahun AND data_siswa.NIS = bayar_catering.NIS) AND data_siswa.kelas != 99 ORDER BY data_siswa.kelas ASC, data_siswa.nama_kelas ASC, data_siswa.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getCateringTerbayar($bulan,$tahun){
        $sql = "SELECT SUM(bayar_catering.biaya_catering) as total FROM bayar_catering, data_siswa WHERE bulan_catering = $bulan AND tahun_catering = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_catering.NIS";
        return $this->db->query($sql)->row();
    }

    public function getCateringTerbayarByTanggal($bulan,$tahun){
        $sql = "SELECT SUM(bayar_catering.biaya_catering) as total FROM bayar_catering, data_siswa WHERE SUBSTRING(bayar_catering.tanggal_bayar_catering, -4) = $tahun AND SUBSTRING(bayar_catering.tanggal_bayar_catering, -7, 2) = $bulan AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_catering.NIS";
        return $this->db->query($sql)->row();
    }

    public function getAllCateringTerbayar(){
        $sql = "SELECT SUM(bayar_catering.biaya_catering) as total FROM bayar_catering";
        return $this->db->query($sql)->row();
    }

    // public function getSPPBelumTerbayar($bulan,$tahun){
    //     $sql = "SELECT SUM(data_siswa.biaya_spp) as total FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_spp WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.NIS = bayar_spp.NIS) AND data_siswa.kelas != 99";
    //     return $this->db->query($sql)->row();
    // }

    public function getTemporaryCatering(){
        $sql = "SELECT * FROM temporary WHERE nama_temp = 'catering'";
        return $this->db->query($sql)->row();
    }

    public function updateTempCatering($nominal){
        $this->db->set("nominal", $nominal);
        $this->db->where("nama_temp", 'catering');
        $this->db->update('temporary');
    }
   
}
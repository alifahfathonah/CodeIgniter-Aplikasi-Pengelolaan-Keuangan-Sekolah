<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_spp_model extends CI_Model
{
    private $_table = "bayar_spp";
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
            'rules' => 'required|numeric']

        ];
    }

    public function rulesBayar()
    {
        return [            
            ['field' => 'tanggal_bayar_spp',
            'label' => 'Tanggal_bayar_spp',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS ASC";

        return $this->db->query($sql)->result();
    }

    public function getSppByNoBulanTahun()
    {
        $post = $this->input->post();
        $kelas = $post["kelas"];
        $nama_kelas = $post["nama_kelas"];
        $bulan = $post["bulan_spp"];
        $tahun = $post["tahun_spp"];

        if(($nama_kelas == "") and ($kelas == 0) and ($bulan == 0) and ($tahun == "")){
            //0000
           redirect(site_url('admin/bayar_spp'));  
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan == 0) and ($tahun != "")){
            //0001
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_spp = $tahun ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan != 0) and ($tahun == "")){
            //0010
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.bulan_spp = $bulan ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas == 0) and ($bulan != 0) and ($tahun != "")){
            //0011
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_spp = $tahun AND b.bulan_spp = $bulan ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan == 0) and ($tahun == "")){
            //0100
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan == 0) and ($tahun != "")){
            //0101
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_spp = $tahun ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan != 0) and ($tahun == "")){
            //0110
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.bulan_spp = $bulan ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas == "") and ($kelas != 0) and ($bulan != 0) and ($tahun != "")){
            //0111
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_spp = $tahun AND b.bulan_spp = $bulan ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();            
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan == 0) and ($tahun == "")){
            //1000
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan == 0) and ($tahun != "")){
            //1001
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_spp = $tahun AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan != 0) and ($tahun == "")){
            //1010
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.bulan_spp = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas == 0) and ($bulan != 0) and ($tahun != "")){
            //1011
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND b.tahun_spp = $tahun AND b.bulan_spp = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan == 0) and ($tahun == "")){
            //1100
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan == 0) and ($tahun != "")){
            //1101
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_spp = $tahun AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan != 0) and ($tahun == "")){
            //1110
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.bulan_spp = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }else if(($nama_kelas != "") and ($kelas != 0) and ($bulan != 0) and ($tahun != "")){
            //1111
            $sql = "SELECT s.nama_siswa, s.kelas, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.* FROM bayar_spp as b, data_siswa as s WHERE b.NIS = s.NIS AND s.kelas = $kelas AND b.tahun_spp = $tahun AND b.bulan_spp = $bulan AND s.nama_kelas = '{$nama_kelas}' ORDER BY b.tahun_spp DESC, b.bulan_spp DESC, s.kelas ASC, s.nama_kelas ASC, b.NIS DESC";
            return $this->db->query($sql)->result();
        }

    }
    
    public function getByNoSPP($no)
    {
        $this->db->select("s.nama_siswa, s.kelas, s.biaya_spp, CONCAT(s.kelas,s.nama_kelas) as kelas_nama, b.*");
        $this->db->where("b.NIS", "s.NIS", FALSE);
        $this->db->where("b.no_bayar_spp", $no, FALSE);
        return $this->db->get("bayar_spp as b, data_siswa as s")->row();
    }

    public function save()
    {
        $post = $this->input->post();

        $data = array(
            'NIS' => $post["nis"],
            'tanggal_bayar_spp' => $post["tanggal_bayar_spp"],
            'bulan_spp' => $post["bulan_spp"],
            'tahun_spp' => $post["tahun_spp"],
            'jumlah' => $post["biaya_spp"]
        );

        $this->db->insert('bayar_spp', $data);
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
        $this->db->where("b.bulan_spp", $post["bulan_spp"], FALSE);
        $this->db->where("b.tahun_spp", $post["tahun_spp"], FALSE);
        $query = $this->db->get("bayar_spp as b"); 
        return $total = $query->num_rows();
    }

    public function update()
    {
        $post = $this->input->post();

        $this->db->set("tanggal_bayar_spp", $post["tanggal_bayar_spp"]);
        $this->db->set("jumlah", $post["biaya_spp"]);
        $this->db->where("no_bayar_spp", $post["no_bayar_spp"]);
        $this->db->update('bayar_spp');
    }

    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no_bayar_spp" => $no));
    }


    function search_blog($title){
        $this->db->like('nama_siswa', $title , 'both');
        $this->db->where('kelas !=', 99);
        $this->db->order_by('nama_siswa', 'ASC');
        $this->db->limit(10);
        return $this->db->get('data_siswa')->result();
    }

    
    public function getLunasByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM bayar_spp, data_siswa WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_spp.NIS ORDER BY data_siswa.kelas ASC, data_siswa.nama_kelas ASC, data_siswa.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getBelumLunasByBulanTahun($bulan,$tahun){
        $sql = "SELECT * FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_spp WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.NIS = bayar_spp.NIS) AND data_siswa.kelas != 99 ORDER BY data_siswa.kelas ASC, data_siswa.nama_kelas ASC, data_siswa.NIS DESC";
        return $this->db->query($sql)->result();
    }

    public function getSPPTerbayar($bulan,$tahun){
        $sql = "SELECT SUM(bayar_spp.jumlah) as total FROM bayar_spp, data_siswa WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_spp.NIS";
        return $this->db->query($sql)->row();
    }

    public function getSPPTerbayarByTanggal($bulan,$tahun){
        $sql = "SELECT SUM(bayar_spp.jumlah) as total FROM bayar_spp, data_siswa WHERE SUBSTRING(bayar_spp.tanggal_bayar_spp, -4) = $tahun AND SUBSTRING(bayar_spp.tanggal_bayar_spp, -7, 2) = $bulan AND data_siswa.NIS = bayar_spp.NIS";
        return $this->db->query($sql)->row();
    }

    public function getAllSPPTerbayar(){
        $sql = "SELECT SUM(bayar_spp.jumlah) as total FROM bayar_spp";
        return $this->db->query($sql)->row();
    }

    public function getSPPBelumTerbayar($bulan,$tahun){
        $sql = "SELECT SUM(data_siswa.biaya_spp) as total FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_spp WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.NIS = bayar_spp.NIS) AND data_siswa.kelas != 99";
        return $this->db->query($sql)->row();
    }

    public function getRekapSPPTerbayar($bulan,$tahun){
        $sql = "SELECT CONCAT('SPP (', COUNT(bayar_spp.NIS), ' Siswa)') as uraian,'' as jumlah, SUM(bayar_spp.jumlah) as total FROM bayar_spp, data_siswa WHERE bayar_spp.bulan_spp = $bulan AND bayar_spp.tahun_spp = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_spp.NIS";
        return $this->db->query($sql)->row();
    }

    public function getRekapSPPBelumTerbayar($bulan,$tahun){
        $sql = "SELECT CONCAT('SPP (', COUNT(data_siswa.NIS), ' Siswa)') as uraian,'' as jumlah, SUM(data_siswa.biaya_spp) as total FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_spp WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.NIS = bayar_spp.NIS) AND data_siswa.kelas != 99";
        return $this->db->query($sql)->row();
    }

    public function getRekapSPPTerbayarGroupKelas($bulan,$tahun){
        $sql = "SELECT CONCAT('SPP Kelas ', data_siswa.kelas,data_siswa.nama_kelas ,' (', COUNT(bayar_spp.NIS), ' Siswa)') as uraian,SUM(bayar_spp.jumlah) as jumlah, '' as total, CONCAT(data_siswa.kelas,data_siswa.nama_kelas) as kode_kelas FROM bayar_spp, data_siswa WHERE bayar_spp.bulan_spp = $bulan AND bayar_spp.tahun_spp = $tahun AND data_siswa.kelas != 99 AND data_siswa.NIS = bayar_spp.NIS GROUP BY data_siswa.kelas, data_siswa.nama_kelas";
        return $this->db->query($sql)->result();
    }

    public function getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun){
        $sql = "SELECT CONCAT('SPP Kelas ', data_siswa.kelas,data_siswa.nama_kelas ,' (', COUNT(data_siswa.NIS), ' Siswa)') as uraian,SUM(data_siswa.biaya_spp) as jumlah, '' as total, CONCAT(data_siswa.kelas,data_siswa.nama_kelas) as kode_kelas FROM data_siswa WHERE NOT EXISTS (SELECT * FROM bayar_spp WHERE bulan_spp = $bulan AND tahun_spp = $tahun AND data_siswa.NIS = bayar_spp.NIS) AND data_siswa.kelas != 99 GROUP BY data_siswa.kelas, data_siswa.nama_kelas";
        return $this->db->query($sql)->result();
    }
   
}
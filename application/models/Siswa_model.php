<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    private $_table = "data_siswa";
    public $nis;
    public $nama_siswa;
    public $kelas;
    public $nama_kelas;
    public $biaya_spp;

    
    public function rules()
    {
        return [
             ['field' => 'nis',
            'label' => 'NIS',
            'rules' => 'required'],

            ['field' => 'nama_siswa',
            'label' => 'Nama_siswa',
            'rules' => 'required'],

            ['field' => 'kelas',
            'label' => 'Kelas',
            'rules' => 'required|numeric'],

            ['field' => 'biaya_spp',
            'label' => 'Biaya_spp',
            'rules' => 'required|numeric']
        ];
    }

    public function rulesSetSPP()
    {
        return [
           ['field' => 'kelas',
            'label' => 'Kelas',
            'rules' => 'required|numeric'],

            ['field' => 'biaya_spp',
            'label' => 'Biaya_spp',
            'rules' => 'required|numeric']
        ];
    }

    public function getAll()
    {
        $sql = "SELECT * , CONCAT(kelas,nama_kelas) as kelas_nama FROM data_siswa WHERE kelas != 99 ORDER BY kelas, nama_kelas, nama_siswa ASC";
        return $this->db->query($sql)->result();
        // $this->db->select("*");
        // $this->db->where("kelas !=", 99);
        // $this->db->order_by("data_siswa.kelas, data_siswa.nama_siswa", "ASC");             
        // return $this->db->get("data_siswa")->result();
    }
    
    public function getByNIS($id)
    {
        return $this->db->get_where($this->_table, ["nis" => $id])->row();
    }

    public function cekNIS($id)
    {
        return $this->db->get_where($this->_table, ["nis" => $id])->num_rows();
    }

    public function getSiswaByKelas()
    {
        $post = $this->input->post();
        $kelas = $post["kelas"];
        $nama_kelas = $post["nama_kelas"];
         
        if(($kelas == 0) AND ($nama_kelas == "")){
            //00
            $sql = "SELECT * , CONCAT(kelas,nama_kelas) as kelas_nama FROM data_siswa WHERE kelas != 99 ORDER BY kelas, nama_kelas, nama_siswa ASC";
            return $this->db->query($sql)->result();
        }else if(($kelas == 0) AND ($nama_kelas != "")){
            //01
            $sql = "SELECT * , CONCAT(kelas,nama_kelas) as kelas_nama FROM data_siswa WHERE kelas != 99 AND nama_kelas = '{$nama_kelas}' ORDER BY kelas, nama_kelas, nama_siswa ASC";
            return $this->db->query($sql)->result();
        }else if(($kelas != 0)AND($nama_kelas == "")){
            //10
            $sql = "SELECT * , CONCAT(kelas,nama_kelas) as kelas_nama FROM data_siswa WHERE kelas = $kelas ORDER BY kelas, nama_kelas, nama_siswa ASC";
            return $this->db->query($sql)->result();
        }else if(($kelas != 0)AND($nama_kelas != "")){
            //11
            $sql = "SELECT * , CONCAT(kelas,nama_kelas) as kelas_nama FROM data_siswa WHERE kelas = $kelas AND nama_kelas = '{$nama_kelas}' ORDER BY kelas, nama_kelas, nama_siswa ASC";
            return $this->db->query($sql)->result();
        }

    }

    public function naikKelas()
    {
        $siswa = $this->getAll();
        foreach ($siswa as $siswa) {
            if ($siswa->kelas != 99){
                if($siswa->kelas == 6){
                    $this->db->set("kelas", 99);
                    $this->db->where("NIS", $siswa->NIS);
                    $this->db->update("data_siswa");
                }else{
                    $this->db->set("kelas", ($siswa->kelas)+1);
                    $this->db->where("NIS", $siswa->NIS);
                    $this->db->update("data_siswa");    
                }
                
            }
        }

    }

    public function save()
    {
        $post = $this->input->post();
        $this->nis = $post["nis"];
        $this->nama_siswa = $post["nama_siswa"];
        $this->kelas = $post["kelas"];
        $this->nama_kelas = $post["nama_kelas"];
        $this->biaya_spp = $post["biaya_spp"];
        $this->db->insert($this->_table, $this);
    }

    public function update($nis)
    {
        $post = $this->input->post();

         $this->db->set("nama_siswa", $post["nama_siswa"]);
         $this->db->set("kelas", $post["kelas"]);
         $this->db->set("nama_kelas", $post["nama_kelas"]);
         $this->db->set("biaya_spp", $post["biaya_spp"]);
         $this->db->where("NIS", $nis);
         $this->db->update("data_siswa");

    }

    public function updateSPP()
    {
        $post = $this->input->post();

        // $this->nis = "1";
        // $this->nama_siswa = "memet";
        // $this->kelas = $post["kelas"];
        // $this->biaya_spp = $post["biaya_spp"];
        // $this->db->update($this->_table, $this, array('NIS' => "1"));

         $this->db->set("biaya_spp", $post["biaya_spp"], FALSE);
         $this->db->where("kelas", $post["kelas"]);
         $this->db->update('data_siswa');
        
        
        // $this->kelas = $post["kelas"];
         //$this->biaya_spp = $post["biaya_spp"];
         //$this->db->update($this->_table, $this, array('kelas' => $post['kelas']));
    }

    public function delete($nis)
    {
        return $this->db->delete($this->_table, array("nis" => $nis));
    }


    private $_batchImport;
 
    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
 
    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('data_siswa', $data);
    }
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.NIS', 'e.nama_siswa', 'e.kelas', 'e.nama_kelas', 'e.biaya_spp'));
        $this->db->from('data_siswa as e');
        $query = $this->db->get();
        return $query->result_array();
    }
}
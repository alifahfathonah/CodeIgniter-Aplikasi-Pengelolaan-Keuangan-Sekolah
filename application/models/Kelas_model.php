<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $_table = "kelas";

    public $id_kelas;
    public $nama_kelas;
    public $biaya_spp;
    
    public function rules()
    {
        return [
           ['field' => 'nama_kelas',
            'label' => 'Nama_kelas',
            'rules' => 'required'],

            ['field' => 'biaya_spp',
            'label' => 'Biaya_spp',
            'rules' => 'required']

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_kelas" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nama_kelas = $post["nama_kelas"];
        $this->biaya_spp = $post["biaya_spp"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_kelas = $post["id_kelas"];
        $this->nama_kelas = $post["nama_kelas"];
        $this->biaya_spp = $post["biaya_spp"];
        $this->db->update($this->_table, $this, array('id_kelas' => $post['id_kelas']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_kelas" => $id));
    }
}
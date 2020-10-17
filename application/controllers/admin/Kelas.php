<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("kelas_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }

    public function index()
    {
        $data["kelas"] = $this->kelas_model->getAll();
        $this->load->view("admin/kelas/list_kelas", $data);
    }

    public function add()
    {
        $kelas = $this->kelas_model;
        $validation = $this->form_validation;
        $validation->set_rules($kelas->rules());

        if ($validation->run()) {
            $kelas->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/kelas/tambah_kelas");
    }

    public function edit($id)
    {
        if (!isset($id)) redirect('admin/kelas');
       
        $kelas = $this->kelas_model;
        $validation = $this->form_validation;
        $validation->set_rules($kelas->rules());

        if ($validation->run()) {
            $kelas->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["kelas"] = $kelas->getById($id);
        if (!$data["kelas"]) show_404();
        
        $this->load->view("admin/kelas/edit_kelas", $data);
    }

   

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->kelas_model->delete($id)) {
            redirect(site_url('admin/kelas'));
        }
    }
}
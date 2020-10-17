<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        // jika form login disubmit
        if($this->input->post()){
            if($this->user_model->doLogin()) redirect(site_url('admin'));
        }

        // tampilkan halaman login
        $this->load->view("login_page.php");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }





    // public function index()
    // {
    //     $user_model = $this->user_model;
    //     // jika form login disubmit
    //     $validation = $this->form_validation;
    //     $validation->set_rules($user_model->rules());
    //     if ($validation->run()) {
    //     //if($this->input->post()){
    //         $isUser = $this->user_model->cekUser();
    //         if($isUser){
                
    //             $user = $this->user_model->getUser();
    //              // login sukses yay!
    //             $this->session->set_userdata(['user_logged' => $user]);
    //             //$this->session->set_userdata('username', 'tedgfds');
    //             $user_masuk = array(
    //                  'id'  => $user->user_id,
    //                  'username'  => $user->username,
    //                  'password'  => $user->password,
    //                  'role'  => $user->role,
    //              );
    //             $this->session->set_userdata($user_masuk);


    //             if($user->role == 1){
    //                 redirect(site_url('admin'));
    //                 $this->session->set_flashdata('error', 'NIS tidak ditemukan');      
    //             }elseif ($user->role == 99) {
    //                 redirect(site_url('super_admin'));
    //             }     
    //         }
            
    //     }


    //     // tampilkan halaman login
    //     $this->load->view("login");
    // }

    // public function logout()
    // {
    //     // hancurkan semua sesi
    //     $this->session->sess_destroy();
    //     redirect(site_url('login'));
    // }
}
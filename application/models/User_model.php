<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

     public function rules()
    {
        return [
            
             ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required']

        ];
    }


    public function doLogin(){
        $post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('username', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);

            // jika password benar dan dia admin
            if($isPasswordTrue){ 
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                $user_masuk = array(
                     'id'  => $user->user_id,
                     'username'  => $user->username,
                     'password'  => $user->password,
                     'role'  => $user->role,
                 );
                $this->session->set_userdata($user_masuk);

                
                // $this->_updateLastLogin($user->user_id);
                return true;
            }else{
                $this->session->set_flashdata('error', 'Password salah');
            }
        }else{
            $this->session->set_flashdata('error', 'username salah');
        }
        
        // login gagal
        return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    public function update($no){
        $post = $this->input->post();


        $this->db->where('user_id', $no);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);

            // jika password benar
            if($isPasswordTrue){ 
                // password true
                $password = $post["password"];
                $password_baru = $post["password_baru"];
                if($password_baru == ""){
                    $this->db->set("username", $post["username"]);
                    $this->db->where("user_id", $no, FALSE);
                    $this->db->update('user');
                    $this->session->set_userdata('username', $post["username"]);
                    $this->session->set_flashdata('success', 'Perubahan berhasil');
                }else{
                    $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $this->db->set("username", $post["username"]);
                    $this->db->set("password", $password_baru_hash);
                    $this->db->where("user_id", $no, FALSE);
                    $this->db->update('user');
                    $this->session->set_userdata('username', $post["username"]);
                    $this->session->set_userdata('password', $password_baru);
                    $this->session->set_flashdata('success', 'Perubahan berhasil');
                }
                
            }else{
                $this->session->set_flashdata('error', 'Password salah');
            }
        }else{
            $this->session->set_flashdata('error', 'user tidak ditemukan');
        }

    }

    public function getUser(){
        // cari user berdasarkan email dan username
        $post = $this->input->post();
        $this->db->select("*");
        $this->db->where("username", $post['username']);
        return $this->db->get("user")->row();  
    }

    public function getUser1($id){
        // cari user berdasarkan email dan username
        $post = $this->input->post();
        $this->db->select("*");
        $this->db->where("user_id", $id);
        return $this->db->get("user")->row();  
    }

// }





    // public function cekUser(){
    //     $post = $this->input->post();
    //     $this->db->select("*");
    //     $this->db->where("username", $post["username"]);
    //     $this->db->where("password", $post["password"]);
    //     $user = $this->db->get("user")->num_rows();
    //     if($user > 0){
    //         return true;
    //     }else{
    //         false;
    //     }

    // }

    // public function getUser(){
    //     // cari user berdasarkan email dan username
    //     $post = $this->input->post();
    //     $this->db->select("*");
    //     $this->db->where("username", $post['username']);
    //     return $this->db->get("user")->row();  
    // }

    // public function getUser1($id){
    //     // cari user berdasarkan email dan username
    //     $post = $this->input->post();
    //     $this->db->select("*");
    //     $this->db->where("user_id", $id);
    //     return $this->db->get("user")->row();  
    // }

   

    // public function isNotLogin(){
    //     return $this->session->userdata('user_logged') === null;
    // }

    // public function update($no){
    //     $post = $this->input->post();
    //     $password = $post["password"];
    //     $password_baru = $post["password_baru"];
    //     $sql = "SELECT * FROM user WHERE user_id = $no AND password LIKE '{$password}'";
    //     $user = $this->db->query($sql)->num_rows();
    //     if($user > 0){
    //         if($password_baru == ""){
    //             $this->db->set("username", $post["username"]);
    //             $this->db->where("user_id", $no, FALSE);
    //             $this->db->update('user');
    //             $this->session->set_userdata('username', $post["username"]);
    //             $this->session->set_flashdata('success', 'Perubahan berhasil');
    //         }else{
    //             $this->db->set("username", $post["username"]);
    //             $this->db->set("password", $password_baru);
    //             $this->db->where("user_id", $no, FALSE);
    //             $this->db->update('user');
    //             $this->session->set_userdata('username', $post["username"]);
    //             $this->session->set_userdata('password', $password_baru);
    //             $this->session->set_flashdata('success', 'Perubahan berhasil');
    //         }
            



    //     }else{
    //         $this->session->set_flashdata('error', 'Password Salah');
    //     }

    // }


}

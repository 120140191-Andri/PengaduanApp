<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
        $this->load->model('users_model');

    }

	public function index()
	{
		$this->load->helper('url');

        if($this->session->userdata('is_login') == TRUE){
            if($this->session->userdata('id') != ''){
  
              if($this->session->userdata('r') == 'rt'){
                  redirect('/Rt');
              }elseif($this->session->userdata('r') == 'kalab'){
                  redirect('/Kalab');
              }elseif($this->session->userdata('r') == 'teknisi'){
                  redirect('/Teknisi');
              }
  
            }
        }

		$this->load->view('Login');
	}

    public function cek_login(){
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $res = $this->users_model->CekLogin($email, $pass);

        if($res == 'ok'){
            redirect('/');
        }else{
            $this->session->set_flashdata('pesan', 'Login gagal!');
            redirect('/');
        }
    }

	public function logout() {

        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('r');
    
        session_destroy();
        //$this->session->set_flashdata('pesan', 'Sign Out Berhasil!');
        redirect('/');
    }

}

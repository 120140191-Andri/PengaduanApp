<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalab extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
		$this->load->model('users_model');

        if($this->session->userdata('is_login') == TRUE){
            if($this->session->userdata('id') != ''){
  
              if($this->session->userdata('r') == 'rt'){
                  redirect('/Rt');
              }elseif($this->session->userdata('r') == 'kalab'){
                  
              }elseif($this->session->userdata('r') == 'teknisi'){
                  redirect('/Teknisi');
              }else{
                redirect('/');
              }
  
            }else{
                redirect('/');
            }
        }else{
            redirect('/');
        }
    }

	public function index()
	{
		$this->load->helper('url');
		if($this->session->userdata('id_lab') == 0){
			$this->load->view('Kalab/labkosong');
		}else{
			$this->load->view('Kalab/Dashboard');
		}
	}

	public function List_Teknisi(){
        $this->load->helper('url');

		$id_lab = $this->session->userdata('id_lab');
        $dat['teknisi'] = $this->users_model->AmbilSemuaUserTeknisiLab($id_lab)->result();
        // var_dump($dat);
        // die;
        $this->load->view('Kalab/ListTeknisi', $dat);
    }

	public function Tambah_Teknisi(){
        $this->load->helper('url');
        //echo password_hash('1234',PASSWORD_DEFAULT);
        $this->load->view('Kalab/TambahTeknisi');
    }

	public function sys_tambah_teknisi(){
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $cek = count($this->users_model->CekEmailUserTambah($email)->result());
        if($cek == 0){
			$id_lab = $this->session->userdata('id_lab');
            $res = $this->users_model->TambahTeknisi($nama, $email, $id_lab);
            redirect('Kalab/List_Teknisi');
        }else{
            $this->session->set_flashdata('pesan', 'Email Sudah Terdaftar!');
            redirect('Kalab/Tambah_Teknisi');
        }
    }

	public function Ubah_Teknisi($id){
        $this->load->helper('url');

        $dat['id'] = $id;
        $dat['user_n'] = $this->users_model->AmbilUserWhr($id)->result();
        // var_dump($dat);
        // die;
        $this->load->view('Kalab/UbahTeknisi', $dat);
    }

	public function sys_ubah_teknisi(){
        $nama = $this->input->post('nama');
        $id = $this->input->post('id');
        $email = $this->input->post('email');

        $cek = count($this->users_model->CekEmailUser($email, $id)->result());
        if($cek == 0){
            $res = $this->users_model->UbahTeknisi($nama, $id, $email);
            redirect('Kalab/List_Teknisi');
        }else{
            $this->session->set_flashdata('pesan', 'Email Sudah Terdaftar!');
            redirect('Kalab/Ubah_Teknisi/'.$id);
        }
    }

	public function sys_hapus_teknisi($id){
        $res = $this->users_model->HapusTeknisi($id);
        redirect('Kalab/List_Teknisi');
    }

}

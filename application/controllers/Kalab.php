<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalab extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
		$this->load->model('users_model');
        $this->load->model('lab_model');

        if($this->session->userdata('is_login') == TRUE){
            if($this->session->userdata('id') != ''){
  
              if($this->session->userdata('r') == 'rt'){
                  redirect('/Rt');
              }elseif($this->session->userdata('r') == 'kalab'){
                  
                $idu = $this->session->userdata('id');
                $dat = $this->users_model->AmbilUserWhr($idu)->result();

                if($dat[0]->id_lab == 0){
                    redirect('/Login/logout');
                }

                if($dat[0]->id_lab != $this->session->userdata('id_lab')){
                    redirect('/Login/logout');
                }

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

    public function Manage_lab(){
        $this->load->helper('url');
		if($this->session->userdata('id_lab') == 0){
			$this->load->view('Kalab/labkosong');
		}else{
            $id_lab = $this->session->userdata('id_lab');

            $dats['id_lab'] = $id_lab;
            $dats['nama_lab'] = $this->lab_model->AmbilNamaLab($id_lab);
			$this->load->view('Kalab/Manage_Lab', $dats);
		}
    }

    public function ambil_properti(){
        $id_lab = $this->input->post('id_lab');
		$res = $this->properti_model->AmbilProperti($id_lab)->result();
		echo json_encode($res);
	}

	public function tambah_properti(){
		$nama = $this->input->post('nama_prop');
		$x = $this->input->post('xPos');
		$y = $this->input->post('yPos');
        $id_lab = $this->input->post('id_lab');
		$cek = count($this->properti_model->CekProperti($nama)->result());
		if($cek == 0){
			$res = $this->properti_model->TambahProperti($nama, $x, $y, $id_lab);
			var_dump($res);
		}else{
			echo 'ada';
		}
	}

	public function ubah_properti(){
		$nama = $this->input->post('nama_prop');
		$x = $this->input->post('xPos');
		$y = $this->input->post('yPos');
		$res = $this->properti_model->UbahProperti($nama, $x, $y);
		var_dump($res);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
        $this->load->model('lab_model');
        $this->load->model('users_model');

        if($this->session->userdata('is_login') == TRUE){
            if($this->session->userdata('id') != ''){
  
              if($this->session->userdata('r') == 'rt'){
                  
              }elseif($this->session->userdata('r') == 'kalab'){
                  redirect('/Kalab');
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
		$this->load->view('Rt/Dashboard');
	}

    public function List_lab(){
        $this->load->helper('url');

        $dat['lab'] = $this->lab_model->AmbilLab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/ListLab', $dat);
    }

    public function List_Kalab(){
        $this->load->helper('url');

        $dat['kalab'] = $this->users_model->AmbilSemuaUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/ListKalab', $dat);
    }

    public function Tambah_Lab(){
        $this->load->helper('url');

        $dat['kalab'] = $this->users_model->AmbilUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/TambahLab', $dat);
    }

    public function Tambah_Kalab(){
        $this->load->helper('url');
        //echo password_hash('1234',PASSWORD_DEFAULT);
        $this->load->view('Rt/TambahKalab');
    }

    public function Ubah_Lab($id){
        $this->load->helper('url');

        $dat['id'] = $id;
        $dat['lab_n'] = $this->lab_model->AmbilLabWhr($id)->result();
        $dat['kalab'] = $this->users_model->AmbilUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/UbahLab', $dat);
    }

    public function Ubah_Kalab($id){
        $this->load->helper('url');

        $dat['id'] = $id;
        $dat['user_n'] = $this->users_model->AmbilUserWhr($id)->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/UbahKalab', $dat);
    }

    public function sys_tambah_lab(){
        $nama = $this->input->post('nama_lab');
        $id = $this->input->post('kalab');

        $cek = count($this->lab_model->CekLab($nama)->result());
        if($cek == 0){
            $res = $this->lab_model->TambahLab($nama, $id);
            redirect('Rt/List_lab');
        }else{
            redirect('Rt/Tambah_lab');
        }
    }

    public function sys_tambah_kalab(){
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $cek = count($this->users_model->CekEmailUser($email)->result());
        if($cek == 0){
            $res = $this->users_model->TambahKalab($nama, $email);
            redirect('Rt/List_Kalab');
        }else{
            $this->session->set_flashdata('pesan', 'Email Sudah Terdaftar!');
            redirect('Rt/Tambah_Kalab');
        }

    }

    public function sys_ubah_lab(){
        $nama = $this->input->post('nama_lab');
        $id = $this->input->post('kalab');
        $id_lab = $this->input->post('id_lab');

        $cek = count($this->lab_model->CekLab($nama, $id_lab)->result());
        if($cek == 0){
            $res = $this->lab_model->UbahLab($nama, $id, $id_lab);
            redirect('Rt/List_lab');
        }else{
            $this->session->set_flashdata('pesan', 'Nama Sudah Terdaftar!');
            redirect('Rt/List_lab');
        }

    }

    public function sys_ubah_kalab(){
        $nama = $this->input->post('nama');
        $id = $this->input->post('id');
        $email = $this->input->post('email');

        $cek = count($this->users_model->CekEmailUser($email, $id)->result());
        if($cek == 0){
            $res = $this->users_model->UbahKalab($nama, $id, $email);
            redirect('Rt/List_Kalab');
        }else{
            $this->session->set_flashdata('pesan', 'Nama Sudah Terdaftar!');
            redirect('Rt/Ubah_Kalab/'.$id);
        }

    }

	public function ambil_properti(){
		$res = $this->properti_model->AmbilProperti()->result();
		echo json_encode($res);
	}

	public function tambah_properti(){
		$id = $this->input->post('id');
		$x = $this->input->post('xPos');
		$y = $this->input->post('yPos');
		$cek = count($this->properti_model->CekProperti($id)->result());
		if($cek == 0){
			$res = $this->properti_model->TambahProperti($id, $x, $y);
			var_dump($res);
		}else{
			echo 'ada';
		}
	}

	public function ubah_properti(){
		$id = $this->input->post('id');
		$x = $this->input->post('xPos');
		$y = $this->input->post('yPos');
		$res = $this->properti_model->UbahProperti($id, $x, $y);
		var_dump($res);
	}

}

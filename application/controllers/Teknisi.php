<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknisi extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
		$this->load->model('users_model');
		$this->load->model('lab_model');
		$this->load->model('laporan_model');

        if($this->session->userdata('is_login') == TRUE){
            if($this->session->userdata('id') != ''){
  
              if($this->session->userdata('r') == 'rt'){
                  redirect('/Rt');
              }elseif($this->session->userdata('r') == 'kalab'){
                  redirect('/Kalab');
              }elseif($this->session->userdata('r') == 'teknisi'){

				$idu = $this->session->userdata('id');
                $dat = $this->users_model->AmbilUserWhr($idu)->result();

                if($dat[0]->id_lab == 0){
                    redirect('/Login/logout');
                }

                if($dat[0]->id_lab != $this->session->userdata('id_lab')){
                    redirect('/Login/logout');
                }
                  
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
			$this->load->view('Teknisi/labkosong');
		}else{
			$this->load->view('Teknisi/Dashboard');
		}
	}

	public function Manage_lab(){
        $this->load->helper('url');
		if($this->session->userdata('id_lab') == 0){
			$this->load->view('Teknisi/labkosong');
		}else{
            $id_lab = $this->session->userdata('id_lab');

            $dats['id_lab'] = $id_lab;
            $dats['nama_lab'] = $this->lab_model->AmbilNamaLab($id_lab);
			$this->load->view('Teknisi/Manage_Lab', $dats);
		}
    }

    public function ambil_properti(){
        $id_lab = $this->input->post('id_lab');
		$res = $this->properti_model->AmbilProperti($id_lab)->result();
		echo json_encode($res);
	}

	public function laporkan_properti($id_prop){

		$idu = $this->session->userdata('id');
		$dats['id_user'] = $idu;
		$dats['id_prop'] = $id_prop;
		$dats['prop_n'] = $this->properti_model->AmbilPropertiWhr($id_prop)->result();
		$dats['user_n'] = $this->users_model->AmbilUserWhr($idu)->result();

		$this->load->view('Teknisi/Laporkan_properti', $dats);

	}

	public function ubah_laporkan_properti($id_prop){

		$dats['id_prop'] = $id_prop;
		$dats['prop_n'] = $this->properti_model->AmbilPropertiWhr($id_prop)->result();
		$dats['laporan_n'] = $this->laporan_model->AmbilLaporanWhredt($id_prop)->result();
		$dats['user_n'] = $this->users_model->AmbilUserWhr($dats['laporan_n'][0]->id_teknisi)->result();

		$this->load->view('Teknisi/edit_Laporkan_properti', $dats);

	}

	public function sys_tambah_laporan(){
		$config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
		$image = $_FILES['foto']['tmp_name'];

		$this->load->library('upload', $config);
		$nama = './assets/foto/' . $_FILES['foto']['name'];

		$id_prop = $this->input->post('id_prop');
		$id_user = $this->input->post('id_user');
		$nama_pelapor = $this->input->post('nama_pelapor');
		$npm = $this->input->post('npm');
		$masalah = $this->input->post('masalah');

        if (move_uploaded_file($image,$nama)) {
            $namaFoto = $_FILES['foto']['name'];
			$this->laporan_model->TambahLaporanF($id_prop, $id_user, $nama_pelapor, $npm, $masalah, $namaFoto);
			redirect('Teknisi/Manage_lab');
        } else {
			$this->laporan_model->TambahLaporanNF($id_prop, $id_user, $nama_pelapor, $npm, $masalah);
			redirect('Teknisi/Manage_lab');
        }
	}

	public function sys_ubah_laporan(){
		$config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
		$image = $_FILES['foto']['tmp_name'];

		$this->load->library('upload', $config);
		$nama = './assets/foto/' . $_FILES['foto']['name'];

		$id_laporan = $this->input->post('id_laporan');
		$nama_pelapor = $this->input->post('nama_pelapor');
		$npm = $this->input->post('npm');
		$masalah = $this->input->post('masalah');

        if (move_uploaded_file($image,$nama)) {
            $namaFoto = $_FILES['foto']['name'];
			$this->laporan_model->EditLaporanF($id_laporan, $nama_pelapor, $npm, $masalah, $namaFoto);
			redirect('Teknisi/Manage_lab');
        } else {
			$this->laporan_model->EditLaporanNF($id_laporan, $nama_pelapor, $npm, $masalah);
			redirect('Teknisi/Manage_lab');
        }
	}

	public function sys_selesaikan_laporan()
	{
		$id_laporan = $this->input->post('id_laporan');
		$id_prop = $this->input->post('id_prop');
		$this->laporan_model->selesaikan_laporan($id_laporan, $id_prop);
		redirect('Teknisi/Manage_lab');
	}

	public function Ganti_Password(){
        $this->load->helper('url');

        $dat['id'] = $this->session->userdata('id');
        $this->load->view('Teknisi/GantiPassword', $dat);
    }

    public function sys_ganti_password(){
        $this->load->helper('url');

        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $this->users_model->GantiPassword($id, $password);

        redirect('Teknisi/');

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

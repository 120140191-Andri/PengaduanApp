<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('properti_model');
        $this->load->model('lab_model');
        $this->load->model('users_model');
        $this->load->model('laporan_model');

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
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

		$this->load->helper('url');
		$this->load->view('Rt/Dashboard', $dat);
	}

    public function tes(){
        $this->load->helper('url');
		$this->load->view('Rt/tes');
    }

    public function List_lab(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['lab'] = $this->lab_model->AmbilLab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/ListLab', $dat);
    }

    public function List_Kalab(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['kalab'] = $this->users_model->AmbilSemuaUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/ListKalab', $dat);
    }

    public function Tambah_Lab(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['kalab'] = $this->users_model->AmbilUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/TambahLab', $dat);
    }

    public function Tambah_Kalab(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');
        //echo password_hash('1234',PASSWORD_DEFAULT);
        $this->load->view('Rt/TambahKalab', $dat);
    }

    public function Ubah_Lab($id){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['id'] = $id;
        $dat['lab_n'] = $this->lab_model->AmbilLabWhr($id)->result();
        $dat['kalab'] = $this->users_model->AmbilUserKalab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/UbahLab', $dat);
    }

    public function Ubah_Kalab($id){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

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

        $cek = count($this->lab_model->CekLabTambah($nama)->result());
        if($cek == 0){
            $res = $this->lab_model->TambahLab($nama, $id);
            redirect('Rt/List_lab');
        }else{
            redirect('Rt/Tambah_lab');
        }
    }

    public function sys_tambah_kalab(){
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $cek = count($this->users_model->CekEmailUserTambah($email)->result());
        if($cek == 0){
            $res = $this->users_model->TambahKalab($nip, $nama, $email);
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
            $this->session->set_flashdata('pesan', 'Email Sudah Terdaftar!');
            redirect('Rt/Ubah_Kalab/'.$id);
        }

    }

    public function sys_hapus_kalab($id){
        $res = $this->users_model->HapusKalab($id);
        redirect('Rt/List_Kalab');
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

    public function Ganti_Password(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['id'] = $this->session->userdata('id');
        $this->load->view('Rt/GantiPassword', $dat);
    }

    public function sys_ganti_password(){
        $this->load->helper('url');

        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $this->users_model->GantiPassword($id, $password);

        redirect('Rt/');

    }

    function list_laporan()
    {
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $filter = $this->input->post('filter');

        $dat['lab'] = $this->lab_model->AmbilSemuaLab()->result();

        if($filter != null && $filter != 'Semua Lab'){

            $dat['laporan'] = $this->laporan_model->TampilLaporanFilterRT($filter)->result();
            $dat['fil'] = $filter;

            if($dat['laporan'] != null){
                $whr = array(
                    'id_lab' => $dat['laporan'][0]->id_lab,
                    'role' => 'kalab'
                );
    
                $this->db->where($whr);
                $dat['kalab'] = $this->db->get('users')->result();
            }else{
                $dat['kalab'] = null;
            }

            foreach ($dat['lab'] as $r){
                if($r->id == $filter){
                    $dat['fil_n'] = $r->nama_lab;
                }
            }

        }else{
            $dat['laporan'] = $this->laporan_model->TampilLaporanSemuaRT()->result();
            $dat['fil'] = 'all';
            $dat['kalab'] = null;
        }

        // var_dump($dat);
        // die;
        $this->load->view('Rt/List_Laporan', $dat);
    }

    function TTD_laporan()
    {
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $filter = $this->input->post('filter');

        if($filter != null){

            if($filter == 'dikirim'){
                $dat['laporan'] = $this->laporan_model->TampilTTDLaporanProsesRT()->result();
                $dat['fil'] = 'dikirim';
            }elseif($filter == 'dibalas'){
                $dat['laporan'] = $this->laporan_model->TampilTTDLaporanSelesaiRT()->result();
                $dat['fil'] = 'dibalas';
            }else{
                $dat['laporan'] = $this->laporan_model->TampilTTDLaporanSemuaRT()->result();
                $dat['fil'] = 'all';
            }

        }else{
            $dat['laporan'] = $this->laporan_model->TampilTTDLaporanSemuaRT()->result();
            $dat['fil'] = 'all';
        }

        // var_dump($dat);
        // die;
        $this->load->view('Rt/List_TTD_Laporan', $dat);
    }

    public function Tambah_TTD(){
        $dat['notif'] = count($this->laporan_model->TampilLaporanSemuaRT()->result());

        $this->load->helper('url');

        $dat['lab'] = $this->lab_model->AmbilSemuaLab()->result();
        // var_dump($dat);
        // die;
        $this->load->view('Rt/TambahTTD', $dat);
    }

    public function sys_tambah_TTD(){
        $idlab = $this->input->post('idlab');
        $pesan = $this->input->post('pesan');

        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
		$image = $_FILES['file']['tmp_name'];

        $this->load->library('upload', $config);
		$nama = './assets/dokumen/' . $_FILES['file']['name'];

        if (move_uploaded_file($image,$nama)) {
            $namaFile = $_FILES['file']['name'];
			$this->laporan_model->TambahTTD($idlab, $pesan, $namaFile);
			redirect('Rt/TTD_Laporan');
        } else {
			redirect('Rt/TTD_Laporan');
        }
        
    }

}

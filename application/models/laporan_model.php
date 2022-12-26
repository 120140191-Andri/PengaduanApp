<?php
Class laporan_model extends CI_Model
{
    
    function TambahLaporanNF($id_prop, $id_teknisi, $nama, $npm, $masalah)
    {
        $dat = array(
            'id_prop' => $id_prop,
            'id_teknisi' => $id_teknisi,
            'nama_pelapor' => $nama,
            'npm' => $npm,
            'masalah' => $masalah,
        );

        $this->db->insert('laporan',$dat);

        $this->db->set('status', 'problem');
        $this->db->where('id', $id_prop);
        $this->db->update('properti');

        return $this->db->error();
    }

    function TambahLaporanF($id_prop, $id_teknisi, $nama, $npm, $masalah, $foto)
    {
        $dat = array(
            'id_prop' => $id_prop,
            'id_teknisi' => $id_teknisi,
            'nama_pelapor' => $nama,
            'npm' => $npm,
            'masalah' => $masalah,
            'foto_bukti' => $foto
        );

        $this->db->insert('laporan',$dat);

        $this->db->set('status', 'problem');
        $this->db->where('id', $id_prop);
        $this->db->update('properti');

        return $this->db->error();
    }

    function EditLaporanNF($id_laporan, $nama, $npm, $masalah)
    {
        $dat = array(
            'nama_pelapor' => $nama,
            'npm' => $npm,
            'masalah' => $masalah,
        );

        $this->db->set($dat);
        $this->db->where('id', $id_laporan);
        $this->db->update('laporan');

        return $this->db->error();
    }

    function EditLaporanF($id_laporan, $nama, $npm, $masalah, $foto)
    {

        $dat = array(
            'nama_pelapor' => $nama,
            'npm' => $npm,
            'masalah' => $masalah,
            'foto_bukti' => $foto,
        );

        $this->db->set($dat);
        $this->db->where('id', $id_laporan);
        $this->db->update('laporan');

        return $this->db->error();
    }

    function selesaikan_laporan($id_laporan, $id_prop)
    {
        $this->db->set('status', 'selesai');
        $this->db->where('id', $id_laporan);
        $this->db->update('laporan');

        $this->db->set('status', 'aman');
        $this->db->where('id', $id_prop);
        $this->db->update('properti');
    }

    function AmbilLaporanWhredt($id)
    {
        $dat = array(
            'id_prop' => $id,
            'status !=' => 'selesai',
        );
        $this->db->where($dat);
        $res = $this->db->get('laporan');
        return $res;
    }

    function TampilLaporanProses()
    {
        $dat = array(
            'laporan.status' => 'diproses',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanFilterRT($fil)
    {
        $dat = array(
            'properti.id_lab' => $fil,
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->join('lab', 'lab.id = properti.id_lab');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanProsesRT()
    {
        $dat = array(
            'ttd_laporan.status' => 'dikirim',
        );

        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->where($dat);
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanProses()
    {
        $dat = array(
            'ttd_laporan.status' => 'dikirim',
            'lab.id' => $this->session->userdata('id_lab'),
        );

        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->where($dat);
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSelesai()
    {
        $dat = array(
            'laporan.status' => 'selesai',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSelesaiRT()
    {
        $dat = array(
            'laporan.status' => 'selesai',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->join('lab', 'lab.id = properti.id_lab');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanSelesaiRT()
    {
        $dat = array(
            'ttd_laporan.status' => 'dibalas',
        );

        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->where($dat);
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanSelesai()
    {
        $dat = array(
            'ttd_laporan.status' => 'dibalas',
            'lab.id' => $this->session->userdata('id_lab'),
        );

        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->where($dat);
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSemua()
    {
        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanValid()
    {
        $dat = array(
            'laporan.status' => 'divalidasi',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSemuaRT()
    {
        $dat = array(
            'laporan.status' => 'divalidasi',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->join('lab', 'lab.id = properti.id_lab');
        $this->db->order_by('laporan.id', 'DESC');
        $this->db->where($dat);
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanSemuaRT()
    {
        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilTTDLaporanSemua()
    {
        $dat = array(
            'lab.id' => $this->session->userdata('id_lab'),
        );

        $this->db->select('*, ttd_laporan.created_at AS tgl_laporan, laporan.status AS status_laporan, laporan.id AS id_laporan, ttd_laporan.id AS id_ttd');
        $this->db->from('ttd_laporan');
        $this->db->join('lab', 'lab.id = ttd_laporan.id_lab');
        $this->db->where($dat);
        $this->db->order_by('ttd_laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TambahTTD($idlab, $pesan, $file)
    {
        $dat = array(
            'pesan' => $pesan,
            'id_lab' => $idlab,
            'file_rt' => $file,
        );

        $this->db->insert('ttd_laporan',$dat);

        return $this->db->error();
    }

    function BalasTTD($id, $file)
    {
        $dat = array(
            'file_kaleb' => $file,
            'status' => 'dibalas'
        );

        $this->db->set($dat);
        $this->db->where('id', $id);
        $this->db->update('ttd_laporan');

        return $this->db->error();
    }

    function validasi($id){
        $dat = array(
            'status' => 'divalidasi',
        );

        $this->db->set($dat);
        $this->db->where('id', $id);
        $this->db->update('laporan');
    
    }
    
}
?>
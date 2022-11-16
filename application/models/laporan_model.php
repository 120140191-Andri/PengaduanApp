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

        $this->db->select('*, laporan.created_at AS tgl_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSelesai()
    {
        $dat = array(
            'laporan.status' => 'selesai',
        );

        $this->db->select('*, laporan.created_at AS tgl_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->where($dat);
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }

    function TampilLaporanSemua()
    {
        $this->db->select('*, laporan.created_at AS tgl_laporan');
        $this->db->from('laporan');
        $this->db->join('properti', 'properti.id = laporan.id_prop');
        $this->db->join('users', 'users.id = laporan.id_teknisi');
        $this->db->order_by('laporan.id', 'DESC');
        $res = $this->db->get();
        return $res;
    }
    
}
?>
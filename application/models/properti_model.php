<?php
Class properti_model extends CI_Model
{
    function AmbilProperti($id_lab)
    {
        $whr = array(
            'id_lab' => $id_lab,
        );

        $this->db->where($whr);
        $res = $this->db->get('properti');
        return $res;
    }

    function CekProperti($nama)
    {
        $dat = array(
            'nama_prop' => $nama,
        );

        $res = $this->db->get_where('properti', $dat);
        return $res;
    }

    function CekNamaProperti($nama, $id)
    {
        $dat = array(
            'nama_prop' => $nama,
            'id !=' => $id
        );

        $res = $this->db->get_where('properti', $dat);
        return $res;
    }
    
    function TambahProperti($nama, $x, $y, $id_lab)
    {
        $dat = array(
            'nama_prop' => $nama,
            'xPos' => $x,
            'yPos' => $y,
            'id_lab' => $id_lab,
        );

        $this->db->insert('properti',$dat);
        return $this->db->error();
    }

    function UbahProperti($nama, $x, $y)
    {
        $this->db->set('xPos', $x);
        $this->db->set('yPos', $y);
        $this->db->where('nama_prop', $nama);
        $this->db->update('properti');
        return $this->db->error();
    }

    function UbahNamaProperti($nama, $id)
    {
        $this->db->set('nama_prop', $nama);
        $this->db->where('id', $id);
        $this->db->update('properti');
        return $this->db->error();
    }

    function AmbilPropertiWhr($id)
    {
        $dat = array(
            'id' => $id,
        );
        $this->db->where($dat);
        $res = $this->db->get('properti');
        return $res;
    }

    function HapusProperti($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('properti');

        return $this->db->error();
    }

    // function TampilMahasiswa() 
    // {
    //     $this->db->order_by('nim', 'ASC');
    //     return $this->db->from('mahasiswa')
    //       ->get()
    //       ->result();
    // }

    // function Getnim($nim = '')
    // {
    //   return $this->db->get_where('mahasiswa', array('nim' => $nim))->row();
    // }

    // function HapusMahasiswa($nim)
    // {
    //     $this->db->delete('mahasiswa',array('nim' => $nim));
    // }
}
?>
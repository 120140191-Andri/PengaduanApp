<?php
Class lab_model extends CI_Model
{
    function AmbilLab()
    {
        $this->db->from('lab');
        $this->db->join('users', 'users.id = lab.id_user', 'left');
        $res = $this->db->get();
        return $res;
    }

    function CekProperti($id)
    {
        $dat = array(
            'id' => $id,
        );

        $res = $this->db->get_where('properti', $dat);
        return $res;
    }

    function CekLab($nama)
    {
        $dat = array(
            'nama_lab' => $nama,
        );

        $res = $this->db->get_where('lab', $dat);
        return $res;
    }
    
    function TambahLab($nama, $id)
    {
        $dat = array(
            'nama_lab' => $nama,
            'id_user' => $id,
        );

        $this->db->insert('lab',$dat);
        return $this->db->error();
    }

    function UbahProperti($id, $x, $y)
    {
        $this->db->set('xPos', $x);
        $this->db->set('yPos', $y);
        $this->db->where('id', $id);
        $this->db->update('properti');
        return $this->db->error();
    }
}
?>
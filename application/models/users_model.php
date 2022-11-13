<?php
Class users_model extends CI_Model
{
    function CekLogin($email, $pass)
    {
        $dat = array(
            'email' => $email,
        );

        $jum = $this->db->get_where('users', $dat)->num_rows();

        if($jum == 1){
            $res = $this->db->get_where('users', $dat)->result();
            
            if(password_verify($pass,$res[0]->password)){
                $data_login = array(
                    'is_login' => TRUE,
                    'email'    => $res[0]->email,
                    'id'       => $res[0]->id,
                    'r'        => $res[0]->role,
                );
             
                $this->session->set_userdata($data_login);

                return 'ok';
            }else{
                return 'no';
            }

        }else{
            return 'no';
        }
        
    }

    function AmbilUserKalab()
    {
        $dat = array(
            'role' => 'kalab',
            'lab.id_user' => null,
        );

        $this->db->from('lab');
        $this->db->join('users', 'users.id = lab.id_user', 'right');
        $this->db->where($dat);
        $res = $this->db->get();
        return $res;
    }

    function AmbilSemuaUserKalab()
    {
        $dat = array(
            'role' => 'kalab',
        );

        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function CekEmailUser($email, $id)
    {
        $dat = array(
            'email' => $email,
            'id !=' => $id,
        );

        $res = $this->db->get_where('users', $dat);
        return $res;
    }

    function TambahKalab($nama, $email)
    {
        $dat = array(
            'nama' => $nama,
            'email' => $email,
            'role' => 'kalab',
        );

        $this->db->insert('users',$dat);
        return $this->db->error();
    }

    function AmbilUserWhr($id)
    {
        $dat = array(
            'id' => $id,
        );
        $this->db->where($dat);
        $res = $this->db->get('users');
        return $res;
    }

    function UbahKalab($nama, $id, $email)
    {
        $dat = array(
            'nama' => $nama,
            'email' => $email,
        );

        $whr = array(
            'id' => $id,
        );

        $this->db->where($whr);
        $this->db->set($dat);
        $this->db->update('users');
        return $this->db->error();
    }

    function AmbilProperti()
    {
        $res = $this->db->get('properti');
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
    
    function TambahProperti($id, $x, $y)
    {
        $dat = array(
            'id' => $id,
            'xPos' => $x,
            'yPos' => $y,
        );

        $this->db->insert('properti',$dat);
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
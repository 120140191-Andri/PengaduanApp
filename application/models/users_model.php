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
        );
        $res = $this->db->get_where('users', $dat);
        return $res;
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
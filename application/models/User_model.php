<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() !== 1) {
            return false;
        }
        $user = $query->row();
        if ($user->email_verified != 1) {
            return false;
        }
        return password_verify($password, $user->password);
    }


    // sign up
    public function signup($username,$email,$password,$token)
    {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password,PASSWORD_DEFAULT),
            'email_verified' => 0,
            'verification_token' => hash('sha256',$token),
            'verification_expires' => date('Y-m-d H:i:s',time() + 3600)
        );

        return $this->db->insert('users',$data);
    }

    public function check_signup($username,$email){
        $this->db->where('username', $username);
        $this->db->or_where('email', $email);
        $result = $this->db->get('users');
        if($result->num_rows()==1){
            return false;
        } else {
            return true;
        }
    }

    public function get_email($username)
    {
        $this->db->select('email');
        $this->db->from("users");
        $this->db->where('username', $username);
        $query= $this->db->get();
        foreach ($query->result() as $row)
        {
            return $row->email;
        }
    }

    public function update_info($username,$email)
        {
            $data = array(
                'username'  => $username,
                'email'  => $email
            );
            $this->db->replace('users', $data);    
        }

    public function verify_email_token($token)
    {
        $hashed_token = hash('sha256',$token);

        $this->db->where('verification_token',$hashed_token);
        $this->db->where('verification_expires >=',date('Y-m-d H:i:s'));
        $query = $this->db->get('users');

        if ($query->num_rows() !== 1) {
            return false;
        }

        $user = $query->row();

        $this->db->where('id',$user->id);

        return $this->db->update('users',array(
            'email_verified' => 1,
            'verification_token' => NULL,
            'verification_expires' => NULL
        ));
    }
}


?>

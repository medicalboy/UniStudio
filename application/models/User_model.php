<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }


    // sign up
    public function signup($username,$email,$password){
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $query = $this->db->insert('users', $data);
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

    public function decode_password($username,$password){
        $this->db->select('password');
        $this->db->from("users");
        $this->db->where('username', $username);
        $query=$this->db->get();
        foreach ($query->result() as $row)
        {
            return $row->password;
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

    public function insert_token($uid,$token){
        $data = array(
            'verified_code' => $token,
            'id' => $uid,
        );
        $query = $this->db->insert('code', $data);
    }


    public function check_email($token)
    {
        $this->db->where('verified_code', $token);
        $result = $this->db->get('code');
        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }


    // public function email_verify(){
    //     $token = $this->input->get("token");
    //     echo $token;
    // }

    // public function reset_password(){
    //     $cofig=array{

    //     }

    //     $this->email->initialize($config);
    //     $this->email->initialize($config);
    //     $hash=md5(rand(0,1000));
        // $link ='reset?token='.$hash;
    // }


    // public function insert_token($uid,$token){
    //     $token = $this->input->get("token");
    //     echo $token;
    // }

    // public function verify_token($token){
    //     //检查这个token在不在db，存在return true and delete,
    // }
}
?>

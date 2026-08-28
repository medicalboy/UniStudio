<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup extends CI_Controller{
    public function index()
    {
      $data['error']= "";
		  $this->load->view('signup',$data);
    }
    
    public function do_signup() {
		$this->load->model('user_model');		//load user model	
    $this->load->helper('form');
		$this->load->helper('url');
    $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> username or email has been used!! </div> ";
    $username = $this->input->post('fullname'); //getting username from sign up form
		$password = $this->input->post('password'); //getting password from sign up form

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
      $data["error"] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number.";
      $this->load->view('signup', $data);
    }else{
      $hash_password=password_hash($password,PASSWORD_DEFAULT);
      $email = $this->input->post('email'); //getting remember checkbox from sign up form
      if ( $this->user_model->check_signup($username,$email) )//check username and email
      {
        $this->user_model->signup($username,$email,$hash_password);
        $this->load->model('user_model');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE ,
            'mailtype' => 'html',
            'starttls' => true,
            'newline' => "\r\n"
            );
          
        $this->email->initialize($config);
        $this->email->from(get_current_user().'@student.uq.edu.au',get_current_user());
        $this->email->to($this->input->post('email'));
        $this->email->cc('lihao020118@gmail.com');
        $message = "For demo purpose only!!";// $this->table->generate($data);
        $hash = md5(rand(0,1000));// $this->table->generate($data);
        $link ='https://infs3202-200a663b.uqcloud.net/Unisee/signup/verify_token?token='.$hash;
        $this->user_model->insert_token(0,$hash);
        $this->email->subject('Web Information Systems Email Test');
        $this->email->message($link);
        $this->email->send();
        redirect('login');
      }else{
        $this->load->view('signup', $data);
      }
    }


	}

  public function verify_token(){
      $token = $this->input->get("token");
      //检查这个token在不在db，存在return true and delete,
      $this->load->model('user_model');
      if($this->user_model->check_email($token)){
          $this->load->view('email_verification');
      }
  }
}
?>

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
    $email = $this->input->post('email'); //getting remember checkbox from sign up form

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);


    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
      $data["error"] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number.";
      $this->load->view('signup', $data);
      return;
    }
    if (!$this->user_model->check_signup($username,$email)) {
          $data['error'] = '<div class="alert alert-danger">Username or email has already been used.</div>';
          $this->load->view('signup',$data);
          return;
      }

      $token = bin2hex(random_bytes(32));
        if (!$this->user_model->signup($username,$email,$password,$token)) {
            show_error('Unable to create account.');
        }

        $link = base_url(
            'signup/verify_email?token=' . rawurlencode($token)
        );

        if (!$this->send_verification_email($email,$link)) {
            // show_error('Account created, but verification email could not be sent.');
                exit;

        }
        redirect('login');
    }
	
     function verify_email() //User clicks the email The browser opens: /signup/verify_email?token=abc123
    {
        $this->load->model('user_model');
        $token = $this->input->get('token');
        if (!$token) {
            show_error('Invalid verification link.');
        }

        if ($this->user_model->verify_email_token($token)) {
            $this->load->view('email_verification');
            return;
        }

        show_error('Verification link is invalid or expired.');
    }

    private function send_verification_email($email,$link)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'lihao020118@gmail.com',
            'smtp_pass' => getenv('GMAIL_APP_PASSWORD'),
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'crlf' => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('lihao020118@gmail.com','UniStudio');
        $this->email->to($email);
        $this->email->subject('Verify your UniStudio email');
        $this->email->message(
            'Please verify your email:<br><br>' .
            '<a href="'.$link.'">'.$link.'</a>'
        );

        if (!$this->email->send()) {
            echo '<pre>';
            echo $this->email->print_debugger();
            echo '</pre>';
            return false;
        }

        return true;

        // return $this->email->send();
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{	
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		// $this->load->view('header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
		// if (get_cookie('remember')) { // check if user activate the "remember me" feature  
		// 	$this->load->view('dashboard'); //if user already logined show main page
		// 	}
		// else{
			$this->load->view('login', $data);
		// }
		}else{
			$this->load->view('dashboard'); //if user already logined show dashboard page
		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{
		$this->load->model('user_model');		//load user model	
		$this->load->helper('form');
		$this->load->helper('url');
		//Check if user already login
		if($this->session->userdata('logged_in')){
			redirect('/');
        	return;
		}	
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		if ( $this->user_model->login($username, $password) )//check username and password
		{
			$user_data = array(
				'username' => $username,
				'logged_in' => true 	//create session variable
			);
			$this->session->set_userdata($user_data); //set user status to login in session
			if($remember) { // if remember me is activated create cookie
				set_cookie("username", $username, '300'); //set cookie username
				set_cookie("password", $password, '300'); //set cookie password
				set_cookie("remember", $remember, '300'); //set cookie remember
			}	
			        // Important: new request after session is created
            // 2. Load header AFTER session is set
            $this->load->view('header');

            // 3. Load dashboard
            $this->load->view('dashboard');

            $this->load->view('footer');
		}else{
			$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
			$this->load->view('header');
			$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			$this->load->view('footer');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		$this->session->unset_userdata('username'); //delete login status
		$this->session->set_flashdata('user_loggedout','you are now logged out');
		delete_cookie('remember'); 
		redirect('login'); // redirect user back to login
	}

	public function reset()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}
}
?>
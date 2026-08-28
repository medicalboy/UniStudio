<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller
{
    public function index()
    {
		// $data['error'] = 'cat2.jpg';
		$this->load->view('signupbar'); 
    	if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('add_course',array('error' => ' ')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->view('add_course',array('error' => ' ')); //if user already logined show login page
		}
		$this->load->view('template/footer');
    }
    public function do_upload() {
		// $data['error'] = 'cat2.jpg';
		$this->load->model('file_model');
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'png|jpg|mp4|mkv';
		$config['max_size'] = 1000000;
		$config['max_width'] = 4096;
		$config['max_height'] = 2048;
		$this->load->library('upload', $config);
		$subject = $this->input->post('subject'); 
		$message = $this->input->post('message'); 
		if ( ! $this->upload->do_upload('userfile')) {
			// $this->load->view('header_signup');
			$data = array('error' => $this->upload->display_errors());
            $this->load->view('add_course', $data);
			// $this->load->view('file', array('error' => 'File upload success. <br/>'));
			// $this->load->view('template/footer');
		}else{
			$this->file_model->upload($this->upload->data('file_name'), $this->upload->data('full_path'),$this->session->userdata('username'),$subject,$message);
			$this->load->view('header_signup');
			// $this->load->view('file', array('error' => 'File upload success. <br/>'));
			// $this->load->view('template/footer');
        }
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfilevideo')) {

        } else {
			$this->file_model->upload_video($this->upload->data('file_name'), $this->upload->data('full_path'),$this->session->userdata('username'));
			// $this->load->view('header_signup');
        }
	}
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	/**
	 */
	public function index()
	{	
        $data['error']= "";
        $data['username']= $this->session->userdata('username');
        $result = $this->user_model->get_email($data['username']);
        $data['email'] = $result;
		$this->load->helper('form');
		$this->load->helper('url');
		// $this->load->view('header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
                    $this->load->view('header');
                    $this->load->view('profile',$data);
                    $this->load->view('footer');
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
            $this->load->view('header');
            $this->load->view('profile',$data);
            $this->load->view('footer');
		}
		$this->load->view('template/footer');





        

      
	}

    public function edit()
    {
        $this->load->model('user_model');	
        //收集post表单数据
        //update 信息
        $data['username'] =$this->input->post('username');
        $data['email'] = $this->input->post('email'); 
        $this->user_model->update_info($data['username'],$data['email']);
        $this->load->view('header');
        $this->load->view('profile', $data);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{	
		$data['error']= "";
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
					$this->load->view('videopage'); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			$this->load->view('videopage'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}

	public function loadFile(){
		$data['fileid'] = $this->input->get('id');
		$data['ratings'] = '';
		$this->load->view('videopage',$data);
	}

	public function fetch_detail(){
		$this->load->model('file_model');
        $data['coursename'] = $this->file_model->do_wishlist();
		// $data['subject'] = $this->file_model->do_wishlist();
		// $data['description'] = $this->file_model->do_wishlist();
		// $data['subject'] = $this->file_model->do_wishlist($query);
		// $data['description'] = $this->file_model->do_wishlist($query);
		$this->load->view('header');
		$this->load->view('wishlist',$data);
	}

	public function like($name){
		$this->load->model('file_model');
        $this->file_model->insert_like($name);
		redirect(base_url().'welcome');
	}

	public function clearlist(){
		$this->load->model('file_model');
        $this->file_model->clear_list();
		redirect(base_url().'products/fetch_detail');
	}

	public function rating($vid=NULL){
		if (!isset($_SESSION['vid']))
		{
			$_SESSION['vid'] = $vid;
		}
		if ($vid == NULL)
		{
			$id = 27;
		} else
		{
			$id = $this->input->get('id');
		}
		$id = $_SESSION['vid'];
		$data['fileid'] = $id;
		$this->load->model('file_model');
		$rating=$this->input->post('categories');
        $this->file_model->insert_rating($rating,$id);
		$temp = $this->file_model->fetch_rating($id);
		// echo json_encode($temp);
		$data['ratings'] = $temp->rating;
		$this->load->view('videopage',$data);
		//redirect('products');
	}


	public function do_comment($id) {
        $this->load->model('comment_model');		//load user model	
        $this->load->helper('form');
        $this->load->helper('url');
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> username or email has been used!! </div> ";
        $content = $this->input->post('content'); 
		// $cid = $this->input->post('cid'); 
		$postby = $this->session->userdata('username');
        $this->comment_model->do_comments($content,$postby);
		redirect(base_url().'products/loadFile/'.$id);
    }


    public function fetchcomment(){
		$this->load->model('comment_model');
        $data = $this->comment_model->fetch_comment(); 
        echo json_encode ($data->result());
    }
}
?>

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
		$this->load->model('file_model');

		$data['files'] =
			$this->file_model->get_files();
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
					$this->load->view('products', $data); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			$this->load->view('header');
			$this->load->view('products'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}



	public function search()
	{
		$this->load->model('file_model');

		$keyword = trim($this->input->get('q'));

		if ($keyword === '') {
			$data['files'] = $this->file_model->get_files();
		} else {
			$data['files'] = $this->file_model->search_files($keyword);
		}

		$data['keyword'] = $keyword;

		$this->load->view('header');
		$this->load->view('main_page',$data);
		$this->load->view('footer');
	}

	public function watch($id)
	{
		$this->load->model('file_model');
		$file = $this->file_model->get_file_by_id($id);
		if (!$file) {
			show_404();
		}
		$this->file_model->increase_views($id);
		redirect('products/load_file/' . $id);
	}

	public function load_file($id){
		$this->load->model('file_model');
		$this->load->model('comment_model');
		$data['file'] = $this->file_model->get_file_by_id($id);
		$data['comments'] = $this->comment_model->get_comments($id);
		if (!$data['file']) {
        show_404();
    	}
		$this->load->view('header');
		$this->load->view('product_details',$data);
		$this->load->view('footer');
	}

	public function get_subscrptions(){
		$this->load->model('subscription_model');
		$subscriber = $this->session->userdata('username');
        $data['my_subscriptions'] = $this->subscription_model->get_subscriptions($subscriber);
		$this->load->view('header');
		$this->load->view('subscriptions',$data);
	}


	public function clearlist(){
		$this->load->model('file_model');
        $this->file_model->clear_list();
		redirect(base_url().'products/get_subscrptions');
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

	public function add_comment($id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->load->model('comment_model');

		$comment = $this->input->post('comment');
		$username = $this->session->userdata('username');

		if (!empty(trim($comment))) {
			$this->comment_model->add_comment($id, $username, $comment);
		}

		redirect('products/load_file/' . $id);
	}

    public function fetchcomment(){
		$this->load->model('comment_model');
        $data = $this->comment_model->fetch_comment(); 
        echo json_encode ($data->result());
    }

	public function like($id)
	{
		$this->load->model('file_model');
		$this->file_model->increase_likes($id);
		redirect('products/load_file/' . $id);
	}

	public function dislike($id)
	{
		$this->load->model('file_model');
		$this->file_model->increase_dislikes($id);
		redirect('products/load_file/' . $id);
	}
}
?>

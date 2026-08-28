<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_course extends CI_Controller {

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
		// $data['img_path'] = 'cat2.jpg';
		// $data['filename'] = 'cat2.jpg';
		// $this->load->view('header');
        $data['error'] = '';
		$this->load->view('add_course',$data);
		$this->load->view('footer');
	}
}

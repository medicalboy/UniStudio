<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
class Upload extends CI_Controller
{
    public function index()
    {
		$this->load->view('header'); 
    	if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('file',array('error' => ' ')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->view('file',array('error' => ' ')); //if user already logined show login page
		}
		$this->load->view('template/footer');
    }

	public function presign()
	{
		// User must be logged in
		if (!$this->session->userdata('logged_in')) {
			return $this->output
				->set_status_header(401)
				->set_output('Unauthorized');
		}
			// Load AWS SDK
		require_once FCPATH . 'vendor/autoload.php';

		// Get file information sent from JavaScript
		$fileName = $this->input->post('filename');
		$fileType = $this->input->post('file_type');

		// Only allow specific MIME types
		$allowedTypes = array(
			'image/jpeg',
			'image/png',
			'video/mp4'
		);

		if (!in_array($fileType, $allowedTypes, true)) {
			return $this->output
				->set_status_header(400)
				->set_output('Invalid file type');
		}

		// Get extension, e.g. jpg or mp4
		$extension = strtolower(
			pathinfo($fileName, PATHINFO_EXTENSION)
		);

		// Generate unique S3 filename
		$uniqueName = bin2hex(random_bytes(16));

		$s3Key = 'products/' . $uniqueName . '.' . $extension;

		// Connect to S3
		$s3 = new S3Client(array(
			'version' => 'latest',
			'region'  => 'ap-southeast-2'
		));

		// Prepare upload command
		$command = $s3->getCommand('PutObject', array(
			'Bucket'      => 'unistudio-product-files-wilson',
			'Key'         => $s3Key,
			'ContentType' => $fileType
		));

		// Create temporary signed URL
		$request = $s3->createPresignedRequest(
			$command,
			'+10 minutes'
		);

		// Return URL + S3 key to browser
		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'upload_url' => (string) $request->getUri(),
				'key'        => $s3Key
			)));
	}
	public function note()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->load->view('header');

		$this->load->view(
			'upload_note',
			array('error' => '')
		);

		$this->load->view('template/footer');
	}
	public function save_note()
	{
		// User must be logged in
		if (!$this->session->userdata('logged_in')) {

			return $this->output
				->set_status_header(401)
				->set_output('Please log in');
		}


		// Get data from upload_note.php
		$subject =
			$this->input->post('subject');

		$description =
			$this->input->post('description');

		$filename =
			$this->input->post('filename');

		$file_type =
			$this->input->post('file_type');

		$username =
			$this->session->userdata('username');


		// Check required data
		if (!$subject || !$filename) {

			return $this->output
				->set_status_header(400)
				->set_output('Missing required information');
		}


		// Data for files table
		$data = array(

			'username' => $username,

			'subject' => $subject,

			'description' => $description,

			'filename' => $filename,

			'file_type' => $file_type,

			'views' => 0,

			'likes' => 0,

			'dislikes' => 0

		);


		// Save to database
		$this->db->insert(
			'files',
			$data
		);


		// Check database insert
		if ($this->db->affected_rows() !== 1) {

			return $this->output
				->set_status_header(500)
				->set_output('Could not save Note');
		}


		// Send success response
		return $this->output
			->set_content_type('application/json')
			->set_output(
				json_encode(
					array(
						'success' => true
					)
				)
			);
	}

	public function save_product()
	{
		if (!$this->session->userdata('logged_in')) {
			return $this->output
				->set_status_header(401)
				->set_output('Unauthorized');
		}

		$this->load->model('file_model');

		$subject = $this->input->post('subject');
		$description = $this->input->post('description');
		$filename = $this->input->post('filename');
		$fileType = $this->input->post('file_type');

		$username = $this->session->userdata('username');

		$success = $this->file_model->upload(
			$filename,
			$fileType,
			$username,
			$subject,
			$description
		);

		if ($success) {
			return $this->output
				->set_status_header(200)
				->set_output('Product saved');
		}

		return $this->output
			->set_status_header(500)
			->set_output('Database save failed');
	}
}


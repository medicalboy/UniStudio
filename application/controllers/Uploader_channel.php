<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class uploader_channel extends CI_Controller {

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
		if (!$this->session->userdata('logged_in')) {
        redirect('login');
    }

    $this->load->model('file_model');
	$this->load->model('subscription_model');
    $username = $this->session->userdata('username');
	$data['files'] = $this->file_model->get_files_by_username($username);
    $data['username'] = $username;
	$data['current_user'] = $username;
    $data['is_own_channel'] = true;
    $data['is_subscribed'] = false;
	    $data['subscriber_count'] =
        $this->subscription_model
             ->count_subscribers($username);
	$this->load->view('header');
	$this->load->view('personal_channel', $data);
	}

	public function view($username)
	{
		$this->load->model('file_model');
		$this->load->model('subscription_model');

		$username = urldecode($username);

		// Username of the channel being viewed
		$data['username'] = $username;

		$data['files'] =
			$this->file_model
				->get_files_by_username($username);

		// Current logged-in user
		$currentUser =
			$this->session->userdata('username');

		$data['current_user'] = $currentUser;

		$data['is_own_channel'] =
			($currentUser === $username);

		$data['is_subscribed'] = false;

		if ($currentUser) {
			$data['is_subscribed'] =
				$this->subscription_model
					->is_subscribed(
						$currentUser,
						$username
					);
		}

		$data['subscriber_count'] =
			$this->subscription_model
				->count_subscribers($username);

		$this->load->view('header');
		$this->load->view('personal_channel', $data);
		$this->load->view('footer');
	}

	public function subscribe($uploader)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->load->model('subscription_model');

		$subscriber =
			$this->session->userdata('username');

		$uploader = urldecode($uploader);

		if ($subscriber !== $uploader) {
			$this->subscription_model
				->subscribe(
					$subscriber,
					$uploader
				);
		}

		redirect(
			'uploader_channel/view/' .
			rawurlencode($uploader)
		);
	}
	public function unsubscribe($uploader)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->load->model('subscription_model');

		$subscriber =
			$this->session->userdata('username');

		$uploader = urldecode($uploader);

		$this->subscription_model
			->unsubscribe(
				$subscriber,
				$uploader
			);

		redirect(
			'uploader_channel/view/' .
			rawurlencode($uploader)
		);
	}
}
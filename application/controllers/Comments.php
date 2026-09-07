<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller
{
    public function add($fileId)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('comment_model');

        $username =
            $this->session->userdata('username');

        $comment =
            trim($this->input->post('comment'));

        if ($comment !== '') {

            $this->comment_model->add_comment(
                $fileId,
                $username,
                $comment
            );
        }

        redirect($this->input->post('return_url'));
    }
}
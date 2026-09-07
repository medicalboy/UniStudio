<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller
{
    public function view($id)
    {
        $this->load->model('file_model');
        $this->load->model('comment_model');
        $this->load->model('subscription_model');

        $data['note'] =
            $this->file_model->get_file_by_id($id);

        if (!$data['note']) {
            show_404();
        }

        $data['comments'] =
            $this->comment_model->get_comments($id);

        $currentUser =
            $this->session->userdata('username');

        $uploader =
            $data['note']->username;

        $data['is_subscribed'] = false;

        if (
            $currentUser &&
            $currentUser !== $uploader
        ) {
            $data['is_subscribed'] =
                $this->subscription_model
                     ->is_subscribed(
                         $currentUser,
                         $uploader
                     );
        }

        $data['subscriber_count'] =
            $this->subscription_model
                 ->count_subscribers($uploader);

        $this->load->view('header');

        $this->load->view(
            'note_details',
            $data
        );

        $this->load->view('footer');
    }
}
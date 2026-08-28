<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends CI_Controller
{
    public function index()
    {
        // $hash = md5(rand(0,1000));
        // $data['token']=$hash;
        $this->load->view('header');
        $this->load->view('email');
        $this->load->view('template/footer');
    }

    // public function email_verify(){
    //     $token = $this->input->get("token");
    //     echo $token;
    // }

    public function send()
    {
        $this->load->model('user_model');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE ,
            'mailtype' => 'html',
            'starttls' => true,
            'newline' => "\r\n"
            );
           
        $this->email->initialize($config);
        $this->email->from(get_current_user().'@student.uq.edu.au',get_current_user());
        $this->email->to($this->input->post('email'));
        $this->email->cc('lihao020118@gmail.com');
        $message = "For demo purpose only!!";// $this->table->generate($data);
        $hash = md5(rand(0,1000));// $this->table->generate($data);
        $link ='https://infs3202-200a663b.uqcloud.net/Unisee/email/verify_token?token='.$hash;
        $this->user_model->insert_token(0,$hash);
        $this->email->subject('Web Information Systems Email Test');
        $this->email->message($link);
        $this->email->send();
        // $data['token']=$hash;
        // $this->load->view('template/header');
        redirect('email');
        // $this->load->view('template/footer');
    }


    public function verify_token(){
        $token = $this->input->get("token");
        //检查这个token在不在db，存在return true and delete,
        $this->load->model('user_model');
        if($this->user_model->check_email($token)){
            $this->load->view('new_password');
        }
    }
}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {
    public function fatch()
    {
		$this->load->model('file_model'); // load file_model 
        $output = '';
        $query = '';
        if($this->input->get('query')){ 
            $query = $this->input->get('query'); // get search query send from ajax search form
        }
        $data = $this->file_model->fetch_data($query); //send query to file_model and put result to $data
            if(!$data == null){
                echo json_encode ($data->result()); //send result back
            }else{
                echo  ""; // no result found
            }
    }

    public function fatch_thumbnail(){
        $query = $this->input->get('filename'); // get num send from ajax form
        $this->load->model('file_model');
        $data = $this->file_model->fetch_images($query); 
        echo json_encode ($data->result());
    }
    public function fetchAll(){
        $this->load->model('file_model');
        $data = $this->file_model->fetch_All(); 
        echo json_encode ($data->result());
    }

    public function fetchvideo(){
        $this->load->model('file_model');
        $data = $this->file_model->fetch_video(); 
        echo json_encode ($data->result());
    }
}
?>
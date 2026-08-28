<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Comment_model extends CI_Model{
    public function do_comments($content,$postby){
        $data = array(
            'content' => $content,
            'postby'=> $postby
        );
        $query = $this->db->insert('comments', $data);
    }

    function fetch_comment(){
        
        $result=$this->db->get('comments');
        return $result;
    }
}
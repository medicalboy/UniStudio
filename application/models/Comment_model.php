<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Comment_model extends CI_Model{

    public function get_comments($fileid)
    {
        $this->db->where('fileid', $fileid);
        $this->db->order_by('fileid', 'DESC');
        return $this->db->get('comments')->result();
    }

    public function add_comment($fileid, $username, $content)
    {
        $data = array(
            'fileid' => $fileid,
            'username' => $username,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('comments', $data);
    }
}
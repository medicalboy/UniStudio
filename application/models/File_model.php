<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class File_model extends CI_Model{

    // upload file
    function upload($filename, $path, $file_type,$username,$subject,$description){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'file_type'   => $file_type,
            'username' => $username,
            'subject' => $subject,
            'description' => $description
        );
        $query = $this->db->insert('files', $data);
    }

    function fetch_data($query)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('filename', $query);
            $this->db->or_like('username', $query);
            $this->db->order_by('filename', 'DESC');
            return $this->db->get()->result();
        }
    }


    public function search_files($keyword)
    {
        $this->db->group_start();
        $this->db->like('subject',$keyword);
        $this->db->or_like('description',$keyword);
        $this->db->or_like('username',$keyword);
        $this->db->group_end();

        $this->db->order_by('id','DESC');

        return $this->db->get('files')->result();
    }

    function do_wishlist(){
		$this->db->select("*");
		$this->db->from("wishlist");
		// $this->db->join('files', 'wishlist.name = files.filename');
        // $this->db->where('name', $filename);
        $query =$this->db->get();
		return $query->result();
        // foreach ($query->result() as $row)
        // {
        //     return $row->name;
        // }
    }

    function clear_list(){
		$this->db->empty_table('wishlist'); 
    }

    function get_files(){
            $this->db->order_by('id', 'DESC');
            return $this->db->get('files')->result();
    }

    function get_file_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('files')
            ->row();
    }

    public function get_files_by_username($username)
    {
        $this->db->where('username',$username);
        $this->db->order_by('id','DESC');

        return $this->db->get('files')->result();
    }
    
    function increase_views($id)
    {
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('files');
    }

    function increase_likes($id)
    {
        $this->db->set('likes', 'likes + 1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('files');
    }

    public function increase_dislikes($id)
    {
        $this->db->set('dislikes', 'dislikes + 1', FALSE);
        $this->db->where('id', $id);
        return $this->db->update('files');
    }

}


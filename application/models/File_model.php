<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class File_model extends CI_Model{

    // upload file
    public function upload($filename, $path, $username,$subject,$description){

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username,
            'subject' => $subject,
            'description' => $description
        );
        $query = $this->db->insert('files', $data);
        // $data2 = array(
        //     'name' => $filename,
        //     'subject' => $subject,
        //     'description' => $description
        // );
        // $query2 = $this->db->insert('wishlist', $data2);
    }

    public function upload_video($coursename, $path, $username){

        $data = array(
            'coursename' => $coursename,
            'path' => $path,
            'username' => $username
        );
        $query = $this->db->insert('videos', $data);

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
            return $this->db->get();
        }
    }

    function fetch_images($filename){
        $this->db->like('filename', $filename);
        $result = $this->db->get('files',3);
        return $result;
    }

    function fetch_All(){
        $result=$this->db->get('files');
        return $result;
    }

    function fetch_video(){
        $result=$this->db->get('videos');
        return $result;
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

    function insert_like($name){
        $this->db->select("*");
		$this->db->from("files");
        $this->db->where('filename', $name);
        $query =$this->db->get();
		foreach ($query->result() as $row)
        {
            $name = $row->filename;
            $subject = $row->subject;
            $description = $row->description;
            $data = array(
                'name' => $name,
                'subject' => $subject,
                'description' => $description
            );
        }
        $query = $this->db->insert('wishlist', $data);
    }


    function insert_rating($rating,$id)
    {
        
        $data['rating'] = $rating;
        $this->db->where('vid', $id);
        $query = $this->db->update('videos', $data);
    }

    function fetch_rating($id)
    {
        if($id == '')
        {
            return null;
        }else{
            //$this->db->select("*");
            //$this->db->from("videos");
           // $this->db->where('vid', $id);
            //$query = $this->db->get('videos');
            $query = "SELECT * FROM videos WHERE vid=$id";
            //$query =$this->db->get();
            $res = $this->db->query($query);
            return $res->row();
        }
    }
}
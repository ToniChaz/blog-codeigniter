<?php

class Post_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_posts($user = null) {
        if (!is_null($user)) {
            $this->db->select('*');
            $this->db->from('posts');
            $this->db->where('postuser', $user);
            $this->db->order_by("date", "desc"); 
            
            $query = $this->db->get();

            return $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('posts');
            $this->db->order_by("date", "desc"); 

            $query = $this->db->get();

            return $query->result_array();
        }
    }

    public function get_single_post($id) {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->row();
    }
    
    public function get_single_post_slug($slug) {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('slug', $slug);

        $query = $this->db->get();

        return $query->row();
    }
    
    public function create_post($author, $date, $slug, $status) {
        $data = array(
            'author' => $author,
            'postuser' => $this->session->userdata('active_user'),
            'date' => $date,
            'text' => $this->input->post('text'),
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'status' => $status,
            'type' => 'post',
        );
        $this->db->insert('posts', $data);
    }
    
    public function update_post($author, $post_user, $date, $slug, $status) {        
        $data = array(
            'author' => $author,
            'postuser' => $post_user,
            'date' => $date,
            'text' => $this->input->post('text'),
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'status' => $status,
            'type' => 'post',
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('posts', $data);
    }
    
    public function delete_post($id){
        $this->db->delete('posts', array('id' => $id));
    }
    
    public function last_post(){
        $this->db->select('*');
        $this->db->from('posts');
        $query = $this->db->get();
        
        $row = $query->last_row();
        
        return $row;
    }
}

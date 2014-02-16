<?php

class Post_model extends CI_Model {

    public function getPosts($user = null) {
        if (!is_null($user)) {
            $this->db->select('*');
            $this->db->from('posts');
            $this->db->where('postuser', $user);

            $query = $this->db->get();

            return $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('posts');

            $query = $this->db->get();

            return $query->result_array();
        }
    }

    public function getSinglePost($id) {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('id', $id);

        $query = $this->db->get();

        return $query->row();
    }
    
    public function createPost($author, $date, $slug, $status) {
        $data = array(
            'author' => $author,
            'postuser' => $this->session->userdata('activeUser'),
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
    
    public function updatePost($author, $date, $slug, $status) {        
        $data = array(
            'author' => $author,
            'postuser' => $this->session->userdata('activeUser'),
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

}

?>

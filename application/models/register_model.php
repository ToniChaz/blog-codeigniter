<?php

class Register_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function verifyUnicUser($user) {
        $this->db->select('user');
        $this->db->from('users');
        $this->db->where('user', $user);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function registerUser() {
        $data = array(
            'user' => $this->input->post('user'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role'),
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'avatarurl' => $_FILES['userfile']['name'],
            'url' => $this->input->post('url')
        );
        $this->db->insert('users', $data);
    }

}

?>

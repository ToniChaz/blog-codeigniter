<?php

class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->library('encrypt');
    }

    public function getProfile($user) {
        $query = $this->db->get_where('users', array('user' => $user));

        foreach ($query->result_array() as $row) {
            $profileData = array(
                'id' => $row['id'],
                'user' => $row['user'],
                'password' => $row['password'],
                'role' => $row['role'],
                'name' => $row['name'],
                'surname' => $row['surname'],
                'email' => $row['email'],
                'avatarurl' => $row['avatarurl'],
                'url' => $row['url'],
            );
        }
        return $profileData;
    }

    public function verifyChangeUser($user) {
        $this->db->select('user');
        $this->db->from('users');
        $this->db->where('user', $user);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($user) {
        $data = array(
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname')
        );
        if ($_FILES['userfile']['error'] == 0) {
            $data['avatarurl'] = $_FILES['userfile']['name'];
        }
        if ($this->input->post('url')) {
            $data['url'] = $this->input->post('url');
        }
        $this->db->where('user', $user);
        $this->db->update('users', $data);
    }

    public function deleteProfile($user, $password) {
        $this->db->select('user, password');
        $this->db->from('users');
        $this->db->where('user', $user);
        $this->db->where('password', $password);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $this->db->delete('users', array('user' => $user));
            return true;
        } else {
            return false;
        }
    }

}

?>
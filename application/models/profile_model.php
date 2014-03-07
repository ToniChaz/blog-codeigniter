<?php

class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getProfile($user) {
        $query = $this->db->get_where('users', array('user' => $user));
        
        foreach ($query->result_array() as $row) {
            $profileData = array(
                'id' => $row['id'],
                'user' => $row['user'],
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
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname')
        );        
        if (!empty($_POST['password'])) {
            $data['password'] = md5($this->input->post('password'));
        }
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
        
        $encryptPassword = md5($password);
        
        $this->db->select('user, password');
        $this->db->from('users');
        $this->db->where('user', $user);
        $this->db->where('password', $encryptPassword);

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
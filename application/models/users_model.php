<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getUsers() {
        $query = $this->db->get('users')->result();
        
        return $query;
    }
    public function updateUser($user, $role){
        $this->db->where('user', $user);
        $this->db->update('users', array('role' => $role));
        
        return true;
    }
    public function deleteUser($user){
        $this->db->delete('users', array('user' => $user));
    }
}

?>
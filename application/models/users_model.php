<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_users() {
        $query = $this->db->get('users')->result();
        
        return $query;
    }
    public function update_user($user, $role){
        $this->db->where('user', $user);
        $this->db->update('users', array('role' => $role));
        
        return true;
    }
    public function delete_user($user){
        $this->db->delete('users', array('user' => $user));
    }
}
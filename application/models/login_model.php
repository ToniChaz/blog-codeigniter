<?php

class Login_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }

   public function login($user, $password){
        $this->db->select('user, password, role');
        $this->db->from('users');
        $this->db->where('user', $user);
        $this->db->where('password', $password);
        
        $query = $this->db->get();
        
        return $query;
    }
}
?>
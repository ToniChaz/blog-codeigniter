<?php

class Login_model extends CI_Model{
    
   public function login($user, $password){
        $this->db->select('user, password');
        $this->db->from('users');
        $this->db->where('user', $user);
        $this->db->where('password', $password);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }
}
?>
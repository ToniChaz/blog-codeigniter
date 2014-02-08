<?php

class Users_model extends CI_Model {

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
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user', $user);
        
        $query = $this->db->get();
               
        if($query->num_rows() == 1){
            $this->db->delete('users', array('user' => $user)); 
            return $query->result_array();
        }else{
            return false;
        }
    }
}

?>
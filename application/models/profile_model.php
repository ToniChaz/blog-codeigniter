<?php

class Profile_model extends CI_Model {

    public function getProfile($user) {
        $query = $this->db->get_where('users', array('user' => $user));
        return $query->row_array();
    }

}

?>
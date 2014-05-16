<?php

Class Search_model Extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function simpleSearch($keyword) {        
        $query = $this->db->query("SELECT title, text, slug FROM posts WHERE status = 1 AND text LIKE '%$keyword%' OR title LIKE '%$keyword%' LIMIT 20");
        return $query->result();
    }
    function multiSearch($keyword) {        
        $query = $this->db->query("SELECT title, text, slug, MATCH ( title, text ) AGAINST ( '$keyword' IN BOOLEAN MODE) AS Score FROM posts WHERE MATCH ( title, text ) AGAINST ( '$keyword' IN BOOLEAN MODE) ORDER BY Score DESC LIMIT 20");
        return $query->result();
    }

}

?>

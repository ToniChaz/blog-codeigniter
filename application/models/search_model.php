<?php

Class Search_model Extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function simple_search($keyword) {
        $query = $this->db->query("SELECT * FROM posts WHERE status = 1 AND text LIKE '%$keyword%' OR title LIKE '%$keyword%' LIMIT 20");
        return $query->result();
    }
    function multi_search($keyword) {
        
        //$cadbusca = "SELECT REFERENCIA, TITULO , MATCH ( TITULO, DESARROLLO ) AGAINST ( '$busqueda' ) AS Score FROM ARTICULOS WHERE MATCH ( TITULO, DESARROLLO ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
        $query = $this->db->query("SELECT *, MATCH ( title, text ) AGAINST ( '$keyword' ) AS Score FROM posts WHERE MATCH ( title, text ) AGAINST ( '$keyword' ) ORDER BY Score DESC LIMIT 20");
        return $query->result();
    }

}

?>

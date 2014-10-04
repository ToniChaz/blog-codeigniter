<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index($page = 'inicio') {
        if (!file_exists('application/views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $title = str_replace("-", " ", $page); // Replace - to "space"
        $data['title'] = ucfirst($title); // Uppercase the first letter
        $data['keywords'] = "key1, key2, key3";
        $data['description'] = "La mega descripcion de mundo";
        
        if ($page == 'inicio') {
            $data['last_post'] = $this->post_model->last_post();
            $data['title'] = "Rutas de Gin Tonic";
            $data['keywords'] = "Gin Tonic, ruta, bares, ginebra";
        }        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

}
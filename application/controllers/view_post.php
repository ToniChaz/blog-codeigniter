<?php

class View_post extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
            $this->load->model('post_model');
    }

    public function index($slug = null) {
        if(empty($slug)){
            $data['view_posts'] = $this->post_model->get_posts();            
        }else{
            $data['view_post'] = $this->post_model->get_single_post_slug($slug);            
        }

        if (empty($data['view_posts']) && empty($data['view_post'])) {
            show_404();
        }else if(empty($slug)){
            $data['title'] = "El blog de la ruta del Gin tonic";
        }else{
            $data['title'] = $data['view_post']->title;
            $data['description'] = $data['view_post']->description;
        }       
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('pages/bares', $data);
        $this->load->view('templates/footer');
    }
    
}

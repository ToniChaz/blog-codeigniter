<?php

class View_post extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
            $this->load->model('post_model');
    }

    public function index($slug = null) {
        if(empty($slug)){
            $data['viewPosts'] = $this->post_model->getPosts();            
        }else{
            $data['viewPost'] = $this->post_model->getSinglePostSlug($slug);            
        }

        if (empty($data['viewPosts']) && empty($data['viewPost'])) {
            show_404();
        }else if(empty($slug)){
            $data['title'] = "El blog de la ruta del Gin tonic";
        }else{
            $data['title'] = $data['viewPost']->title;
            $data['description'] = $data['viewPost']->description;
        }       
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('pages/bares', $data);
        $this->load->view('templates/footer');
    }
    
}

?>

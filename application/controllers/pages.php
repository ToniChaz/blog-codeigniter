<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function view($page = 'inicio') {
        if (!file_exists('application/views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        
        $title = str_replace("-", " ", $page); // Replace - to "space"
        $data['title'] = ucfirst($title); // Uppercase the first letter
        $data['description'] = 'La mega descripcion del mundo';
        $data['keywords'] = 'keyword1, keyword2, keyword3';
                
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
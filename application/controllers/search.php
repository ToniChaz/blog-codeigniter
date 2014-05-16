<?php

Class Search Extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('search_model');
    }

    public function searchKeyword() {
        
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Resultados de busqueda';

        if ($keyword != '') {
            //CUENTA EL NUMERO DE PALABRAS 
            $trace = explode(" ", $keyword);
            $number = count($trace);
            if ($number == 1) {
                $data['results'] = $this->search_model->simpleSearch($keyword);
            } elseif ($number > 1) {
                $data['results'] = $this->search_model->multiSearch($keyword);
            }
            if (empty($data['results'])) {
                $data['not_results'] = TRUE;
                $data['keyword'] = $keyword;
            }

            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('pages/search_result', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['invalid_results'] = TRUE;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('pages/search_result', $data);
            $this->load->view('templates/footer', $data);
        }
    }

}

?>
    
<?php

Class Search Extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('search_model');
    }

    function search_keyword() {

        $keyword = $this->input->post('keyword');


        if ($keyword <> '') {
            //CUENTA EL NUMERO DE PALABRAS 
            $trace = explode(" ", $keyword);
            $number = count($trace);
            if ($number == 1) {
                $data['results'] = $this->search_model->simple_search($keyword);
            } elseif ($number > 1) {
                $data['results'] = $this->search_model->multi_search($keyword);
            }


            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('pages/search_result', $data);
            $this->load->view('templates/footer', $data);
        }
    }

}
?>
    
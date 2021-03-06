<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adm extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('login_state') == true) {
            $data['title'] = 'Administrator | Home';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/adm_index');
            $this->load->view('adm/adm_footer');
        } else {
            $data['title'] = 'Administrator | Login';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/login');
            $this->load->view('adm/adm_footer');
        }
    }

}
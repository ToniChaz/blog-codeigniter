<?php

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
    }

    public function index() {
        if ($this->session->userdata('loginState') == true) {
            $data['profile'] = $this->profile_model->getProfile($this->session->userdata('activeUser'));
            
            $data['title'] = "Administrator | My profile";
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/profile', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('login');
        }
    }
}

?>

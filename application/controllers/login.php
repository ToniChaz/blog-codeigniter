<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {
        if ($this->session->userdata('loginState') == true) {
            redirect('adm');
        } else {
            $data['title'] = 'Administrator | Login';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/login', $data);
            $this->load->view('adm/adm_footer');
        }
    }

    public function checkLogin() {
        $this->form_validation->set_rules('user', 'User', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_verifyUser');

        if ($this->input->post('logout')) {
            $this->session->set_userdata('loginState', false);
            redirect('adm');
            return false;
        }

        if ($this->form_validation->run() == false) {
            if ($this->input->post('formLogin')) {
                $data['alertMessage'] = validation_errors();
            }
            $data['title'] = 'Administrator | Login';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/login', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('adm');
        }
    }

    public function verifyUser() {
        $user = $this->input->post('user');
        $password = $this->input->post('password');

        $query = $this->login_model->login($user, $password);
        
        if ($query->num_rows() == 1) {            
            $userData = $query->result_array();
            $sessionUserData = array(
                'loginState' => true,
                'activeUser' => $userData[0]['user'],
                'role' => $userData[0]['role']
            );            
            $this->session->set_userdata($sessionUserData);
            return true;
        } else {
            $this->form_validation->set_message('verifyUser', 'Change a few things up and try submitting again..');
            return false;
        }
    }

}

?>

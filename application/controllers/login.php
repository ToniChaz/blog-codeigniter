<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->helper('cookie');
    }

    public function index() {
        if ($this->session->userdata('login_state') == true) {
            redirect('adm');
        } else {
            $data['title'] = 'Administrator | Login';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/login', $data);
            $this->load->view('adm/adm_footer');
        }
    }

    public function check_login() {
        $this->form_validation->set_rules('user', 'User', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_verify_user');

        if ($this->input->post('logout')) {
            delete_cookie('ci_session'); 
            redirect('adm');
            return false;
        }

        if ($this->form_validation->run() == false) {
            if ($this->input->post('form_login')) {
                $data['alert_message'] = validation_errors();
            }
            $data['title'] = 'Administrator | Login';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/login', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('adm');
        }
    }

    public function verify_user() {
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        //$remember = $this->input->post("remember");

        $query = $this->login_model->login($user, $password);
        
        if ($query->num_rows() == 1) {            
            $user_data = $query->result_array();
            $session_user_data = array(
                'login_state' => true,
                'active_user' => $user_data[0]['user'],
                'role' => $user_data[0]['role']
            );
            $this->session->set_userdata($session_user_data);
//            if($remember == 'on'){
//                $this->session->set_userdata($session_user_data);
//            }
            return true;
        } else {
            $this->form_validation->set_message('verify_user', 'Change a few things up and try submitting again..');
            return false;
        }
    }

}

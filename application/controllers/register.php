<?php

class Register extends CI_Controller {
        
    function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index() {
        if ($this->session->userdata('loginState') == true) {
            $data['title'] = "Administrator | Register";
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/register');
            $this->load->view('adm/adm_footer');
        } else {
            redirect('login');
        }
    }

    public function checkRegister() {
        if ($_FILES['userfile']['error'] == 0) {
            $config = array(
                'upload_path' => realpath(APPPATH . '../avatar'),
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '2000',
            );            

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $data['formRegisterError'] = 'Check your avatar';
                $data['title'] = "Administrator | Register";
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/register', $data);
                $this->load->view('adm/adm_footer');
                return false;
            }
        }

        $this->form_validation->set_rules('user', 'User', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required|callback_verifyUnicUser');


        if ($this->form_validation->run() == false) {
            if ($this->input->post('formRegister')) {
                $data['formRegisterError'] = validation_errors();
            }
            $data['title'] = "Administrator | Register";
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/register', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('adm');
        }
    }

    public function verifyUnicUser() {
        $user = $this->input->post('user');

        $this->register_model->verifyUnicUser($user);

        if ($this->register_model->verifyUnicUser($user)) {
            $this->register_model->registerUser();
            $this->session->set_userdata('loginState', true);
            return true;
        } else {
            $this->form_validation->set_message('verifyUnicUser', 'This user is not available! Please try again..');
            return false;
        }
    }

}

?>

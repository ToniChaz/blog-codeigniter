<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login_state') == true) {
            $this->load->model('register_model');
        } else {
            redirect('login');
        }
    }

    public function index() {
        if ($this->session->userdata('role') == 0 && $this->session->userdata('login_state') == true) {
            $data['title'] = 'Administrator | Register';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/register');
            $this->load->view('adm/adm_footer');
        } else if ($this->session->userdata('login_state') == true) {
            redirect('adm');
        }
    }

    public function check_register() {
        if ($_FILES['userfile']['error'] == 0) {

            $config_upload = array(
                'upload_path' => realpath(APPPATH . '../media/avatar'),
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => 2048,
            );
            $this->load->library('upload', $config_upload);

            if (!$this->upload->do_upload()) {
                $data['alert_message'] = 'Check your avatar';
                $data['title'] = 'Administrator | Register';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/register', $data);
                $this->load->view('adm/adm_footer');
                return false;
            }

            $config_resize = array(
                'image_library' => 'gd2',
                'source_image' => $_FILES['userfile']['tmp_name'],
                'new_image' => realpath(APPPATH . '../media/avatar/thumb') . '/' . $_FILES['userfile']['name'],
                'maintain_ratio' => true,
                'width' => 150,
                'height' => 150,
            );
            $this->load->library('image_lib', $config_resize);

            if (!$this->image_lib->resize()) {
                $data['alert_message'] = 'Error to resize your avatar, please try again.';
                $data['title'] = 'Administrator | Register';
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
        $this->form_validation->set_rules('surname', 'Surname', 'required');


        if ($this->form_validation->run() == false) {
            $data['alert_message'] = validation_errors();
            $data['title'] = 'Administrator | Register';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/register', $data);
            $this->load->view('adm/adm_footer');
        } else {
            if ($this->verify_unic_user()) {
                $data['title'] = 'Administrator | Home';
                $data['alert_message'] = '<strong>Well done!</strong> Registration has been completed successfully.';
                $data['class'] = 'alert-success';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/adm_index', $data);
                $this->load->view('adm/adm_footer');
            } else {
                $data['alert_message'] = 'This user is not available! Please try again..';
                $data['title'] = 'Administrator | Register';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/register', $data);
                $this->load->view('adm/adm_footer');
            }
        }
    }

    public function verify_unic_user() {
        $user = $this->input->post('user');

        $this->register_model->verify_unic_user($user);

        if ($this->register_model->verify_unic_user($user)) {
            $this->register_model->register_user();
            return true;
        } else {
            return false;
        }
    }

}

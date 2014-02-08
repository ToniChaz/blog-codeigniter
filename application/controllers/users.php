<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->data = array(
            'allUsers' => $this->users_model->getUsers()
        );
    }

    public function index() {
        $data = $this->data;
        if ($this->session->userdata('role') == 0) {
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer');
        } else if ($this->session->userdata('loginState') == true) {
            redirect('adm');
        } else {
            redirect('login');
        }
    }

    public function updateUser() {
        $user = $this->input->post('user');
        $role = $this->input->post('role');

        if ($this->users_model->updateUser($user, $role)) {
            $data['allUsers'] = $this->users_model->getUsers();
            $data['alertMessage'] = '<strong>Oh yeah!</strong> The user has been successfully updated.';
            $data['class'] = 'alert-success';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer');
        } else {
            $data['alertMessage'] = '<strong>Oh sheet!</strong> Something went wrong try again.';
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer');
        }
    }

    public function deleteUser() {
        $user = $_POST['user'];
        $safeUser = $_POST['safeUser'];

        if ($user == $safeUser) {
            $query = $this->users_model->deleteUser($user);
            if(!empty($query[0]['avatarurl'])){
                unlink(realpath(APPPATH . '../avatar') . '/' . $query[0]['avatarurl']);
                unlink(realpath(APPPATH . '../avatar/thumb') . '/' . $query[0]['avatarurl']);
            }
            echo 'ok';
        } else {
            echo 'false';
        }
    }

}

?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginState') == true) {
            $this->load->model('users_model');
            $this->data = array(
                'allUsers' => $this->users_model->getUsers()
            );
        } else {
            redirect('login');
        }
    }

    public function index() {
        $data = $this->data;
        if ($this->session->userdata('role') == 0 && $this->session->userdata('loginState') == true) {
            $data['title'] = 'Administrator | Users';
            $data['js'] = 'Main.user();';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        } else if ($this->session->userdata('loginState') == true) {
            redirect('adm');
        }
    }

    public function updateUser() {
        $user = $this->input->post('user');
        $role = $this->input->post('role');
        $data['js'] = 'Main.user();';

        if ($this->users_model->updateUser($user, $role)) {
            $data['allUsers'] = $this->users_model->getUsers();
            $data['alertMessage'] = '<strong>Oh yeah!</strong> The user has been successfully updated.';
            $data['class'] = 'alert-success';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        } else {
            $data['alertMessage'] = '<strong>Oh sheet!</strong> Something went wrong try again.';
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        }
    }

    public function deleteUser() {
        $id = $_POST['id'];
        $safeInput = $_POST['safeInput'];

        $users = $this->users_model->getUsers();
        
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->id == $id && $users[$i]->user == $safeInput) {
                $query = $this->users_model->deleteUser($safeInput);
                if (!empty($query[0]['avatarurl'])) {
                    unlink(realpath(APPPATH . '../media/avatar') . '/' . $query[0]['avatarurl']);
                    unlink(realpath(APPPATH . '../media/avatar/thumb') . '/' . $query[0]['avatarurl']);
                }
                echo 'ok';
                return false;
            }
        }
        echo 'false';
    }

}

?>
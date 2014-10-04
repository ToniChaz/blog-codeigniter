<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login_state') == true) {
            $this->load->model('users_model');
            $this->data = array(
                'all_users' => $this->users_model->get_users()
            );
        } else {
            redirect('login');
        }
    }

    public function index() {
        $data = $this->data;
        if ($this->session->userdata('role') == 0 && $this->session->userdata('login_state') == true) {
            $data['title'] = 'Administrator | Users';
            $data['js'] = 'Main.user();';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        } else if ($this->session->userdata('login_state') == true) {
            redirect('adm');
        }
    }

    public function update_user() {
        $user = $this->input->post('user');
        $role = $this->input->post('role');
        $data['js'] = 'Main.user();';

        if ($this->users_model->update_user($user, $role)) {
            $data['all_users'] = $this->users_model->get_users();
            $data['alert_message'] = '<strong>Oh yeah!</strong> The user has been successfully updated.';
            $data['class'] = 'alert-success';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        } else {
            $data['alert_message'] = '<strong>Oh sheet!</strong> Something went wrong try again.';
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Users';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/users', $data);
            $this->load->view('adm/adm_footer', $data);
        }
    }

    public function delete_user() {
        $id = $_POST['id'];
        $safe_input = $_POST['safe_input'];

        $users = $this->users_model->get_users();
        
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->id == $id && $users[$i]->user == $safe_input) {
                $query = $this->users_model->delete_user($safe_input);
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
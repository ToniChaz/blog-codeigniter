<?php

class Profile extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login_state') == true) {
            $this->load->model('profile_model');
            $this->data = array(
                'profile' => $this->profile_model->get_profile($this->session->userdata('active_user'))
            );
        } else {
            redirect('login');
        }
    }

    public function index() {
        $data = $this->data;
        $data['title'] = 'Administrator | My profile';
        $data['js'] = 'Main.profile();';
        $this->load->view('adm/adm_header', $data);
        $this->load->view('adm/adm_topbar');
        $this->load->view('adm/profile', $data);
        $this->load->view('adm/adm_footer', $data);
    }

    public function check_profile_data() {
        $data = $this->data;
        $data['js'] = 'Main.profile();';

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0) {

            if (!empty($data['profile']['avatarurl'])) {
                if (file_exists(realpath(APPPATH . '../media/avatar') . '/' . $data['profile']['avatarurl'])) {
                    unlink(realpath(APPPATH . '../media/avatar') . '/' . $data['profile']['avatarurl']);
                }
                if (file_exists(realpath(APPPATH . '../media/avatar/thumb') . '/' . $data['profile']['avatarurl'])) {
                    unlink(realpath(APPPATH . '../media/avatar/thumb') . '/' . $data['profile']['avatarurl']);
                }
            }

            $config_upload = array(
                'upload_path' => realpath(APPPATH . '../media/avatar'),
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => 2048,
            );
            $this->load->library('upload', $config_upload);

            if (!$this->upload->do_upload()) {
                $data['alert_message'] = 'Check your avatar';
                $data['class'] = 'alert-danger';
                $data['title'] = 'Administrator | Register';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/profile', $data);
                $this->load->view('adm/adm_footer', $data);
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
                $this->load->view('adm/adm_footer', $data);
                return false;
            }
        }
        $this->form_validation->set_rules('user', 'User', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required');

        if ($this->form_validation->run() == false) {

            if (validation_errors() != false) {
                $data['alert_message'] = validation_errors();
            }
            $data['title'] = 'Administrator | Profile';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/profile', $data);
            $this->load->view('adm/adm_footer', $data);
        } else {
            if ($this->verify_change_user()) {
                $data['profile'] = $this->profile_model->get_profile($this->session->userdata('active_user'));
                $data['title'] = 'Administrator | Profile';
                $data['alert_message'] = '<strong>Well done!</strong> Your data has been successfully updated.';
                $data['class'] = 'alert-success';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/profile', $data);
                $this->load->view('adm/adm_footer', $data);
            } else {
                $data['class'] = 'alert-danger';
                $data['alert_message'] = '<strong>Oh sheet!</strong> You can not change the user name!';
                $data['title'] = 'Administrator | Profile';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/profile', $data);
                $this->load->view('adm/adm_footer', $data);
            }
        }
    }

    public function verify_change_user() {
        $user = $this->input->post('user');

        $this->profile_model->verify_change_user($user);

        if ($this->profile_model->verify_change_user($user)) {
            $this->profile_model->update_profile($user);
            return true;
        } else {
            return false;
        }
    }

    public function delete_profile() {
        $data = $this->data;
        $password = $_POST['safe_input'];
        $user = $this->session->userdata['active_user'];

        if ($this->profile_model->delete_profile($user, $password)) {
            $this->session->unset_userdata('login_state');
            $this->session->unset_userdata('active_user');
            if (!empty($data['profile']['avatarurl'])) {
                unlink(realpath(APPPATH . '../media/avatar') . '/' . $data['profile']['avatarurl']);
                unlink(realpath(APPPATH . '../media/avatar/thumb') . '/' . $data['profile']['avatarurl']);
            }
            return false;
        } else {
            echo 'false';
        }
    }

}

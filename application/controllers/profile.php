<?php

class Profile extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->data = array(
            'profile' => $this->profile_model->getProfile($this->session->userdata('activeUser'))
        );
    }

    public function index() {
        if ($this->session->userdata('loginState') == true) {
            $data = $this->data;
            $data['title'] = 'Administrator | My profile';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/profile', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('login');
        }
    }

    public function checkProfileData() {
        if ($this->session->userdata('loginState') == true) {
            $data = $this->data;

            if ($_FILES['userfile']['error'] == 0) {

                if (!empty($data['profile']['avatarurl'])) {
                    unlink(realpath(APPPATH . '../media/avatar') . '/' . $data['profile']['avatarurl']);
                    unlink(realpath(APPPATH . '../media/avatar/thumb') . '/' . $data['profile']['avatarurl']);
                }

                $configUpload = array(
                    'upload_path' => realpath(APPPATH . '../media/avatar'),
                    'allowed_types' => 'gif|jpg|jpeg|png',
                    'max_size' => 2048,
                );
                $this->load->library('upload', $configUpload);

                if (!$this->upload->do_upload()) {
                    $data['alertMessage'] = 'Check your avatar';
                    $data['class'] = 'alert-danger';
                    $data['title'] = 'Administrator | Register';
                    $this->load->view('adm/adm_header', $data);
                    $this->load->view('adm/adm_topbar');
                    $this->load->view('adm/profile', $data);
                    $this->load->view('adm/adm_footer');
                    return false;
                }

                $configResize = array(
                    'image_library' => 'gd2',
                    'source_image' => $_FILES['userfile']['tmp_name'],
                    'new_image' => realpath(APPPATH . '../media/avatar/thumb') . '/' . $_FILES['userfile']['name'],
                    'maintain_ratio' => true,
                    'width' => 150,
                    'height' => 150,
                );
                $this->load->library('image_lib', $configResize);

                if (!$this->image_lib->resize()) {
                    $data['alertMessage'] = 'Error to resize your avatar, please try again.';
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
                $data['alertMessage'] = validation_errors();
                $data['title'] = 'Administrator | Profile';
                $this->load->view('adm/adm_header', $data);
                $this->load->view('adm/adm_topbar');
                $this->load->view('adm/profile', $data);
                $this->load->view('adm/adm_footer');
            } else {
                if ($this->verifyChangeUser()) {
                    $data['profile'] = $this->profile_model->getProfile($this->session->userdata('activeUser'));
                    $data['title'] = 'Administrator | Profile';
                    $data['alertMessage'] = '<strong>Well done!</strong> Your data has been successfully updated.';
                    $data['class'] = 'alert-success';
                    $this->load->view('adm/adm_header', $data);
                    $this->load->view('adm/adm_topbar');
                    $this->load->view('adm/profile', $data);
                    $this->load->view('adm/adm_footer');
                } else {
                    $data['class'] = 'alert-danger';
                    $data['alertMessage'] = '<strong>Oh sheet!</strong> You can not change the user!';
                    $data['title'] = 'Administrator | Profile';
                    $this->load->view('adm/adm_header', $data);
                    $this->load->view('adm/adm_topbar');
                    $this->load->view('adm/profile', $data);
                    $this->load->view('adm/adm_footer');
                }
            }
        } else {
            redirect('login');
        }
    }

    public function verifyChangeUser() {
        $user = $this->input->post('user');

        $this->profile_model->verifyChangeUser($user);

        if ($this->profile_model->verifyChangeUser($user)) {
            $this->profile_model->updateProfile($user);
            return true;
        } else {
            return false;
        }
    }

    public function deleteProfile() {
        if ($this->session->userdata('loginState') == true) {
            $data = $this->data;
            $password = $_POST['password'];
            $user = $this->session->userdata['activeUser'];

            if ($this->profile_model->deleteProfile($user, $password)) {
                $this->session->unset_userdata('loginState');
                $this->session->unset_userdata('activeUser');
                if (!empty($data['profile']['avatarurl'])) {
                    unlink(realpath(APPPATH . '../media/avatar') . '/' . $data['profile']['avatarurl']);
                    unlink(realpath(APPPATH . '../media/avatar/thumb') . '/' . $data['profile']['avatarurl']);
                }
                return false;
            } else {
                echo 'false';
            }
        } else {
            redirect('login');
        }
    }

}

?>

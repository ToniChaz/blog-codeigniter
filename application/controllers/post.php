<?php

class Post extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login_state') == true) {
            $this->load->model('post_model');
            $this->load->model('users_model');
            $this->data = array(
                'all_users' => $this->users_model->get_users()
            );
        } else {
            redirect('login');
        }
    }

    public function index($filter = null) {
        $data['js'] = 'Main.deletePost();';

        if ($this->session->userdata('role') == 0 && $this->session->userdata('login_state') == true && $filter == 'all') {
            $data['all_posts'] = $this->post_model->get_posts();

            $data['title'] = 'Administrator | Posts';

            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer', $data);
        } else if ($this->session->userdata('login_state') == true && $filter == null) {
            $data = $this->data;
            $data['all_posts'] = $this->post_model->get_posts($this->session->userdata('active_user'));
            $data['active_name_user'] = $this->return_active_user($data['all_users']);
            $data['title'] = 'Administrator | Posts';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer', $data);
        }else{
            show_404();
        }
    }
    
    public function edit($id = null, $message = '') {
        $data['single_post'] = $this->post_model->get_single_post($id);
        $data['js'] = 'Main.post();';

        if (empty($data['single_post'])) {
            show_404();
        }
        if (!empty($message)) {
            if ($message == 'update') {
                $data['alert_message'] = 'Your post has been modified successfully.';
            } else if ($message == 'create') {
                $data['alert_message'] = 'Your post was successfully saved.';
            }
            $data['class'] = 'alert-success';
        }
        $data['title'] = 'Administrator | Edit';
        $this->load->view('adm/adm_header', $data);
        $this->load->view('adm/adm_topbar');
        $this->load->view('adm/post', $data);
        $this->load->view('adm/adm_footer', $data);
    }

    public function create() {
        $data = $this->data;
        $data['js'] = 'Main.post();';

        $data['create_post'] = $this->return_active_user($data['all_users']);

        $data['title'] = 'Administrator | Create';
        $this->load->view('adm/adm_header', $data);
        $this->load->view('adm/adm_topbar');
        $this->load->view('adm/post', $data);
        $this->load->view('adm/adm_footer', $data);
    }

    public function return_active_user($all_users) {
        foreach ($all_users as &$valor) {
            if ($valor->user == $this->session->userdata('active_user')) {
                $active_user = $valor->name . ' ' . $valor->surname;
                return $active_user;
            }
        }
    }

    public function return_author_user($id) {
        $current_post = $this->post_model->get_single_post($id);
        return $current_post->author;
    }

    public function return_post_user($id) {
        $current_post = $this->post_model->get_single_post($id);
        return $current_post->postuser;
    }

    public function slug_generator($str) {
        $search = array(
            'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç',
            'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï',
            'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ő',
            'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ű', 'Ý', 'Þ',
            'ß',
            'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç',
            'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï',
            'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ő',
            'ø', 'ù', 'ú', 'û', 'ü', 'ű', 'ý', 'þ',
            'ÿ', '©', ' '
        );
        $replace = array(
            'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C',
            'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I',
            'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O',
            'O', 'U', 'U', 'U', 'U', 'U', 'Y', 'TH',
            'ss',
            'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
            'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i',
            'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o',
            'o', 'u', 'u', 'u', 'u', 'u', 'y', 'th',
            'y', '(c)', '-'
        );
        $clean_str = str_ireplace($search, $replace, strtolower(trim($str)));
        return strtolower($clean_str);
    }

    public function create_post() {
        $data = $this->data;
        $data['js'] = 'Main.post();';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() == false) {
            $data['alert_message'] = validation_errors();
            $data['create_post'] = $this->return_active_user($data['all_users']);
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Create';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer', $data);
        } else {
            $author = $this->return_active_user($data['all_users']);

            if ($this->input->post('date') == '') {
                $date = date("Y-m-d");
            } else {
                $date = $this->input->post('date');
            }
            if ($this->input->post('status') == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }
            $slug = $this->slug_generator($this->input->post('slug'));

            $this->post_model->create_post($author, $date, $slug, $status);

            redirect('post');
        }
    }

    public function update_post() {
        $data = $this->data;
        $data['js'] = 'Main.post();';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() == false) {
            $data['alert_message'] = validation_errors();
            if ($this->session->userdata('role') == 0) {
                $data['create_post'] = $this->return_post_user($this->input->post('id'));
            } else {
                $data['create_post'] = $this->return_active_user($data['all_users']);
            }
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Edit';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer', $data);
        } else {
            if ($this->session->userdata('role') == 0) {
                $author = $this->return_author_user($this->input->post('id'));
                $post_user = $this->return_post_user($this->input->post('id'));
            } else {
                $author = $this->return_active_user($data['all_users']);
                $post_user = $this->session->userdata('active_user');
            }

            if ($this->input->post('date') == '') {
                $date = date("Y-m-d");
            } else {
                $date = $this->input->post('date');
            }
            if ($this->input->post('status') == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }

            $slug = $this->slug_generator($this->input->post('slug'));

            $this->post_model->update_post($author, $post_user, $date, $slug, $status);

            $this->edit($this->input->post('id'), 'update');
        }
    }

    public function delete_post() {
        $id = $_POST['id'];
        $safe_input = $_POST['safe_input'];

        $post_to_delete = $this->post_model->get_single_post($id);

        if ($post_to_delete->id == $id && $this->session->userdata('active_user') == $safe_input) {
            $this->post_model->delete_post($id);
            echo 'ok';
        } else {
            echo 'false';
        }
    }

}

<?php

class Post extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('users_model');
        $this->data = array(
            'allUsers' => $this->users_model->getUsers()
        );
    }

    public function index($filter = null) {
        if ($this->session->userdata('role') == 0 && $this->session->userdata('loginState') == true && $filter == 'all') {
            $data['allPosts'] = $this->post_model->getPosts();

            $data['title'] = 'Administrator | Posts';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer');
        } else if ($this->session->userdata('loginState') == true && $filter == null) {
            $data['allPosts'] = $this->post_model->getPosts($this->session->userdata('activeUser'));
            $data['title'] = 'Administrator | Posts';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer');
        } else {
            redirect('login');
        }
    }

    public function edit($id = null, $message = '') {
        $data['singlePost'] = $this->post_model->getSinglePost($id);

        if (empty($data['singlePost'])) {
            show_404();
        }
        if (!empty($message)) {
            if ($message == 'update') {
                $data['alertMessage'] = 'Your post has been modified successfully.';
            } else if ($message == 'create') {
                $data['alertMessage'] = 'Your post was successfully saved.';
            }
            $data['class'] = 'alert-success';
        }
        $data['title'] = 'Administrator | Edit';
        $this->load->view('adm/adm_header', $data);
        $this->load->view('adm/adm_topbar');
        $this->load->view('adm/post', $data);
        $this->load->view('adm/adm_footer');
    }

    public function create() {
        $data = $this->data;

        $data['createPost'] = $this->returnActiveUser($data['allUsers']);

        $data['title'] = 'Administrator | Create';
        $this->load->view('adm/adm_header', $data);
        $this->load->view('adm/adm_topbar');
        $this->load->view('adm/post', $data);
        $this->load->view('adm/adm_footer');
    }

    public function returnActiveUser($allUsers) {
        foreach ($allUsers as &$valor) {
            if ($valor->user == $this->session->userdata('activeUser'))
                $activeUser = $valor->name . ' ' . $valor->surname;
            return $activeUser;
        }
    }
    
    public function returnPostUser($id) {
        $currentPost = $this->post_model->getSinglePost($id);
        return $currentPost->author;
    }
    
    public function slugGenerator($str) {
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
        $cleanStr = str_ireplace($search, $replace, strtolower(trim($str)));
        return strtolower($cleanStr);
    }

    public function createPost() {
        $data = $this->data;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() == false) {
            $data['alertMessage'] = validation_errors();
            $data['createPost'] = $this->returnActiveUser($data['allUsers']);
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Create';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer');
        } else {
            $author = $this->returnActiveUser($data['allUsers']);

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
            $slug = $this->slugGenerator($this->input->post('slug'));

            $this->post_model->createPost($author, $date, $slug, $status);

            $this->edit($this->input->post('id'), 'create');
        }
    }

    public function updatePost() {
        $data = $this->data;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() == false) {
            $data['alertMessage'] = validation_errors();
            if($this->session->userdata('role') == 0){
                $data['createPost'] = $this->returnPostUser($this->input->post('id'));
            }else{
                $data['createPost'] = $this->returnActiveUser($data['allUsers']);
            }
            $data['class'] = 'alert-danger';
            $data['title'] = 'Administrator | Edit';
            $this->load->view('adm/adm_header', $data);
            $this->load->view('adm/adm_topbar');
            $this->load->view('adm/post', $data);
            $this->load->view('adm/adm_footer');
        } else {
            if($this->session->userdata('role') == 0){
                $author = $this->returnPostUser($this->input->post('id'));
            }else{
                $author = $this->returnActiveUser($data['allUsers']);
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
            
            $slug = $this->slugGenerator($this->input->post('slug'));

            $this->post_model->updatePost($author, $date, $slug, $status);

            $this->edit($this->input->post('id'), 'update');
        }
    }

}

?>

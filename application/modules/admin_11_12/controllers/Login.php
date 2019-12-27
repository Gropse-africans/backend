
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_model'));

        if ($this->session->userdata('af_s_m_admin_logged_in')) {
            redirect('admin/dashboard');
        }
    }

    public function index() {
        $this->form_validation->set_error_delimiters('<p style="color:#ff7702;">', '</p>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('index');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->Admin_model->admin_login($email, $password);

            if ($result) {
                $sessionArr = ['admin_id' => $result['id'], 'username' => $result['username']];
                $this->session->set_userdata('admin_logged_in', $sessionArr);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>E-mail or password is incorrect</div>');
                redirect('admin');
            }
        }
    }
    
    public function ajax() {
        $this->load->view('ajax_server');
    }

   

}
?>



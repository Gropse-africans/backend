<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        unset($_REQUEST['ci_session']);
    }
    
    public function index() {
        $this->load->view('index');
    }
    
    public function userRegister() {
        $this->load->view('UserView/user_register');
    }
    
    public function verifyOtp() {
        $this->load->view('UserView/verify_otp');
    }

    public function userLogin() {
        $this->load->view('UserView/user_login');
    }
    
    public function createOtp() {
        $this->load->view('UserView/create_otp');
    }
    
    public function resetPassword() {
        $this->load->view('UserView/reset_password');
    }

    public function getProfile() {
        $this->load->view('UserView/get_profile');
    }

    public function editProfile() {
        $this->load->view('UserView/edit_profile');
    }
    
    public function uploadImage() {
        $this->load->view('UserView/upload_image');
    }
    
    public function checkPassword(){
        $this->load->view('UserView/check_password');
    }
    
    public function getHomepage() {
        $this->load->view('UserView/get_homepage');
    }
    
    public function getCategory() {
        $this->load->view('UserView/get_category');
    }
    
    public function getCategoryProducts() {
        $this->load->view('UserView/get_category_products');
    }
    
    public function productDetail() {
        $this->load->view('UserView/product_detail');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
}

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
    
    public function getReviews() {
        $this->load->view('UserView/get_reviews');
    }
    
    public function addReviews() {
        $this->load->view('UserView/add_reviews');
    }
    
    public function addToCart() {
        $this->load->view('UserView/add_to_cart');
    }
    
    public function getMyCart() {
        $this->load->view('UserView/get_my_cart');
    }
    
    public function addToFavourite() {
        $this->load->view('UserView/add_to_favourite');
    }
    
    public function myFavouriteList() {
        $this->load->view('UserView/my_favourite_list');
    }
    
    public function searchProduct() {
        $this->load->view('UserView/search_product');
    }
    
    public function filterProduct() {
        $this->load->view('UserView/filter_product');
    }
    
    public function adsList() {
        $this->load->view('UserView/ads_list');
    }
    
    
    public function getServiceCategory() {
        $this->load->view('UserView/get_service_category');
    }
    
    public function getServiceList() {
        $this->load->view('UserView/get_service_list');
    }
    
    public function getServiceDetail() {
        $this->load->view('UserView/get_service_detail');
    }
    
    public function getSimilarServices() {
        $this->load->view('UserView/get_similar_services');
    }
    
    public function getServiceReviews() {
        $this->load->view('UserView/get_service_reviews');
    }
    
    public function addServiceReviews() {
        $this->load->view('UserView/add_service_reviews');
    }
    
    public function serviceBooking() {
        $this->load->view('UserView/service_booking');
    }
    
    public function placeOrder() {
        $this->load->view('UserView/place_order');
    }
    
    public function myOrders() {
        $this->load->view('UserView/my_orders');
    }
    
    public function orderDetail() {
        $this->load->view('UserView/order_detail');
    }
    
    public function myBookings() {
        $this->load->view('UserView/my_bookings');
    }
    
    public function bookingDetail() {
        $this->load->view('UserView/booking_detail');
    }
    
    public function filterVendor() {
        $this->load->view('UserView/filter_vendor');
    }
    
    public function submitContactUs() {
        $this->load->view('UserView/submit_contact_us');
    }
    
    public function getContactSubject() {
        $this->load->view('UserView/get_contact_subject');
    }
    
    
    public function sendMessage() {
        $this->load->view('UserView/send_message');
    }
    public function getMessageDetail() {
        $this->load->view('UserView/get_message_detail');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
}

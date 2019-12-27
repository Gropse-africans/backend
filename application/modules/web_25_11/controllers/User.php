<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Api_model', 'User_model'));
        if (!($this->session->userdata('customer_logged_in'))) {
            redirect('login');
        } else {
            $this->userdata = $this->session->userdata('customer_logged_in');
            $this->header = $this->get_header();
        }
    }

    public function index() {
        $id = $this->userdata['user_id'];
        $strPost['user_id'] = $id;

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];
        $path = 'getProfile';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//        $data['myCart'] = $this->myCart();
        if ($returnArr['error_code'] == '301') {
            $this->session->unset_userdata('customer_logged_in');
            $this->session->flashdata('response', 'Authentication failed. Please log-in');
            redirect('login');
        } else {
            $data['user'] = $returnArr['data'];
//        echo "<pre>"; print_r($returnArr); die;
            $data['header'] = $this->header;
            $data['view_link'] = 'user/my_account';
            $this->load->view('layout/template', $data);
        }
    }

    public function edit_profile() {
        $id = $this->userdata['user_id'];
//        echo "<pre>"; print_r($this->userdata);
        $strPost = [
            'user_id' => $id
        ];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];

        if (isset($_POST['name'])) {
            if (isset($_FILES['profile_image'])) {
                $uploadPath = 'uploads/user/';
                if (!empty($_FILES['profile_image']['name'])) {

                    $file_ext = explode('.', $_FILES["profile_image"]['name']);
                    $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath . $uploadFile)) {

                        $strPost['image'] = base_url() . $uploadPath . $uploadFile;
                    }
                }
            }
            $strPost['name'] = $this->input->post('name');
            $strPost['mobile'] = $this->input->post('mobile');

            $returnData = $this->Api_model->apiCallHeader('editProfile', $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);

            if ($returnArr['error_code'] == 200) {
                $this->session->set_flashdata('response', '<span class="text-success">Personal Details Updated Successfully</span>');
                redirect('my-account');
            } else if ($returnArr['error_code'] == '301') {
                $this->session->unset_userdata('customer_logged_in');
                $this->session->flashdata('response', 'Authentication failed. Please log-in');
                redirect('login');
            } else {
                $this->session->set_flashdata('response', '<span class="text-danger">Error Occured. Try Again</span>');
                redirect('edit-account');
            }
        } else {
            $path = 'getProfile';
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);
//        $data['myCart'] = $this->myCart();
//         echo "<pre>"; print_r($returnArr);exit;
            if ($returnArr['error_code'] == '301') {
                $this->session->unset_userdata('customer_logged_in');
                $this->session->flashdata('response', 'Authentication failed. Please log-in');
                redirect('login');
            } else {

                $data['user'] = $returnArr['data'];

                $data['header'] = $this->header;
                $data['view_link'] = 'user/edit_account';
//            echo "<pre>"; print_r($data['data']);exit;
                $this->load->view('layout/template', $data);
            }
        }
    }

    public function mycart() {
        if ($this->session->userdata('user_logged_in')) {
            $userdata = $this->session->userdata('user_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
        } else {
            $strPost['user_id'] = '';
            if (isset($_COOKIE['souqalasal'])) {
                $strPost['user_id'] = $_COOKIE['souqalasal'];
            } else {
                $strPost['user_id'] = '';
            }
        }

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];

        $path = 'myCart';

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        //print_r($returnArr);exit;
        return $returnArr;
    }

    public function proceed_checkout() {
        $data['categories'] = $this->get_header();
        $data['myCart'] = $this->myCart();
        $strPost = [];
        $path = 'getCountry';
        $returnData = $this->Web_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr) {
            $data['country_list'] = $returnArr['data'];
        } else {
            $data['country_list'] = [];
        }
        //print_r($data['myCart']);exit;
        if ($data['myCart']['data']) {
// echo "<pre>";        print_r($returnArr);exit;
            $data['view_link'] = 'user/place_order_checkout';
            $this->load->view('layout/template', $data);
        } else {
            redirect('checkout');
        }
    }

    function place_order() {
        $path = 'checkout';
        $strPost = [
            'user_id' => $this->userdata['user_id'],
            'address_id' => $this->input->post('address'),
            'payment_type' => $this->input->post('method'),
            'amount' => $this->input->post('amount')
        ];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        }
    }

    function successpage() {
        $strPost = [
            'user_id' => $this->userdata['user_id']
        ];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];
        $data['myCart'] = $this->myCart();
        $data['categories'] = $this->get_header();
        $data['view_link'] = 'user/successpage';
        $this->load->view('layout/template', $data);
    }

    function my_orders() {
        $path = 'myOrders';
        $strPost = [
            'user_id' => $this->userdata['user_id']
        ];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];
        $data['myCart'] = $this->myCart();
        $data['categories'] = $this->get_header();
        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        //print_r($returnArr);exit;
        $data['orders'] = $returnArr;
        $data['view_link'] = 'user/my_orders';
        $this->load->view('layout/template', $data);
    }

    function order_detail() {
        $id = $this->uri->segment(2);
        $path = 'orderDetail';
        $strPost = [
            'user_id' => $this->userdata['user_id'],
            'order_id' => $id
        ];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        $data['myCart'] = $this->myCart();
        $data['categories'] = $this->get_header();
        $data['order'] = $returnArr; //print_r($returnArr);exit;
        $data['view_link'] = 'user/order_detail';
        $this->load->view('layout/template', $data);
    }

    function wishlist() {
        $path = 'myFavouriteList';
        $strPost = [
            'user_id' => $this->userdata['user_id']
        ];
        $headerArr = [
            'lang' => 'en',
            'device_id' => $this->userdata['device_id'],
            'security_token' => $this->userdata['security_token']
        ];
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->get_header();
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr['error_code'] == '301') {
            $this->session->unset_userdata('customer_logged_in');
            $this->session->flashdata('response', 'Authentication failed. Please log-in');
            redirect('login');
        } else {
            $data['items'] = $returnArr['data']; // print_r($returnArr);exit;
            $data['view_link'] = 'user/wishlist';
            $this->load->view('layout/template', $data);
        }
    }

//
//    public function add_to_wishlist() {
//        $path = 'addToFavourite';
//        $strPost = [
//            'user_id' => $this->userdata['user_id'],
//            'product_id' => $this->input->post('id')
//        ];
//
//        $headerArr = [
//            'lang' => 'en',
//            'device_id' => $this->userdata['device_id'],
//            'security_token' => $this->userdata['security_token']
//        ];
//
//        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
//        $returnArr = json_decode($returnData, true);
//        if ($returnArr) {
//            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
//            echo json_encode($res);
//            die;
//        }
//    }

    public function change_password() {
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->header;
        $data['view_link'] = 'user/change_password';
        $this->load->view('layout/template', $data);
    }

    public function get_header() {
        $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $customer = $this->session->userdata('customer_logged_in');
        if ($customer) {
            $headerArr = ['lang' => 'en', 'device_id' => $customer['device_id'], 'security_token' => $customer['security_token']];
            $strPost['user_id'] = $customer['user_id'];
        } else {
            $strPost['user_id'] = '00';
        }
        $path = 'getCategory';

        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        $header = $returnArr['data'];
        return $header;
    }

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

    function my_random_string($char) {
        $characters = $char;
        $length = 20;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout() {

        $this->session->unset_userdata('user_logged_in');
        redirect(base_url());
    }

}

?>

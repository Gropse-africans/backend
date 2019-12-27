<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('User_model', 'Api_model'));
        $this->header = $this->get_header();
    }

    public function index() {
        header("Cache-Control: no-cache, must-revalidate");
        $customer = $this->session->userdata('customer_logged_in');
        if ($customer) {
            $strPost['user_id'] = $customer['user_id'];
            $headerArr = ['lang' => 'en', 'device_id' => $customer['device_id'], 'security_token' => $customer['security_token']];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
        $path = 'getHomepage';
//        print_r($strPost);
//        exit;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        $data['homepage'] = $returnArr['data'];
        $data['header'] = $this->header;
//        echo '<pre>';print_r($data['homepage']);exit;
        $data['view_link'] = 'index';
        $this->load->view('layout/template', $data);
    }

    function check_if_location() {
        if ($this->session->userdata('customer_logged_in')) {
            $user_data = $this->session->userdata('customer_logged_in');
            if ($user_data['lat'] && $user_data['lng']) {
                $strPost['latitude'] = $user_data['lat'];
                $strPost['longitude'] = $user_data['lng'];
                $strPost['address'] = $user_data['address'];
            } else {
                if ($this->session->userdata('user_location')) {
                    $user_location = $this->session->userdata('user_location');
                    $strPost['latitude'] = $user_location['latitude'];
                    $strPost['longitude'] = $user_location['longitude'];
                    $strPost['address'] = $user_location['address'];
                } else {
                    $strPost = array();
                }
            }
        } else if ($this->session->userdata('user_location')) {
            $user_location = $this->session->userdata('user_location');
            $strPost['latitude'] = $user_location['latitude'];
            $strPost['longitude'] = $user_location['longitude'];
            $strPost['address'] = $user_location['address'];
        } else {
            $strPost = array();
        }
        if ($strPost) {
            return $strPost;
        } else {
            return array();
        }
    }

    public function login() {
        if ($this->session->userdata('customer_logged_in')) {
            redirect(base_url());
        } else {
            $data['header'] = $this->header;
            $data['view_link'] = 'login';
            $this->load->view('layout/template', $data);
        }
    }

    public function register() {
        $data['header'] = $this->header;
        $data['view_link'] = 'register';
        $this->load->view('layout/template', $data);
    }

    public function verification() {
//        print_r($_SESSION);exit;
        if ($this->session->userdata('verify_email')) {
            $data['header'] = $this->header;
            $data['view_link'] = 'verification';
            $this->load->view('layout/template', $data);
        } else {
            $this->session->flashdata('response', '<div class="alert alert-danger"><span>Some Error Occured. Try Logging In To Verify Your Account.</span></div>');
            redirect('login');
        }
    }

    public function forgot_password() {
        if (!$this->session->userdata('customer_logged_in')) {
            $data['header'] = $this->header;
            $data['view_link'] = 'forgot_password';
            $this->load->view('layout/template', $data);
        } else {
            redirect(base_url());
        }
    }

    public function reset_password() {
//        $data['myCart'] = $this->myCart();
//        $data['categories'] = $this->get_header();

        if ($this->session->userdata('user_verification')) {
            $data['header'] = $this->header;
            $data['view_link'] = 'reset_password';
            $this->load->view('layout/template', $data);
        } else {
            $this->load->view('session_expired');
        }
    }

    public function product_list() {
        header("Cache-Control: no-cache, must-revalidate");
        $category_id = $this->uri->segment(2);
        $sub_category_id = $this->uri->segment(3);
//        print_r($_POST);
//        exit;
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
        $strPost['category_id'] = $category_id;
        $strPost['sub_category_id'] = $sub_category_id;

        $strPost['limit'] = 12;
        if (isset($_POST['filter'])) {
//            print_r($_POST);exit;

            $strPost['attribute'] = (isset($_POST['filter_attribute']) ? implode(',', $this->input->post('filter_attribute')) : '');
            $strPost['rating'] = (isset($_POST['rating']) ? $this->input->post('rating') : '');
            $strPost['max_price'] = (isset($_POST['max_value']) ? $this->input->post('max_value') : '');
            $strPost['min_price'] = (isset($_POST['min_value']) ? $this->input->post('min_value') : '');
//             print_r($strPost);exit;
            $path = 'filterProduct';
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);
        } else {
            $path = 'getCategoryProducts';

            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);
        }
//        echo "<pre>";
//        print_r($returnArr);
//        die;
        $attributes = [];
        $data['header'] = $this->get_header();
        if ($returnArr['error_code'] == 201 || $returnArr['error_code'] == 200) {

            foreach ($returnArr['data']['filterData']['category'] as $filter) {
                if ($filter['id'] == $category_id) {
                    foreach ($filter['sub_category'] as $sub_category) {
                        if ($sub_category['id'] == $sub_category_id) {
                            $attributes = $sub_category['attributes'];
                        }
                    }
                }
            }

            $data['max_price'] = $returnArr['data']['filterData']['max_price'];
            $data['min_price'] = $returnArr['data']['filterData']['min_price'];
            $data['products'] = $returnArr['data'];
            $data['message'] = $returnArr['message'];
        } else {
            $data['products'] = ['products' => array()];
            $data['message'] = $returnArr['message'];
            $data['max_price'] = 0;
            $data['min_price'] = 0;
        }
        $data['attributes'] = $attributes;
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'product_list';
        $this->load->view('layout/template', $data);
    }

     public function subcategory_list() {
        header("Cache-Control: no-cache, must-revalidate");
        $category_id = $this->uri->segment(2);
//        print_r($_POST);
//        exit;
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
        $header=$this->get_header();
        $data['header'] = $header;
        if($header):
        foreach($header['category'] as $category):
            if($category['id'] == $category_id):
                $sub_category=$category['sub_category'];
            endif;
        endforeach;
        else:
            $sub_category=[];
        endif;
        $data['sub_category']=$sub_category;
//        echo '<pre>';print_r($sub_category);exit;
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'subcategory_list';
        $this->load->view('layout/template', $data);
    }

    public function product_detail() {
        $product_id = $this->uri->segment(2);
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
        $strPost['product_id'] = $product_id;

        $path = 'productDetail';

        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        // echo "<pre>";
        // print_r($returnArr);
        // die;
        $data['header'] = $this->get_header();
        if ($returnArr['error_code'] == 200) {
            $data['products'] = $returnArr['data']['productDetail'];
            $data['vendor'] = $returnArr['data']['vendorData'];
            $data['similar_products'] = $returnArr['data']['similar_products'];
            $data['review'] = $returnArr['data']['review'];
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
            $data['view_link'] = 'product_detail';
        } else {
            $data['message'] = 'Product Not Found';
            $data['view_link'] = 'errors/no_data_found';
        }
        $this->load->view('layout/template', $data);
    }

    public function advertisement_list() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
        $path = 'adsList';

        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//        echo "<pre>";
//        print_r($returnArr);
//        die;
        if ($returnArr['error_code'] == 200) {
            $data['header'] = $this->get_header();
            $data['ads_list'] = $returnArr['data'];
            $data['message'] = $returnArr['message'];
        } else {
            $data['ads_list'] = ['ads' => array()];
            $data['message'] = $returnArr['message'];
        }
//                echo "<pre>";
//        print_r($data);
//        die;
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'advertisement_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_list() {


        if ($this->session->userdata('user_logged_in')) {
            $userdata = $this->session->userdata('user_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else if (isset($_COOKIE['souqalasal'])) {

            $strPost['user_id'] = $_COOKIE['souqalasal'];
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }


        $path = 'vendorList';

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        //echo "<pre>"; print_r($returnArr); die;
        $data['myCart'] = $this->myCart();
        if ($returnArr) {
            $data['vendors'] = $returnArr['data'];
            $data['message'] = $returnArr['message'];
        } else {
            $data['vendors'] = [];
            $data['message'] = $returnArr['message'];
        }

        $data['categories'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'vendor_list';
        $this->load->view('layout/template', $data);
    }

    function add_address() {
        // if ($this->session->userdata('user_logged_in')) {

        $strPost = [
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2')
        ];
        $userdata = $this->session->userdata('user_logged_in');
        // }
        $strPost['user_id'] = $userdata['user_id'];

        $headerArr = [
            'lang' => 'en',
            'device_id' => $userdata['device_id'],
            'security_token' => $userdata['security_token']
        ];
        $path = 'addAddress';

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);

        if ($returnArr) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        }
    }

    public function search() {
        header("Cache-Control: no-cache, must-revalidate");
//        $category_id = $this->uri->segment(2);
//        $sub_category_id = $this->uri->segment(3);
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        
        $location = $this->check_if_location();
        if($location){
        $strPost['latitude'] = $location['latitude'];
        $strPost['longitude'] = $location['longitude'];
        $strPost['address'] = $location['address'];
        }else{
            echo "<script>$.removeCookie('pop');</script>";
//            return true;
        }
//        $strPost['category_id'] = $category_id;
//        $strPost['sub_category_id'] = $sub_category_id;

        $strPost['search'] = trim($this->input->post('search'), ' ');
        $path = 'searchProduct';

        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//        echo "<pre>";
//        print_r($returnArr);
//        die;
        $data['header'] = $this->get_header();
        if ($returnArr['error_code'] == 200) {
            $data['products'] = $returnArr['data'];
            $data['message'] = $returnArr['message'];
        } else {
            $data['products'] = ['products' => array()];
            $data['message'] = $returnArr['message'];
        }
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'search_result';
        $this->load->view('layout/template', $data);
    }

    public function clear_cart() {
        if ($this->session->userdata('user_logged_in')) {
            $userdata = $this->session->userdata('user_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '';
            if (isset($_COOKIE['souqalasal'])) {
//                echo 'cookie';
//                print_r($_COOKIE['souqalasal']);
                $strPost['user_id'] = $_COOKIE['souqalasal'];
                $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
            } else {
                $user_id = $this->my_random_string('GUEST' . time());
                setcookie("souqalasal", $user_id, time() + 10 * 24 * 60 * 60);
                $strPost['user_id'] = $user_id;
                $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
            }
        }

        $path = 'clearCart';

        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//echo "<pre>"; print_r($strPost); die;

        if ($returnArr) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        }
    }

    public function filter_product_list() {

        if ($this->session->userdata('user_logged_in')) {
            $userdata = $this->session->userdata('user_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else if (isset($_COOKIE['souqalasal'])) {
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
            $strPost['user_id'] = $_COOKIE['souqalasal'];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
        $strPost['type'] = ($this->input->post('type') ? $this->input->post('type') : '00');
        $strPost['id'] = ($this->input->post('id') ? $this->input->post('id') : '00');
        $strPost['f_type'] = $this->input->post('f_type');
        $strPost['f_id'] = $this->input->post('f_id');
        $path = 'getProductList';
        //print_r($strPost);exit;
        $returnData = $this->Web_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr) {
            $productList = [];
            foreach ($returnArr['data'] as $product) {
                $item = "<li class='item col-lg-4 col-md-4 col-sm-6 col-xs-6'>" .
                        "<div class='col-item'>";
                if ($product['quantity'] == '0'):
                    $item .= " <div class='stock-label sale-top-right'>Out Of Stock</div>";
                endif;
                $item .= " <div class='product-image-area'> <a class='product-image' title=" . $product['name'] . " href=" . base_url('product-detail/' . $product['product_id']) . "> <img src=" . $product['images'][0]['file_path'] . $product['images'][0]['file_name'] . " style='height: 262px;' class='img-responsive' alt='a' /> </a>" .
                        "<div class='hover_fly'>" . "<a class='addToWishlist wishlistProd_5' style='cursor:pointer;'";
                if ($this->session->userdata('user_logged_in')) :
                    $item .= "onclick='addtowishlist(" . $product['product_id'] . ");'";
                else :
                    $item .= " onclick='checkout();'";
                endif;
                $item .= ">";

                $item .= "<div><i class='icon-heart'></i><span>" . ( $product['is_fav'] ? 'Remove From Wishlist' : 'Add to Wishlist') . "</span></div>" .
                        "</a> " .
                        "</div>" .
                        "</div>" .
                        "<div class='info'>" .
                        "<div class='info-inner'>" .
                        "<div class='item-title'> <a title='" . $product['name'] . "' href='" . base_url('product-detail') . "'>" . $product['name'] . "</a> </div>" .
                        "<div class='item-content'>" . "<div class='price-box'>";
                $item .= "<p class='special-price'> <span class='price'> " . ( $product['discount_price'] ? '$' . $product['discount_price'] : '$' . $product['price']) . " </span> </p>
                         <p class='old-price'> <span class='price-sep'>-</span> <span class='price'> " . ($product['discount'] ? '$' . $product['price'] : '' ) . "</span> </p>"
                        . "</div>"
                        . "<div class='actions'>";
                if ($product['cart_quentity']):
                    $item .= "<div class='pull-left'><div class='custom pull-left'><button onclick='addtocart(" . $product['product_id'] . ",2);' class='reduced items-count' type='button'><i class='fa fa-minus'>&nbsp;</i></button>";
                    $item .= "<input type='text' style='width:30%;text-align: center;' disabled='' class='input-text qty' title='Qty' value='" . $product['cart_quentity'] . "' maxlength='12' id='qty' name='qty'>";
                    $item .= "<button onclick='addtocart(" . $product['product_id'] . ",1);' class='increase items-count' type='button' " . ($product['quantity'] ? '' : "disabled style='cursor:not-allowed'" ) . "><i class='fa fa-plus'>&nbsp;</i></button></div></div>";
                else:

                    $item .= "<button ";
                    if ($product['quantity'] == '0'):
                        $item .= "disabled style='cursor:not-allowed;'";
                    endif;
                    $item .= "type='button' onclick='addtocart(" . $product['product_id'] . ", 1);' title='Add to Cart' class='button btn-cart'><span>Add to Cart</span></button> ";

                endif;
                $item .= "</div> 
                                                </div>
                                                
                                            </div>" .
                        "<div class='clearfix'> </div>
                                        </div>
                                    </div>
                                </li>";

                array_push($productList, $item);
            }
            //print_r($productList);exit;
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $productList];
            echo json_encode($res);
            die;
        }else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => array()];
            echo json_encode($res);
            die;
        }
    }

    public function about_us() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

//        $data['myCart'] = $this->myCart();

        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'about_us';
        $this->load->view('layout/template', $data);
    }

    public function term_condition() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

//        $data['myCart'] = $this->myCart();

        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'term_and_condition';
        $this->load->view('layout/template', $data);
    }

    public function privacy_policy() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

//        $data['myCart'] = $this->myCart();

        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'privacy_policy';
        $this->load->view('layout/template', $data);
    }

    public function delivery_information() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

//        $data['myCart'] = $this->myCart();

        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'delivery_information';
        $this->load->view('layout/template', $data);
    }
    
    public function disclaimer() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'disclaimer';
        $this->load->view('layout/template', $data);
    }
     public function company_profile() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'company_profile';
        $this->load->view('layout/template', $data);
    }
     public function cookie_policy() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'cookie_policy';
        $this->load->view('layout/template', $data);
    }
     public function acceptable_use_policy() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } {
            $strPost['user_id'] = '00';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }
//        $data['myCart'] = $this->myCart();
        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'use_policy';
        $this->load->view('layout/template', $data);
    }

    public function faq() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }

//        $data['myCart'] = $this->myCart();

        $data['header'] = $this->get_header();
//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;
        $data['view_link'] = 'faq';
        $this->load->view('layout/template', $data);
    }

    public function contact_us() {
        if ($this->session->userdata('customer_logged_in')) {
            $userdata = $this->session->userdata('customer_logged_in');
            $strPost['user_id'] = $userdata['user_id'];
            $headerArr = [
                'lang' => 'en',
                'device_id' => $userdata['device_id'],
                'security_token' => $userdata['security_token']
            ];
        } else {
            $strPost['user_id'] = '';
            $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        }


//        echo "<pre>";print_r($data['header']['0']['sub_category']);die;

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'numeric|min_length[6]|max_length[15]');

        if ($this->form_validation->run() == False) {
//            $data['myCart'] = $this->myCart();

            $data['header'] = $this->get_header();
            $data['view_link'] = 'contact_us';
            $this->load->view('layout/template', $data);
        } else {
            $strPost = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'comment' => $this->input->post('comment'),
                'mobile' => $this->input->post('mobile')
            ];
            $path = 'contactUs';

            $returnData = $this->Web_model->apiCall($path, $strPost);
            $return = json_decode($returnData, true);
            if ($return) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $return['message'] . '</div>');
                redirect('contact-us');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found</div>');
                redirect('contact-us');
            }
        }
    }

    public function get_header() {
        $headerArr = ['lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $customer = $this->session->userdata('customer_logged_in');
        if ($customer) {
            $strPost['user_id'] = $customer['user_id'];
            $headerArr = ['lang' => 'en', 'device_id' => $customer['device_id'], 'security_token' => $customer['security_token']];
        } else {
            $strPost['user_id'] = '00';
        }
        $path = 'getCategory';

        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
        $header = $returnArr['data'];
        return $header;
    }

    public function upload_img($img_name, $uploadPath) {
//print_r($_FILES[$img_name]);exit;
        if (!empty($_FILES[$img_name]['name'])) {

            $file_ext = explode('.', $_FILES[$img_name]['name']);
            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {

                $result = base_url() . $uploadPath . $uploadFile;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }

    function upload_file($img_name, $uploadPath) {

//print_r($image);exit;
        if (!empty($_FILES[$img_name]['name'])) {
            $file_ext = explode('.', $_FILES[$img_name]['name']);

            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {
                $insertArr = [
                    'file_path' => base_url() . $uploadPath,
                    'file_name' => $uploadFile,
                    'file_type' => $file_ext[1],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $returnId = $this->Admin_model->addFile($insertArr);
            } else {
                $returnId = 0;
            }
        } else {
            $returnId = 0;
        }
        return $returnId;
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

    function send_mail($to, $title, $subject, $data) {
        //print_r($data); exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "ashutosh@gropse.com";
        $config['smtp_pass'] = "ashutosh@123";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        // Sender email address
        $this->email->from("ashutosh@gropse.com", $title);
        // Receiver email address
        $this->email->to($to);
        // Subject of email
        $this->email->subject($subject);
        $body = $this->load->view('email.php', $data, TRUE);
        // Message in email
        $this->email->message($body);
        $result = $this->email->send();
        if ($result) {
            return true;
            // print_r('success'); exit;
        } else {
            return false;
            // show_error($this->email->print_debugger()); 
            // print_r('fail'); exit;
        }
    }

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

    public function logout() {
        $this->session->unset_userdata('customer_logged_in');
        redirect('login');
    }

}

?>
    
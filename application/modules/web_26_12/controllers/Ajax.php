<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
    }

    public function verify_otp() {
        $email_mobile = $this->session->userdata('verify_email');
        $type = $this->input->post('type');
        $strPost['email'] = $email_mobile;
        $strPost['otp'] = $this->input->post('otp');
        $strPost['device_type'] = 3;
        $strPost['device_id'] = uniqid();
        $strPost['device_token'] = uniqid('token_');
        $path = 'verifyOtp';
//        print_r($strPost);exit;
        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
//print_r($returnArr);exit;
        if ($returnArr['error_code'] == 200) {
            $this->session->unset_userdata('verify_email');
            if ($type == 1) {
                $this->update_location();
                $this->session->set_userdata('customer_logged_in', $returnArr['data']);
                $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            } else {
                $this->session->set_userdata('user_verification', $returnArr['data']);
                $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            }

            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function login() {
        $strPost['email'] = $this->input->post('email');
        $strPost['password'] = $this->input->post('password');
        $strPost['device_type'] = 3;
        $strPost['device_id'] = uniqid();
        $strPost['device_token'] = uniqid('token_');
        $path = 'userLogin';

        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        $email = $strPost['email'];
        if ($returnArr['error_code'] == 203) {
            $this->session->set_userdata('verify_email', $email);
            //echo 'get:';
//            setcookie("africansupermarket", $email, time() + 10 * 24 * 60 * 60);
//            print_r($_COOKIE);
//            echo $email=get_cookie('africansupermarket');
//           exit;
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'type' => 1, 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else if ($returnArr['error_code'] == 200) {
            $this->session->set_userdata('customer_logged_in', $returnArr['data']);
            $this->update_location();
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function update_location() {
        $user = $this->session->userdata('customer_logged_in');
        // print_r($user);exit;
        if ($user) {
            $headerArr = ['lang' => 'en', 'device_id' => $user['device_id'], 'security_token' => $user['security_token']];
            $strPost['user_id'] = $user['user_id'];
            $path = 'getProfile';
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);
//            print_r($returnArr);
            if ($returnArr) {
                $strPost['name'] = $returnArr['data']['name'];
                $strPost['mobile'] = $returnArr['data']['mobile'];
                if ($returnArr['data']['address'] == "") {
                    if ($this->session->userdata('user_location')) {
                        $user_location = $this->session->userdata('user_location');
                        $strPost['address'] = $user_location['address'];
                        $strPost['lat'] = $user_location['latitude'];
                        $strPost['lng'] = $user_location['longitude'];
                        $returnData_location = $this->Api_model->apiCallHeader('editProfile', $headerArr, $strPost);
                        $returnArr_location = json_decode($returnData_location, true);
                        if ($returnArr_location['error_code'] == 200) {
                            $session_arr = $returnArr_location['data'];
                            $session_arr['user_id'] = $user['device_id'];
                            $session_arr['device_id'] = $user['device_id'];
                            $session_arr['security_token'] = $user['security_token'];
                            $this->session->set_userdata('customer_logged_in', $session_arr);
                            return true;
                        } else {
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return true;
                }

//        print_r($strPost);
//        exit;
            } else {
                return false;
            }
        } else {
            $this->session->set_userdata('user_location', ['address' => $this->input->post('address'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude')]);
            //setcookie("african_super_market", json_encode(['address' => $this->input->post('address'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude')]), time() + 10 * 24 * 60 * 60);
            return true;
        }
    }

    public function register() {
        $strPost['name'] = ucwords($this->input->post('name'));
        $strPost['email'] = $this->input->post('email');
        $strPost['password'] = $this->input->post('password');
        $strPost['mobile'] = $this->input->post('mobile');

        $path = 'userRegister';

        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        $email = $strPost['email'];
        if ($returnArr['error_code'] == 200) {
            $this->session->set_userdata('verify_email', $email);
//            setcookie("africansupermarket", $email, time() + 10 * 24 * 60 * 60);
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'type' => 1, 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function forgotPassword() {
        $strPost['email'] = $this->input->post('email');
        $path = 'createOtp';
        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        $email = $strPost['email'];
        if ($returnArr['error_code'] == 200) {
            $this->session->set_userdata('verify_email', $email);
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'type' => 2, 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function reset_password() {
        $user = $this->session->userdata('user_verification');
        $strPost['user_id'] = $user['user_id'];
        $strPost['password'] = $this->input->post('password');
        $path = 'resetPassword';
        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr['error_code'] == 200) {
            $this->session->set_userdata('customer_logged_in', $user);
            $this->update_location();
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], $returnArr['data']];
            echo json_encode($res);
            die;
        }
    }

    public function check_password() {
        $user = $this->session->userdata('customer_logged_in');
        $strPost['user_id'] = $user['user_id'];
        $strPost['password'] = $this->input->post('data');
        $path = 'checkPassword';
        $returnData = $this->Api_model->apiCall($path, $strPost);
        $returnArr = json_decode($returnData, true);
        if ($returnArr['error_code'] == 200) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], $returnArr['data']];
            echo json_encode($res);
            die;
        }
    }

    public function edit_profile() {
        $user = $this->session->userdata('customer_logged_in');
        if ($user) {
            $strPost['user_id'] = $user['user_id'];
        } else {
            $strPost['user_id'] = '';
        }
        if (isset($_FILES['profile_image'])) {
            $uploadPath = 'uploads/userImages/';
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
//        print_r($strPost);
//        exit;
        $headerArr = ['lang' => 'en', 'device_id' => $user['device_id'], 'security_token' => $user['security_token']];
        $returnData = $this->Api_model->apiCallHeader('editProfile', $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);

        if ($returnArr['error_code'] == 200) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['data']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function changePassword() {
        $user = $this->session->userdata('customer_logged_in');
        if ($user) {
            $strPost['user_id'] = $user['user_id'];
        } else {
            $strPost['user_id'] = '';
        }
        $strPost['password'] = $this->input->post('password');
        $headerArr = ['lang' => 'en', 'device_id' => $user['device_id'], 'security_token' => $user['security_token']];
        $returnData = $this->Api_model->apiCallHeader('resetPassword', $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//print_r($returnArr);exit;
        if ($returnArr['error_code'] == 200) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message']];
            echo json_encode($res);
            die;
        }
    }

    public function addToFavourite() {
        $user = $this->session->userdata('customer_logged_in');
        if ($user) {
            $strPost['user_id'] = $user['user_id'];
        } else {
            $strPost['user_id'] = '00';
        }
        $strPost['product_id'] = $this->input->post('product');
        $headerArr = ['lang' => 'en', 'device_id' => $user['device_id'], 'security_token' => $user['security_token']];
        $returnData = $this->Api_model->apiCallHeader('addToFavourite', $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//print_r($returnArr);exit;
        if ($returnArr['error_code'] == 200) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message']];
            echo json_encode($res);
            die;
        }
    }

    public function save_location() {
        $user = $this->session->userdata('customer_logged_in');
        //print_r($user);exit;
        if ($user) {
            $headerArr = ['lang' => 'en', 'device_id' => $user['device_id'], 'security_token' => $user['security_token']];
            $strPost['user_id'] = $user['user_id'];
            $path = 'getProfile';
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnArr = json_decode($returnData, true);
            //print_r($returnArr);
            if ($returnArr) {
                $strPost['name'] = $returnArr['data']['name'];
                $strPost['mobile'] = $returnArr['data']['mobile'];
                $strPost['address'] = $this->input->post('address');
                $strPost['lat'] = $this->input->post('latitude');
                $strPost['lng'] = $this->input->post('longitude');
//        print_r($strPost);
//        exit;

                $returnData_location = $this->Api_model->apiCallHeader('editProfile', $headerArr, $strPost);
                $returnArr_location = json_decode($returnData_location, true);
                if ($returnArr_location['error_code'] == 200) {
                    $session_arr = $returnArr_location['data'];
                    $session_arr['user_id'] = $user['device_id'];
                    $session_arr['device_id'] = $user['device_id'];
                    $session_arr['security_token'] = $user['security_token'];
                    $this->session->set_userdata('customer_logged_in', $session_arr);
                    $res = ['status' => '1', 'error_code' => $returnArr_location['error_code'], 'message' => $returnArr_location['message'], 'data' => $returnArr_location['data']];
                    echo json_encode($res);
                    die;
                } else {
                    $res = ['status' => '0', 'error_code' => $returnArr_location['error_code'], 'message' => $returnArr_location['message'], 'data' => []];
                    echo json_encode($res);
                    die;
                }
            } else {
                $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
                echo json_encode($res);
                die;
            }
        } else {
            $this->session->set_userdata('user_location', ['address' => $this->input->post('address'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude')]);
            //setcookie("african_super_market", json_encode(['address' => $this->input->post('address'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude')]), time() + 10 * 24 * 60 * 60);
            $res = ['status' => '1', 'error_code' => 200, 'message' => 'Location saved over cookie', 'data' => ['address' => $this->input->post('address'), 'latitude' => $this->input->post('latitude'), 'longitude' => $this->input->post('longitude')]];
            echo json_encode($res);
            die;
        }
    }

    function check() {
        $check = $this->Rtc_model->getRowData(['email' => $this->input->post('email')], 'user');
        if ($check) {
            $error = false;
            $code = 103;
            $msg = 'Email Already Registered';
            $data = array();
        } else {
            $error = false;
            $code = 100;
            $msg = 'Email Available';
            $data = array();
        }
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
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

}
?>


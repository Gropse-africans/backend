<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Vendor_model');
    }

    public function verify_otp() {
        $emailData = $this->session->userdata('email');
        //alert($emailData);
        $insertArr['email'] = $emailData;
        $insertArr['otp'] = $this->input->post('otp');
        $check = $this->Vendor_model->getRowData(['email' => $emailData], 'vendor');
         //print_r($check);exit;
        if ($check) {
            if ($check['otp'] == $this->input->post('otp')) {
                unset($check['otp']);
                //unset($check['password']);
                $this->session->set_userdata('vendor_registration', $check);
                $this->session->unset_userdata('email');
                $this->Vendor_model->updateData(['id' => $check['id']], 'vendor', ['status' => 0]);

                $error = false;
                $code = 100;
                $msg = 'Otp Verified';
                $data = array();
            } else {
                $error = true;
                $code = 101;
                $msg = 'Invalid Otp';
                $data = array();
            }
        } else {
            $error = true;
            $code = 102;
            $msg = 'Email not registered';
            $data = array();
        }
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
    }

    public function login() {
        $check = $this->Vendor_model->getRowData(['email' => $this->input->post('email')], 'user');
        if ($check) {
            if ($check['password'] == md5($this->input->post('password'))) {
                if ($check['status'] == 0) {
                    $this->session->set_userdata('email', $this->input->post('email'));
                    $res = ['status' => '0', 'error_code' => '99', 'message' => 'Verify User Account', 'data' => ['otp' => $check['otp']]];
                    echo json_encode($res);
                    die;
                } else if ($check['status'] == 2) {
                    $res = ['status' => '0', 'error_code' => '103', 'message' => 'User account blocked. Please contact admin.', 'data' => new stdClass()];
                    echo json_encode($res);
                    die;
                } else {
                    unset($check['password']);
                    unset($check['otp']);
                    $this->session->set_userdata('user_logged_in', $check);
                    $this->session->unset_userdata('email');
                    $res = ['status' => '1', 'error_code' => '100', 'message' => 'Login Successful', 'data' => $check];
                    echo json_encode($res);
                    die;
                }
            } else {
                $res = ['status' => '0', 'error_code' => '101', 'message' => 'Invalid Password', 'data' => new stdClass()];
                echo json_encode($res);
                die;
            }
        } else {
            $res = ['status' => '0', 'error_code' => '102', 'message' => 'Email not registered', 'data' => new stdClass()];
            echo json_encode($res);
            die;
        }
    }

    public function forgotPassword() {
        if ($this->input->post('email')) {
            $check = $this->Vendor_model->getRowData(['email' => $this->input->post('email')], 'vendor');
            if ($check) {
                $strPost['otp'] = rand(1000, 9999);
                $this->Vendor_model->updatedataTable('vendor',['id' => $check['id']], $strPost);
                $this->session->set_userdata('email', $this->input->post('email'));
                $this->session->set_flashdata('response1', 1);
                $this->send_mail($this->input->post('email'), 'Vendor Registration Successful', 'Verify Your Account.', ['otp' => $strPost['otp']]);
                $res = ['status' => '1', 'error_code' => 100, 'message' => 'Otp sent at registered mail', 'data' => $strPost];
                echo json_encode($res);
                die;
            } else {
                $res = ['status' => '0', 'error_code' => 102, 'message' => 'Email not registered', 'data' => new stdClass()];
                echo json_encode($res);
                die;
            }
        } else {
            $res = ['status' => '0', 'error_code' => 101, 'message' => 'Email field is required', 'data' => new stdClass()];
            echo json_encode($res);
            die;
        }
    }

    public function updateProfile() {
        $user = $this->session->userdata('user_logged_in');
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

                    $strPost['profile_image'] = base_url() . $uploadPath . $uploadFile;
                }
            }
        }
        $strPost['full_name'] = $this->input->post('full_name');
        $strPost['mobile'] = $this->input->post('mobile');
        $strPost['profile_image'] = $this->input->post('profile_image');
        $headerArr = ['device_id' => $user['device_id'], 'security_token' => $user['security_token']];
        $returnData = $this->User_model->apiCallHeader('updateUserProfile', $headerArr, $strPost);
        $returnArr = json_decode($returnData, true);
//print_r($returnArr);exit;
        if ($returnArr['error_code'] == 200) {
            $res = ['status' => '1', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => $returnArr['result']['otp']];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => $returnArr['error_code'], 'message' => $returnArr['message'], 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function changePassword() {
        $user = $this->session->userdata('user_logged_in');
        if ($user) {
            $strPost['user_id'] = $user['user_id'];
        } else {
            $strPost['user_id'] = '';
        }
        $strPost['oldPassword'] = $this->input->post('old_password');
        $strPost['newPassword'] = $this->input->post('password');
        $headerArr = ['device_id' => $user['device_id'], 'security_token' => $user['security_token']];
        $returnData = $this->User_model->apiCallHeader('changePassword', $headerArr, $strPost);
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


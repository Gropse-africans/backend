
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Vendor_model'));
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('session');
        // if ($this->session->userdata('admin_logged_in')) {
        //     redirect('admin/dashboard');
        // }
    }

    public function index() {


        $this->form_validation->set_error_delimiters('<p style="color:#a94442;">', '</p>');
        $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['view_link'] = 'vendors/index';
            $this->load->view('layout/template',$data);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $result = $this->Vendor_model->vendor_login($email, $password);
            // print_r($result);exit;
            if ($result) {
                if ($result['status'] == '1') {
                    $sessionArr = ['vendor_id' => $result['id'], 'email' => $result['email']];
                    $this->session->set_userdata('vendor_logged_in', $sessionArr);
                    redirect('vendor/dashboard');
                } else if ($result['status'] == '0') {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This account is not verified by admin.</div>');

                    redirect('vendor');
                } else if ($result['status'] == '2') {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This account is blocked by admin.Please contact admin.</div>');

                    redirect('vendor');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This account is permanently deactivated by admin. Please contact admin.</div>');

                    redirect('vendor');
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email or password is incorrect</div>');

                redirect('vendor');
            }
        }
    }

    public function register() {
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email address', 'required|valid_email|is_unique[vendor.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        // $this->form_validation->set_rules('password2', 'Confirm Password', 'required');  
        // $this->form_validation->set_rules('mobile', 'Mobile Number', 'numeric');
        $this->form_validation->set_rules('latitude', 'Address', 'required');
        //$this->form_validation->set_rules('vendor_image', 'Image', 'required');
        if ($this->form_validation->run() == False) {

            $data['view_link'] = 'register';
            $this->load->view('layout/template',$data);
        } else {
            // print_r($_FILES);exit;
            $path = "uploads/vendor/";
            $file_tmp = $_FILES['file_upload']['tmp_name'];
            $file_ext = explode('.', $_FILES['file_upload']['name']);
            $file_name = $file_ext[0] . time() . '.' . $file_ext[1];
            if (move_uploaded_file($file_tmp, $path . $file_name)) {
                $personal_photo = base_url() . $path . $file_name;
            } else {
                $personal_photo = '';
            }
            $insertArr = [
                // 'otp' => rand(1000, 9999),
                'name' => $this->input->post('name'),
                'email' => trim($this->input->post('email'), ' '),
                'password' => md5(trim($this->input->post('password'), ' ')),
                'mobile' => $this->input->post('mobile'),
                'image' => $personal_photo,
                'address' => $this->input->post('address'),
                'lat' => $this->input->post('latitude'),
                'lng' => $this->input->post('longitude'),
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            // print_r($insertArr);exit;
            $returnData = $this->Vendor_model->addData('vendor', $insertArr);
            if ($returnData) {
                // $this->send_mail($insertArr['email'], 'African Super Market Registration Successful', 'Please Verify Your Account for the Registration.', ['otp' => $insertArr['otp']]);
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Vendor Registered Successfully wait for admin approval</div>');
                // $this->session->set_userdata('email', $this->input->post('email'));
                redirect('vendor/register');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured</div>');
                redirect('vendor/register');
            }
        }
        //print_r($insertArr);exit;
    }

    public function forgot_password() {
            $data['view_link'] = 'forgot_password';
            $this->load->view('layout/template',$data);
        
    }

    public function sendotp() {
        $email = $this->input->post('email');
        $vendor = $this->Vendor_model->getRowData(['email' => $email], 'vendor');
        if ($vendor) {
            if ($vendor['status'] == '1') {
                $otp = rand(1000, 9999);
                $this->send_mail($email, 'Africans Supermarket', 'One Time Password', ['otp' => $otp]);
                $query = $this->Vendor_model->updateData(['email' => $email], 'vendor', ['otp' => $otp]);
                if ($query) {
                    $error = false;
                    $code = 100;
                    $msg = 'Otp sent at your registered email';
                    $data = array('data' => $otp);
                } else {
                    $error = true;
                    $code = 105;
                    $msg = 'Some Error Occured. Please try again';
                    $data = array();
                }
            } else if ($vendor['status'] == '0') {
                $error = true;
                $code = 102;
                $msg = 'This account is not verified by admin';
                $data = array();
            } else if ($vendor['status'] == '2') {
                $error = true;
                $code = 103;
                $msg = 'This account is blocked by admin';
                $data = array();
            } else {
                $error = true;
                $code = 104;
                $msg = 'This account is permanently blocked by admin';
                $data = array();
            }
        } else {
            $error = true;
            $code = 101;
            $msg = 'This email is not registered';
            $data = array();
        }
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
    }

    public function verify() {
        $email = $this->input->post('email');
        $otp = $this->input->post('otp');
        $vendor = $this->Vendor_model->getRowData(['email' => $email], 'vendor');
        if ($vendor) {
            if ($vendor['status'] == '1') {
                $query = $this->Vendor_model->getRowData(['email' => $email, 'otp' => $otp], 'vendor');
                if ($query) {
                    $error = false;
                    $code = 100;
                    $msg = 'Email Verified Successfully';
                    $data = array('user' => $vendor['id']);
                } else {
                    $error = true;
                    $code = 105;
                    $msg = 'Invalid Otp';
                    $data = array();
                }
            } else if ($vendor['status'] == '0') {
                $error = true;
                $code = 102;
                $msg = 'This account is not verified by admin';
                $data = array();
            } else if ($vendor['status'] == '2') {
                $error = true;
                $code = 103;
                $msg = 'This account is blocked by admin';
                $data = array();
            } else {
                $error = true;
                $code = 104;
                $msg = 'This account is permanently blocked by admin';
                $data = array();
            }
        } else {
            $error = true;
            $code = 101;
            $msg = 'This email is not registered';
            $data = array();
        }
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
    }

    public function reset_password() {
        $vendor = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('password', 'Name', 'required');
        if ($this->form_validation->run() == False) {
            $data['view_link'] = 'reset_password';
            $this->load->view('layout/template',$data);
        } else {
//            print_r($_POST);
//            exit;
            $insertArr = ['password' => md5($this->input->post('password'))];
            $returnData = $this->Vendor_model->updateData(['id' => $vendor], 'vendor', $insertArr);
            if ($returnData) {
                $return = $this->Vendor_model->getRowData(['id' => $vendor, 'password' => md5($this->input->post('password'))], 'vendor');
                $this->session->set_flashdata('response', '<div class="alert alert-primary"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Reset Successful.</div>');
                $sessionArr = ['vendor_id' => $return['id'], 'email' => $return['email']];
                $this->session->set_userdata('vendor_logged_in', $sessionArr);
                redirect('vendor/dashboard');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured. Please try again.</div>');
                redirect('vendor/reset-password');
            }
        }
    }

    function send_mail($to, $title, $subject, $data) {
        //print_r($data); exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "archana.gropse@gmail.com";
        $config['smtp_pass'] = "gropse@7117";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";
        $config['wordwrap'] = TRUE;

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

    public function logout() {
        $query = $this->session->unset_userdata('vendor_logged_in');
//            $error      = false;
//            $code       = 100;
//            $msg        = 'logout Successfully.';
//            $data       = array();
//        echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
        redirect(base_url() . 'vendor');
    }

}
?>



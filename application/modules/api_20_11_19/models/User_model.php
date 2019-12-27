<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->helper('push_helper');
        date_default_timezone_set('Asia/Kolkata');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////CHECK USER AUTH////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function check_requiredField($obj, $required) {
        $dataError['status'] = false;
        foreach ($required as $field) {
            if (empty($obj[$field])) {
                $dataError['status'] = true;
                $dataError['field'] = $field;
                break;
            }
        }
        return $dataError;
    }

    function is_valid_header($param) {
        $num = $this->db->select("id")
                        ->where("device_id", $param['device_id'])
                        ->where("security_token", $param['security_token'])
                        ->get("user_auth")->num_rows();
        if ($num > 0) {
            return true;
        } elsE {
            return false;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////CHECK USER AUTH////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////PUSH NOTIFICATION////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function sendIosPush($deviceToken, $msg_data) {
        $deviceToken = $deviceToken; //  iPad 5s Gold prod
        ///$deviceToken = ''; //  iPad 5s Gold prod
        $passphrase = '12345';

        $msg = $msg_data;
        $message = $msg;
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns_cert/developement_ck.pem'); // Pem file to generated // openssl pkcs12 -in pushcert.p12 -out pushcert.pem -nodes -clcerts // .p12 private key generated from Apple Developer Account
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        //$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // production
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx); // developement
        //echo "<p>Connection Open</p>";
        if (!$fp) {
            //echo "<p>Failed to connect!<br />Error Number: " . $err . " <br />Code: " . $errstrn . "</p>";
            return;
        } else {
            //echo "<p>Sending notification!</p>";
        }
        $body['aps'] = array('alert' => array('title' => $msg_data['title'], 'body' => $msg_data['body']), 'sound' => 'default', 'extra1' => '10', 'extra2' => 'value');
        $body['data'] = array('type' => $message['type'], 'data' => $message);
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //var_dump($msg)
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
        // echo '<p>Message not delivered ' . PHP_EOL . '!</p>';
            $res = false;
        else
        // echo '<p>Message successfully delivered ' . PHP_EOL . '!</p>';
            $res = true;
        fclose($fp);
        return $res;
    }

    // Push for Pharmacies Device
    function sendAndroidPush($deviceToken, $msg) {
        $registrationIDs = $deviceToken;
        $message = $msg;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' => $registrationIDs,
            'data' => array("msg" => $message)
        );
        $headers = array(
            "Authorization: key=AIzaSyDZLuLy5Db84cw0dqJ-5cOvvRZuYPdDIQw",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function sendMailTamplet($to,$title,$subject,$type,$data) {
        //print_r($data);exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "ashutosh@gropse.com";
        $config['smtp_pass'] = "ashutosh@123";
	$config['mailtype'] = "html";
        $config['charset'] = "iso-8859-1";
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
 
        // Sender email address
        $this->email->from("ashutosh@gropse.com", $title);
        // Receiver email address
        $this->email->to($to);
        // Subject of email
        $this->email->subject($subject);
		
        if($type=="welcome"){
            $data = array(
                'data'=>''
            );
            $body = $this->load->view('email/welcome.php',$data,TRUE);
        }
        else if($type=="register"){
            //print_r($data);exit;
            $body = $this->load->view('email/register.php',$data,TRUE);
        }else if($type=="forgot"){
            $body = $this->load->view('email/forgot.php',$data,TRUE);
        }else if($type=="cod"){
            $data = array(
                'order_id'	=>$data['order_id'],
                'amount'	=>$data['amount'],
                'items'		=>$data['items']
            );
            $body = $this->load->view('UserView/email/cod.php',$data,TRUE);
        }else{
            $data = array(
                'data'=>''
            );
            $body = $this->load->view('email/welcome.php',$data,TRUE);
        }
		
        // Message in email
        $this->email->message($body); 
        $this->email->send();
        return true;
    }
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////PUSH NOTIFICATION////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
    
    
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////USER MODULE////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
    function sendSMS($numbers, $msg, $otp) {
        $mobileNumber = $numbers;
        $message = $msg;
        $urls = "https://control.msg91.com/api/sendotp.php?authkey=186459AqGo87k1E5a2287d0&mobile=" . $mobileNumber . "&message=" . $message . "&sender=EVTOTP&otp=" . $otp . "";
        $data = file_get_contents($urls);
        $dataJson = json_decode($data, true);
    }
    
    function userRegister($x) {
        $insertData=$this->insertDataTable('users',$x);	
        $insert_id = $this->db->insert_id();	
        if($insertData){
            $sendMail       = array('otp'=>$x['otp']);
            $to             = $x['email'];
            $m              = $this->sendMailTamplet($to,'AfricanSuperMarket', 'AfricanSuperMarket Verification','register', $sendMail);
            return true;
        }else{
            return false;
        }
    }
    function userLogin($x) {
        $this->db->where('email', $x['email']);
        $user = $this->db->get("users")->row_array();
        if(($user['status'])==1) {
            return array('status'=>true,'type'=>100);
        } else if(($user['status'])==2) { 
            return array('status'=>false,'type'=>101);
        }else if(($user['status'])==99) { 
            return array('status'=>false,'type'=>102);
        }else{
            $update = $this->db->query("update af_users set otp = '".$x['otp']."' where email= '" . $x['email'] . "' ");
            if($update){
                $sendMail       = array('otp'=>$x['otp']);
                $to             = $x['email'];
                $m              = $this->sendMailTamplet($to,'AfricanSuperMarket', 'AfricanSuperMarket Verification','register', $sendMail);
                return array('status'=>false,'type'=>103);
            }else{
                return array('status'=>false,'type'=>104);
            }
        }
    }

    function check_email($x) {
        $tlbName = "users";
        $this->db->where('email', $x['email']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = $query;
        } else {
            $data = false;
        }
        return $data;
    }

    function createOtp($x){
        $update = $this->db->query("update af_users set otp = '".$x['otp']."' where email= '" . $x['email'] . "' ");
        if($update){
            $sendMail       = array('otp'=>$x['otp']);
            $to             = $x['email'];
            $m              = $this->sendMailTamplet($to,'AfricanSuperMarket', 'AfricanSuperMarket Verification','register', $sendMail);
            return true;
        }else{
            return false;
        }
    }

    function changePassword($x){
        //print_r($x);exit;
        $userId=$x['user_id'];unset($x['user_id']);
        $this->db->where('id', $userId);
        $result = $this->db->update('users', $x);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function check_email_type($x) {
        $tlbName = "users";
        $this->db->where('email', $x['email']);
        $this->db->where('user_type', $x['user_type']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = true;
        } else {
            $data = false;
        }
        return $data;
    }

    function check_mobile($x) {
        $tlbName = "users";
        $this->db->where('mobile', $x['mobile']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = true;
        } else {
            $data = false;
        }
        return $data;
    }
	

    
    function check_OTP($x) {
	$this->db->where('email', $x['email']);
        $this->db->where('otp', $x['otp']);
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $update = $this->db->query("update af_users set status = '1' where id= '" . $results['id'] . "' ");
            if ($update) {
                $x['user_id'] = $results['id'];
                return $UserData = $this->getDataAfterLogin($x);
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    function check_OTP_Vendor($x) {
	    $this->db->where('email', $x['email']);
        $this->db->where('otp', $x['otp']);
        $this->db->where('user_type', $x['user_type']);
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $update = $this->db->query("update sq_users set status = '1' where id= '" . $results['id'] . "' ");
            if ($update) {
                $x['user_id'] = $results['id'];
                return $UserData = $this->getDataAfterLoginVendor($x);
            }else{
                return false;
            }
        } else {
            return false;
        }
    }


    function checkPassword($x) {
	$this->db->where('email', $x['email']);
        $this->db->where('password', $x['password']);
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $x['user_id'] = $results['id'];
            return $UserData = $this->getDataAfterLogin($x);
        } else {
            return false;
        }
    }
    
    function getDataAfterLogin($doc) {
        $data = array(
            "id" => null,
            "user_id" => $doc['user_id'],
            "device_type" => $doc['device_type'],
            "device_id" => $doc['device_id'],
            "device_token" => $doc['device_token'],
            "security_token" => $this->my_random_string($doc['device_id']),
            "created_at" => strtotime(date("Y-m-d H:i:s"))
        );
        $this->db->where("user_id", $doc['user_id'])
			->delete("user_auth");

        //Insert Token
        $this->db->insert("user_auth", $data);
        //Update Token in User Table
        $newData = $this->db->select("user_id,security_token,device_id")
                ->where("user_id", $data['user_id'])
                ->where("device_id", $data['device_id'])
                ->get("user_auth ")->row_array();
                    
                    $this->db->select('id as user_id,name,email,image,mobile,address,lat,lng,status,created_at');
                    $this->db->where('id', $data['user_id']);
        $getUserData = $this->db->get("users")->row_array();
        $getUserData['device_id']=$newData['device_id'];
        $getUserData['security_token']=$newData['security_token'];
        return $getUserData;
    }

    function getDataAfterLoginVendor($doc) {
        $data = array(
            "id" => null,
            "user_id" => $doc['user_id'],
            "user_type" => $doc['user_type'],
            "device_type" => $doc['device_type'],
            "device_id" => $doc['device_id'],
            "device_token" => $doc['device_token'],
            "security_token" => $this->my_random_string($doc['device_id']),
            "created_at" => strtotime(date("Y-m-d H:i:s"))
        );
        $this->db->where("user_id", $doc['user_id'])
			->delete("user_auth");

        //Insert Token
        $this->db->insert("user_auth", $data);
        //Update Token in User Table
        $newData = $this->db->select("user_id,security_token,device_id")
                ->where("user_id", $data['user_id'])
                ->where("device_id", $data['device_id'])
                ->where("user_type", $data['user_type'])
                ->get("user_auth ")->row_array();
                    
       $getUserData = $this->db->select("users.id as vendor_id,users.user_type,users.name,users.email,users.image,users.mobile,users.address,users.lat,users.lng,users.status,users.created_at,v.shop_name,v.shop_name_ar,v.person_name,v.person_name_ar,v.cover_image")
                                ->where("users.id",$data['user_id'])
                                ->join("vendor as v", "users.id=v.vendor_id")
                                ->get("users")->row_array();
        $getUserData['device_id']=$newData['device_id'];
        $getUserData['security_token']=$newData['security_token'];
        return $getUserData;
    }

    

    function getProfile($d) {
		$this->db->where('id', $d['user_id']);
        $data = $this->db->get("users")->row_array();
        return $data;
    }
    
    

    

    function profile($d) {
        $tlbName = "users";
        $user_id = $d['user_id'];
        unset($d['user_id']);
        $this->db->where('id', $user_id);
        $result = $this->db->update($tlbName, $d);
        if ($result) {
            return true;
        } else {
            return true;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////USER MODULE////////////////////////////////////////////////////////////
   ///////////////////////////////////////////////////////////////////////////////////////////////
 
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function getSingleDataRow($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }
    function getTableDataArrayLimit($table,$where){
        if($where){ $this->db->where($where); }
        $this->db->limit(10,0);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArray($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArrayGroupBy($table,$where,$groupBy){
        if($where){ $this->db->where($where); }
        $this->db->group_by($groupBy);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArrayOrderBy($table,$where,$orderBY){
        $this->db->where($where);
        $this->db->order_by($orderBY,'DESC');
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function insertDataTable($table,$doc){
        $results = $this->db->insert($table, $doc);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    function updatedataTable($table,$where,$data){
        $this->db->where($where);
        $results = $this->db->update($table, $data);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    function deleteDataTable($table,$where){
        $results=$this->db->where($where)
		        ->delete($table);
        if($results){
            return true;
        }else{
            return false;
        }
    }

    function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }

    function sanitize($input) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInput($input);
            $output = $this->escapeString($input);
        }
        return $output;
    }

    function cleanInput($input) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
        $output = preg_replace($search, '', $input);
        return $output;
    }

    function makeBase64Img($image) {
        $data = str_replace(" ", "+", $image);
        $data = base64_decode($data);
        $im = imagecreatefromstring($data);
        $fileName = rand(5, 115) . time() . ".png";
        //$imageName = "C://xampp/htdocs/refhop/Source/assets/images/".$fileName;
        //$imageName = "/home/allwashes/public_html/allwashes.com/appshow/assets/images/".$fileName;

        $imageName = base_url() . "/assets/images/" . $fileName;
        if ($im !== false) {
            imagepng($im, $imageName);
            imagedestroy($im);
        } else {
            echo 'An error occurred.';
        }
        return $fileName;
    }

    function convert_date($x) {
        $date = date_create($x);
        $new = date_format($date, "M d, Y");
        return $new;
    }

    function printRecord($name, $content) {
        $myfile = fopen('logs/' . $name . "log.txt", "w");
        if (is_array($content)) {
            $content = json_encode($content);
        }
        fwrite($myfile, $content);
        fclose($myfile);
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
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	// echo $lat1.' / '.$lat2.' / '.$lon1.' / '.$lon2.' / '.$unit;  exit();
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    
    
    function upload_image($x) {
        $errors = array();
        $file_ext = explode('.', $_FILES[$x]['name']);
        $countExt=count($file_ext)-1;
        $file_name = $this->my_random_string($file_ext[0]) . time() . '.' . $file_ext[$countExt];
        $file_tmp = $_FILES[$x]['tmp_name'];
        $file_name = urlencode($file_name);
        $folder_name = "./uploads/user/";
        if (empty($errors) == true) {
            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            return array('image'=>base_url() . "uploads/user/" . $file_name);
        } else {
            return false;
        }
    }

    function getImageArray($doc) {
        $data = array();
        $exp = explode(',', $doc);
        $expCount = count($exp);
        for ($i = 0; $i < $expCount; $i++) {
            $imgArr = $this->db->query("SELECT CONCAT(file_path,file_name) as image,file_type FROM user_files WHERE  id='" . $exp[$i] . "' ")->row_array();
            array_push($data, $imgArr);
        }
        return $data;
    }

    function splitTrimData($data){
        $data=ltrim($data,',');
        $data=rtrim($data,',');
        return $data;
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////API MODULES//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    function checkUser($data){
        $this->db->where('id',$data['user_id']);
        $appusers = $this->db->get('appusers')->result_array();
        if($appusers){
            return true;
        }else{
            return false;
        }
    }

    function getProductDataResult($products,$data){
            $productArr=array();
            foreach ($products as $value) {
                $value['cart_quentity']='0';
                $value['is_fav']="0";
                $category=$this->getSingleDataRow('category','id="'.$value['category_id'].'" ');
                $value['category_name']=$category['name'];
                $subcategory=$this->getSingleDataRow('category','id="'.$value['sub_category_id'].'" ');
                $value['subcategory_name']=$subcategory['name'];
                if($value['discount']){
                    $value['discount_price']=$value['price']-(($value['price']*$value['discount'])/100);
                }else{
                    $value['discount_price']=$value['price'];
                }

                $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_cart){
                    $value['cart_quentity']=$product_cart['quantity'];
                }
                $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($wishlist){
                     $value['is_fav']='1';
                }
                $productImages=array();
                $value['rating']="4";
                if($value['images']){
                    $images=$this->splitTrimData($value['images']);
                    $imagesExp=explode(',',$images);
                    if($imagesExp){
                        foreach ($imagesExp as $imgVal) {
                            $files=$this->getSingleDataRow('files','id="'.$imgVal.'"');
                            if($files){
                                $files['image']=$files['file_path'].$files['file_name'];
                                array_push($productImages,$files);
                            }
                        }
                    }
                }
                $value['images']=$productImages;
                array_push($productArr,$value);
            }
            return $productArr;
        }

        function getProductDataRow($value,$data){
            $productArr=array();
            
                $value['cart_quentity']='0';
                $value['is_fav']="0";
                $category=$this->getSingleDataRow('category','id="'.$value['category_id'].'" ');
                $value['category_name']=$category['name'];
                $subcategory=$this->getSingleDataRow('category','id="'.$value['sub_category_id'].'" ');
                $value['subcategory_name']=$subcategory['name'];
                
                if($value['discount']){
                    $value['discount_price']=$value['price']-(($value['price']*$value['discount'])/100);
                }else{
                    $value['discount_price']=$value['price'];
                }
                
                $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_cart){
                    $value['cart_quentity']=$product_cart['quantity'];
                }
                $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($wishlist){
                     $value['is_fav']='1';
                }
                $productImages=array();
                if($value['images']){
                    $images=$this->splitTrimData($value['images']);
                    $imagesExp=explode(',',$images);
                    if($imagesExp){
                        foreach ($imagesExp as $imgVal) {
                            $files=$this->getSingleDataRow('files','id="'.$imgVal.'"');
                            if($files){
                                $files['image']=$files['file_path'].$files['file_name'];
                                array_push($productImages,$files);
                            }
                        }
                    }
                }
                $value['images']=$productImages;
                
                $productAttribute=array();
                $product_attribute=$this->getTableDataArray('product_attribute','product_id="'.$value['product_id'].'"');
                //print_r($product_attribute);exit;
                if($product_attribute){
                    foreach($product_attribute as $attr){
                        $category_attribute=$this->getSingleDataRow('category_attribute','id="'.$attr['attribute_id'].'"');
                        $category_attribute_value=$this->getSingleDataRow('category_attribute_value','id="'.$attr['attribute_value_id'].'"');
                        $arr=array('attribute_id'=>$attr['attribute_id'],'attribute'=>$category_attribute['title'],'attribute_value_id'=>$attr['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                        array_push($productAttribute, $arr);
                    }
                }
//                print_r($productAttribute);EXIT;
                $value['attribute']=$productAttribute;
                
                $productSpecification=array();
                $product_specification=$this->getTableDataArray('product_specification','product_id="'.$value['product_id'].'"');
                //print_r($product_attribute);exit;
                if($product_specification){
                    foreach($product_specification as $specification){
                        $category_attribute=$this->getSingleDataRow('category_attribute','id="'.$specification['attribute_id'].'"');
                        $specification['attribute']=$category_attribute['title'];
                        array_push($productSpecification, $specification);
                    }
                }
//                print_r($productAttribute);EXIT;
                $value['specification']=$productSpecification;
                
                $product_review=$this->getTableDataArray('product_review','product_id="'.$value['product_id'].'"');
                if($product_review){
                    $value['review_count']=count($product_review);
                }else{
                    $value['specification']=0;
                }
            return $value;
        }

        function getCartResult($data){
            $cartArr=array();
            $getMyAddress=array();
            $orderAmount=0;
            $cart=$this->getTableDataArray('cart','user_id="'.$data['user_id'].'"');
            if($cart){
                $getMyAddress=$this->getMyAddress($data);
                foreach($cart as $value){
                    $products=$this->getSingleDataRow('products','product_id="'.$value['product_id'].'" ');
                    if($products){
                        $productImages=array();
                        $category=$this->getSingleDataRow('category','id="'.$products['category_id'].'" ');
                        $value['category_name']=$category['name'];
                        $subcategory=$this->getSingleDataRow('category','id="'.$products['sub_category_id'].'" ');
                        $value['subcategory_name']=$subcategory['name'];
                        $value['name']=$products['name'];
                        $value['vendor_id']=$products['vendor_id'];
                        $value['description']=$products['description'];
                        if($products['images']){
                            $images=$this->splitTrimData($products['images']);
                            $imagesExp=explode(',',$images);
                            if($imagesExp){
                                foreach ($imagesExp as $imgVal) {
                                    $files=$this->getSingleDataRow('files','id="'.$imgVal.'"');
                                    if($files){
                                        $files['image']=$files['file_path'].$files['file_name'];
                                        array_push($productImages,$files);
                                    }
                                }
                            }
                        }
                        $orderAmount=$orderAmount+$value['total'];
                        $value['images']=$productImages;
                        array_push($cartArr,$value);
                    }
                }
                return array('order_amount'=>$orderAmount,'user_address'=>$getMyAddress,'user_cart'=>$cartArr);
            }else{
                return array();
            }
        }
        function getMyAddress($data){
            $addressArr=array();
            $user_address=$this->getTableDataArray('user_address','user_id="'.$data['user_id'].'"');
            if($user_address){
                foreach($user_address as $value){
                    $country=$this->getSingleDataRow('country','id="'.$value['country_id'].'"');
                    $state=$this->getSingleDataRow('state','id="'.$value['state_id'].'"');
                    $city=$this->getSingleDataRow('city','id="'.$value['city_id'].'"');
                    $value['country']=$country['name'];
                    $value['state']=$state['name'];
                    $value['city']=$city['name'];
                    array_push($addressArr,$value);
                }
                return $addressArr;
            }else{
                return array();
            }
        }

        
    function getHomepage($data){
        $latitude=$data['latitude'];
        $longitude=$data['longitude'];
        $serviceArr=array();
        $productArr=array();
        $categoryArr=array();
        $cartData=$this->getCartResult($data);
        $sliderData=$this->getTableDataArray('slider','status=1');
        $headerData=$this->getTableDataArrayLimit('category','status="1" and parent_id="0"');
        if($headerData){
            foreach($headerData as $value){
                $subCatArr=array();
                $headerSubCategory=$this->getTableDataArray('category','status="1" and parent_id="'.$value['id'].'"');
                $value['sub_category']=$headerSubCategory;
                array_push($categoryArr,$value);
            }
        }
        $products = $this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                        ->where("u.status",1)
                        ->where("products.status",1)
                        ->where("products.is_featured",1)
                        ->having('distance>=', 10)
                        ->join("users as u", "products.vendor_id=u.id")
                        ->limit(10, 0)
                        ->get("products")->result_array();
                        //print_r($products);exit;
       if($products){ $productArr=$this->getProductDataResult($products,$data); }
//       return array('slider'=>$sliderData,'serviceArr'=>$serviceArr,'category'=>$categoryArr,'product'=>$productArr,'cart'=>$cartData);
       return array('slider'=>$sliderData,'serviceArr'=>$serviceArr,'category'=>$categoryArr,'product'=>$productArr);
    }
    
    function  getCategory($data){
        $categoryArr=array();
        $headerData=$this->getTableDataArray('category','status="1" and parent_id="0"');
        if($headerData){
            foreach($headerData as $value){
                $headerSubCategory=$this->getTableDataArray('category','status="1" and parent_id="'.$value['id'].'"');
                $value['sub_category']=$headerSubCategory;
                array_push($categoryArr,$value);
            }
        }
        return array('category'=>$categoryArr);
    }
    
    function getCategoryProducts($data){
        $productArr=array();
        $filterDataArr=array();
        $latitude =$data['latitude'];
        $longitude=$data['longitude'];
        $products =$this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                        ->where("u.status",1)
                        ->where("products.status",1)
                        ->where("sub_category_id",$data['sub_category_id'])
                        ->having('distance>=', 10)
                        ->join("users as u", "products.vendor_id=u.id")
                        ->limit($data['limit'],$data['start'])
                        ->get("products")->result_array();
                        //print_r($products);exit;
       if($products){ $productArr=$this->getProductDataResult($products,$data); }
       
       $category=$this->getCategory(array());
       $product_specification=$this->getTableDataArray('category_attribute','sub_category_id="'.$data['sub_category_id'].'" and type="1"');
       if($product_specification){
            foreach($product_specification as $attr){
                $category_attribute_value=$this->getTableDataArray('category_attribute_value','attribute_id="'.$attr['id'].'"');
                $attr['attribute_value']=$category_attribute_value;
                array_push($filterDataArr, $attr);
            }
       }
       return array('products'=>$productArr,'filterData'=>array('attribute'=>$filterDataArr,'category'=>$category['category'],'min_price'=>50,'max_price'=>500,'min_rating'=>0,'max_rating'=>5));
    }

    function productDetail($data){
        $reviewArr=array();
        $products = $this->db->select("products.*,u.name as vendor_name")
                        ->where("u.status",1)
                        ->where("products.status",1)
                        ->where("products.product_id",$data['product_id'])
                        ->join("users as u", "products.vendor_id=u.id")
                        ->get("products")->row_array();
        if($products){
            $productArr=$this->getProductDataRow($products,$data);
            $product_review=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'"');
            if($product_review){
                foreach($product_review as $value){
                    $users=$this->getSingleDataRow('users','id="'.$value['user_id'].'"');
                    $value['user_name']=$users['name'];
                    $value['user_image']=$users['image'];
                    array_push($reviewArr,$value);
                }
            }
            
            $vendor=$this->getSingleDataRow('vendor','id="'.$products['vendor_id'].'"');
            $vendorData['user_name']=$vendor['name'];
            $vendorData['user_image']=$vendor['image'];
            $data['sub_category_id']=$products['sub_category_id'];
            $data['limit']='10';
            $data['start']='0';
            $getCategoryProducts=$this->getCategoryProducts($data);
            if($getCategoryProducts){
                $similarProducts=$getCategoryProducts['products'];
            }else{
                $similarProducts=array();
            }
            return array('productDetail'=>$productArr,'review'=>$reviewArr,'vendorData'=>$vendorData,'similar_products'=>$similarProducts);
        }else{
            return false;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////API MODULES////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        





        
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////OLD MODULES//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////   
        
}
////axios
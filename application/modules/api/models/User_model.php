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
            // $body = $this->load->view('email/register.php',$data,TRUE);
             $body ='Your OTP is : '.$data['otp'];
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
                    $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
                }else{
                    $value['discount_price']=strval($value['price']);
                }

                $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_cart){
                    $value['cart_quentity']=$product_cart['quantity'];
                }
                $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'" and type="1"');
                if($wishlist){
                     $value['is_fav']='1';
                }
                $productImages=array();
                //$value['rating']="4";
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
                $brand=$this->getSingleDataRow('brand','id="'.$value['brand_id'].'" ');
                $value['brand_name']=$brand['name'];
                
                if($value['discount']){
                    $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
                }else{
                    $value['discount_price']=strval($value['price']);
                }
                
                $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_cart){
                    $value['cart_quentity']=$product_cart['quantity'];
                }
                $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'" and type="1"');
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
                
                $value['specification']=$productSpecification;
                
                $product_review=$this->getTableDataArray('product_review','product_id="'.$value['product_id'].'"');
                if($product_review){
                    $value['review_count']=count($product_review);
                }else{
                    $value['review_count']=0;
                }
                //print_r($value);EXIT;
            return $value;
        }

        function getCartResult($data){
            $cartArr=array();
            $getMyAddress=array();
            $productAmount=0;
            $devilery_charges=$this->getSingleDataRow('devilery_charges','id="1"');
            if($devilery_charges){
                $tax=$devilery_charges['tax'];
                $shippingCharges=$devilery_charges['shipping_charges'];
            }else{
                $tax=0;
                $shippingCharges=0;
            }
            $cart=$this->getTableDataArray('cart','user_id="'.$data['user_id'].'"');
            if($cart){
                foreach($cart as $value){
                    $products=$this->getSingleDataRow('products','product_id="'.$value['product_id'].'" ');
                    if($products){
                        $productImages=array();
                        $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'" and type="1"');
                        if($wishlist){
                            $value['is_fav']="1";
                        }else{
                            $value['is_fav']="0";
                        }
                        $category=$this->getSingleDataRow('category','id="'.$products['category_id'].'" ');
                        $value['category_name']=$category['name'];
                        $subcategory=$this->getSingleDataRow('category','id="'.$products['sub_category_id'].'" ');
                        $value['subcategory_name']=$subcategory['name'];
                        $brand=$this->getSingleDataRow('brand','id="'.$products['brand_id'].'" ');
                        $value['brand_name']=$brand['name'];
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
                        $productAmount=$productAmount+$value['total'];
                        $value['images']=$productImages;
                        array_push($cartArr,$value);
                    }
                }
                $paybleAmount=$productAmount+$tax+$shippingCharges;
                return array('productAmount'=>$productAmount,'tax'=>$tax,'shippingCharges'=>$shippingCharges,'paybleAmount'=>$paybleAmount,'userCart'=>$cartArr);
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
        $productArr=array();
        $categoryArr=array();
        $cartData=$this->getCartResult($data);
        // $sliderData=$this->getTableDataArray('slider','status=1 and checked=1');
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
                        //->where("products.is_featured",1)
                        //->having('distance>=', 10)
                        ->join("vendor as u", "products.vendor_id=u.id")
                        ->limit(10, 0)
                        ->get("products")->result_array();
                        //print_r($products);exit;
       if($products){ $productArr=$this->getProductDataResult($products,$data); }
       
        $this->db->where('parent_id',0);
        $this->db->where('status',1);
        $this->db->limit(10,0);
        $serviceArr = $this->db->get('service_category')->result_array();
//       return array('slider'=>$sliderData,'serviceArr'=>$serviceArr,'category'=>$categoryArr,'product'=>$productArr,'cart'=>$cartData);
       return array('slider'=>$sliderData,'serviceArr'=>$serviceArr,'category'=>$categoryArr,'product'=>$productArr);
    }
    
    function  getCategory($data){
        $categoryArr=array();
        $headerData=$this->getTableDataArray('category','status="1" and parent_id="0"');
        if($headerData){
            foreach($headerData as $value){
                $subCategoryArr=array();
                $headerSubCategory=$this->getTableDataArray('category','status="1" and parent_id="'.$value['id'].'"');
                if($headerSubCategory){
                    foreach($headerSubCategory as $subCatValue){
                        $filterDataArr=array();
                        $product_specification=$this->getTableDataArray('category_attribute','sub_category_id="'.$subCatValue['id'].'" and type="1"');
                        if($product_specification){
                             foreach($product_specification as $attr){
                                 $category_attribute_value=$this->getTableDataArray('category_attribute_value','attribute_id="'.$attr['id'].'"');
                                 $attr['attribute_value']=$category_attribute_value;
                                 array_push($filterDataArr, $attr);
                             }
                        }
                        //print_r($filterDataArr);exit;
                        $subCatValue['attributes']=$filterDataArr;
                       array_push($subCategoryArr,$subCatValue);
                   } 
                }
                $value['sub_category']=$subCategoryArr;
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
        if(isset($data['sub_category_id']) and $data['sub_category_id']){
            $where='u.status="1" and products.status="1" and products.sub_category_id="'.$data['sub_category_id'].'"';
        }else{
            $where='u.status="1" and products.status="1"';
        }
        $products =$this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                        ->where($where)
                        //->having('distance>=', 10)
                        ->join("vendor as u", "products.vendor_id=u.id")
                        ->limit($data['limit'],$data['start'])
                        ->get("products")->result_array();
                        //print_r($products);exit;
       if($products){ $productArr=$this->getProductDataResult($products,$data); }
       
       $category=$this->getCategory(array());
       return array('products'=>$productArr,'filterData'=>array('category'=>$category['category'],'min_price'=>50,'max_price'=>500,'min_rating'=>0,'max_rating'=>5));
    }

    function productDetail($data){
        $reviewArr=array();
        $products = $this->db->select("products.*,u.name as vendor_name")
                        ->where("u.status",1)
                        ->where("products.status",1)
                        ->where("products.product_id",$data['product_id'])
                        ->join("vendor as u", "products.vendor_id=u.id")
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
    
    function getReviews($data){
        $reviewDescription=array();
        $reviewArr=array();
        $product_review=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'"');
        if($product_review){
            foreach($product_review as $value){
                $users=$this->getSingleDataRow('users','id="'.$value['user_id'].'"');
                $value['user_name']=$users['name'];
                $value['user_image']=$users['image'];
                array_push($reviewArr,$value);
            }
        }
        for($i=1;$i<=5;$i++){
            $product_review=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="'.$i.'"');
            if($product_review){
                $reviewCount=count($product_review);
            }else{
                $reviewCount=0;
            }
            $arr=array('review_'.$i=>$reviewCount);
            array_push($reviewDescription,$arr);
        }
        $products=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
        $userReview=$this->getSingleDataRow('product_review','product_id="'.$data['product_id'].'" and user_id="'.$data['user_id'].'"');
        if($userReview){
            $isReview=1;
        }else{
            $isReview=0;
        }
        return array('reviewArr'=>$reviewArr,'reviewDescription'=>$reviewDescription,'isReview'=>$isReview,'total_rating'=>$products['rating']);
    }
    
    function insertIntoCart($data,$productData){ 
        $product=array(
            'user_id'       => $data['user_id'],
            'vendor_id'     => $productData['vendor_id'],
            'product_id'    => $productData['product_id'],
            'price'         => $productData['price'],
            'discount'      => $data['discount'],
            'amount'        => $data['amount'],
            'quantity'      => 1,
            'total'         => $data['total']
        );
        $insetCart=$this->insertDataTable('cart',$product);
        if($insetCart){
            $updateArr=array(
                'quantity'      => $productData['quantity']-1
            );
            $updateData=$this->updatedataTable('products','product_id="'.$productData['product_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
        
    function updateIntoCart($data,$productData,$product_cart,$type){
        $updateArr=array(
            'price'         => $productData['price'],
            'discount'      => $data['discount'],
            'amount'        => $data['amount'],
            'quantity'      => $data['quantity'],
            'total'         => $data['total']
        );
        $insetCart=$this->updatedataTable('cart','cart_id="'.$product_cart['cart_id'].'"',$updateArr);
        if($insetCart){
            if($type==1){
                $productQty=$productData['quantity']-1;
            }else{
                $productQty=$productData['quantity']+1;
            }
            $updateArr=array(
                'quantity'      => $productQty
            );
            $updateData=$this->updatedataTable('products','product_id="'.$productData['product_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
    function deleteFromCart($product_cart){
        $product_cart=$this->getSingleDataRow('cart','cart_id="'.$product_cart['cart_id'].'"');
        $productData=$this->getSingleDataRow('products','product_id="'.$product_cart['product_id'].'"');
        $insetCart=$this->deleteDataTable('cart','cart_id="'.$product_cart['cart_id'].'"');
        if($insetCart){
            $updateArr=array(
                'quantity'      => $productData['quantity']+$product_cart['quantity']
            );
            $updateData=$this->updatedataTable('products','product_id="'.$product_cart['product_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
        
    function addToCart($data){
        $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$data['product_id'].'"');
        if($product_cart){
            if($data['type']==1){    ///increse quantity 
                $totalQuantity=$product_cart['quantity']+1;
                $productData=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
                if($productData['quantity']>0){
                    if($productData['discount']){
                        $data['discount']=($productData['price']*$productData['discount'])/100;
                    }else{
                        $data['discount']=0;
                    }
                    $data['amount']=$productData['price']-$data['discount'];
                    $data['quantity']=$totalQuantity;
                    $data['total']=$data['amount']*$data['quantity'];
                    $updateData=$this->updateIntoCart($data,$productData,$product_cart,1);
                    if($updateData){
                        return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Product added successfully.');
                    }else{
                        return array('code'=>203,'status'=>false,'type'=>'data not increase','message'=>'Some error found.Try again.');
                    }
                }else{
                    return array('code'=>201,'status'=>false,'type'=>'quantity','message'=>'Out Of Stock');
                }
            }elseif($data['type']==2){                  ///decrease quantity
                $totalQuantity=$product_cart['quantity']-1;
                if($totalQuantity>0){
                    $productData=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');

                        if($productData['discount']){
                            $data['discount']=($productData['price']*$productData['discount'])/100;
                        }else{
                            $data['discount']=0;
                        }
                        $data['amount']=$productData['price']-$data['discount'];
                        $data['quantity']=$totalQuantity;
                        $data['total']=$data['amount']*$data['quantity'];
                        $updateData=$this->updateIntoCart($data,$productData,$product_cart,2);
                        if($updateData){
                            return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Product remove from cart.');
                        }else{
                            return array('code'=>203,'status'=>false,'type'=>'Some erroe found.Try again.');
                        }
                }else{              //////delete here
                    $updateData=$this->deleteFromCart($product_cart);
                    if($updateData){
                        return array('code'=>205,'status'=>true,'type'=>'delete from cart','message'=>'Product remove from cart');
                    }else{
                        return array('code'=>203,'status'=>false,'type'=>'data not delete','message'=>'Try again.');
                    }
                }
            }else{
                $updateData=$this->deleteFromCart($product_cart);
                if($updateData){
                    return array('code'=>205,'status'=>true,'type'=>'delete from cart','message'=>'Product remove from cart');
                }else{
                    return array('code'=>203,'status'=>false,'type'=>'data not delete','message'=>'Try again.');
                }
            }
        }else{
            $productData=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
            //print_r($productData);exit;
            if($productData['quantity']>0){
                if($productData['discount']){
                    $data['discount']=($productData['price']*$productData['discount'])/100;
                }else{
                    $data['discount']=0;
                }
                $data['amount']=$productData['price']-$data['discount'];
                $data['total']=$data['amount'];
                $insetCart=$this->insertIntoCart($data,$productData);
                if($insetCart){
                    return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Product added successfully');
                }else{
                    return array('code'=>202,'status'=>false,'type'=>'data not insert','message'=>'Some error found.try again.');
                }
            }else{
                return array('code'=>201,'status'=>false,'type'=>'quantity','message'=>'Out Of Stock');
            }
        }
    }
    
    function addToFavourite($data){
        $favData=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$data['product_id'].'" and type="'.$data['type'].'"');
        if($favData){
            $delete=$this->db->where("user_id", $data['user_id'])
                   ->where("product_id", $data['product_id'])
                    ->where("type", $data['type'])
                   ->delete("wishlist");
            if($delete){
                return array('status'=>true,'code'=>200,'message'=>'Remove from wishlist.','data'=>array());
            }else{
                return array('status'=>false,'code'=>201,'message'=>'Some error found.','data'=>array());
            }
        }else{
            $insetFav=$this->insertDataTable('wishlist',$data);
            if($insetFav){
                return array('status'=>true,'code'=>200,'message'=>'Add to wishlist.','data'=>array());
            }else{
                return array('status'=>false,'code'=>201,'message'=>'Some error found.','data'=>array());
            }
        }
    }
    
    function myFavouriteList($data){
           $productFavArr=array();
           $serviceFavArr=array();
           $productFav=$this->getTableDataArray('wishlist','user_id="'.$data['user_id'].'" and type="1"');
            foreach ($productFav as $value) {
                $products=$this->getSingleDataRow('products','product_id="'.$value['product_id'].'" ');
                //print_r($products);
                if($products){
                    $productArr=$this->getProductDataRow($products,$data);
                    $productArr['wishlist_id']=$value['wishlist_id'];
                     array_push($productFavArr,$productArr);
                }
            }
            
            $serviceFav=$this->getTableDataArray('wishlist','user_id="'.$data['user_id'].'" and type="2"');
            foreach ($serviceFav as $value) {
                $service=$this->getSingleDataRow('service','service_id="'.$value['product_id'].'" ');
                $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'" and service_plan_id="1" ');
                if($service_detail){
                    $service['price']=$service_detail['price'];
                    $service['detail_id']=$service_detail['detail_id'];
                }else{
                    $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'"');
                    $service['price']=$service_detail['price'];
                    $service['detail_id']=$service_detail['detail_id'];
                }
                
                //print_r($products);
                if($service){
                    $productImages=array();
                    if($service['images']){
                            $images=$this->splitTrimData($service['images']);
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
                    $service['images']=$productImages;
                    $service['wishlist_id']=$value['wishlist_id'];
                    $service['wishlist_id']=$value['wishlist_id'];
                    array_push($serviceFavArr,$service);
                }
            }
            return array('favouriteList'=>$productFavArr,'serviceList'=>$serviceFavArr);
       }
       
       
        function myFavouriteList_21_11($data){
           $productFavArr=array();
           $productFav=$this->getTableDataArray('wishlist','user_id="'.$data['user_id'].'"');
           //print_r($productFav);exit;
           if($productFav){
               foreach ($productFav as $value) {
                   $products=$this->getSingleDataRow('products','product_id="'.$value['product_id'].'" ');
                   if($products){
                       $productImages=array();
                       $category=$this->getSingleDataRow('category','id="'.$products['category_id'].'" ');
                       $value['category_name']=$category['name'];
                       $subcategory=$this->getSingleDataRow('category','id="'.$products['sub_category_id'].'" ');
                       $value['subcategory_name']=$subcategory['name'];
                       $brand=$this->getSingleDataRow('brand','id="'.$products['brand_id'].'" ');
                       $value['brand_name']=$brand['name'];
                       $value['name']=$products['name'];
                       $value['vendor_id']=$products['vendor_id'];
                       $value['description']=$products['description'];
                       $value['price']=$products['price'];
                       $value['discount']=$products['discount'];
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
                       $value['images']=$productImages;
                       array_push($productFavArr,$value);
                   }
               }
               return array('favouriteList'=>$productFavArr);
           }else{
               return false;
           }
       }
       
       function searchProduct($data){
            $productArr=array();
            $latitude =$data['latitude'];
            $longitude=$data['longitude'];
            $dbLike="u.status=1 and products.status=1 and (products.name LIKE '%".$data['search']."%' )";
            //echo $dbLike;exit;
            $products = $this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                            ->where($dbLike)
                            ->having('distance>=', 10)
                            ->join("vendor as u", "products.vendor_id=u.id")
                            ->get("products")->result_array();
                            // print_r($products);exit;
            if($products){ $productArr=$this->getProductDataResult($products,$data); }
            
            if($productArr){
                return array('products'=>$productArr);
            }else{
                return false;
            }
        }
        
        function addReview($data){
            $results = $this->db->insert('product_review', $data);
            if($results){
                $products=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'" ');
                
                if($products['rating']>0){
                    $rating=($products['rating']+$data['rating'])/2;   
                }else{
                     $rating=($data['rating']);   
                }
                $update = $this->db->query("update af_products set rating = '".$rating."' where product_id= '" . $data['product_id'] . "' ");
                return true;
            }else{
                return false;
            }
        }
        
        function filterProduct($data){
            $productArr=array();
            $isAttributeFilter=false;
            $latitude =$data['latitude'];
            $longitude=$data['longitude'];
            $dbLike="u.status=1 and products.status=1 ";
            if(isset($data['category_id']) and $data['category_id']){
                $dbLike=$dbLike.'and products.category_id="'.$data['category_id'].'" ';
            }
            if(isset($data['sub_category_id']) and $data['sub_category_id']){
                $dbLike=$dbLike.'and products.sub_category_id="'.$data['sub_category_id'].'" ';
            }
            if(isset($data['rating']) and $data['rating']){
                $dbLike=$dbLike.'and products.rating between "0" and  "'.$data['rating'].'" ';
            }
            if(isset($data['max_price']) and isset($data['min_price']) and $data['min_price'] and $data['max_price']){
                $dbLike=$dbLike.'and products.price between "'.$data['min_price'].'" and  "'.$data['max_price'].'" ';
            }
            if(isset($data['attribute']) and $data['attribute']){
                $data['attribute']= ltrim($data['attribute'],',');
                $data['attribute']= rtrim($data['attribute'],',');
                $expData= explode(',', $data['attribute']);
                if($expData){
                    foreach($expData as $val){
                        $category_attribute_value=$this->getSingleDataRow('category_attribute_value','id="'.$val.'" ');
                        if($category_attribute_value){
                            $dbLike=$dbLike.'and pa.attribute_value_id="'.$val.'" ';
                            $isAttributeFilter=true;
                        }
                    }
                }
            }
            if($isAttributeFilter){
                $products = $this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                            ->where($dbLike)
                            ->having('distance>=', 10)
                            ->join("vendor as u", "products.vendor_id=u.id")
                            ->join("product_attribute as pa", "products.product_id=pa.product_id")
                            ->group_by("products.product_id")
                            ->get("products")->result_array();
            }else{
                $products = $this->db->select("products.*,u.name as vendor_name,( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( af_products.latitude ) ) * cos( radians( af_products.longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( af_products.latitude ) ) ) ) AS distance")
                            ->where($dbLike)
                            ->having('distance>=', 10)
                            ->join("vendor as u", "products.vendor_id=u.id")
                            ->group_by("products.product_id")
                            ->get("products")->result_array();
            }
            
//            echo $this->db->last_query();exit;
//            print_r($products);exit;
            if($products){ $productArr=$this->getProductDataResult($products,$data); }
            $category=$this->getCategory(array());
            if($productArr){
                return array('code'=>100,'products'=>$productArr,'filterData'=>array('category'=>$category['category'],'min_price'=>50,'max_price'=>500,'min_rating'=>0,'max_rating'=>5));
//                return array('products'=>$productArr);
            }else{
                return array('code'=>101,'products'=>$productArr,'filterData'=>array('category'=>$category['category'],'min_price'=>50,'max_price'=>500,'min_rating'=>0,'max_rating'=>5));
            }
        }
        
        function getAds($data){
            $slider = $this->db->select("slider.*,u.name as vendor_name,u.image as vendor_image")
                            ->where('slider.status',1)
                            ->join("vendor as u", "slider.vendor_id=u.id")
                            ->get("slider")->result_array();
            if($slider){
                return array('ads'=>$slider);
            }else{
                return false;
            }
        }
        
        function getServiceCategory($data){
            $categoryArr=array();
            $headerData=$this->getTableDataArray('service_category','status="1" and parent_id="0"');
            if($headerData){
                return array('service_category'=>$headerData);
            }else{
                return false;
            }
        }
        
        function getServiceList($data){
            $serviceArr=array();
            $where='u.status="1" and service.status="1" and service.category_id="'.$data['category_id'].'"';
            $getVendors =$this->db->select("service.vendor_id,service.category_id,service.service_id,u.name as vendor_name,u.image as vendor_image")
                            ->where($where)
                            //->having('distance>=', 10)
                            ->join("vendor as u", "service.vendor_id=u.id")
                            ->limit($data['limit'],$data['start'])
                            ->group_by('service.vendor_id')
                            ->get("service")->result_array();
//                            print_r($services);exit;
           if($getVendors){ 
               foreach($getVendors as $vendor){
                   $vendorServices=array();
                   $services=$this->getTableDataArray('service','vendor_id="'.$vendor['vendor_id'].'" and category_id="'.$data['category_id'].'" and status="1"');
                   if($services){
                       foreach($services as $service){
                            $productImages=array();
                            $service_category=$this->getSingleDataRow('service_category','id="'.$service['category_id'].'"');
                            $service['category_name']=$service_category['name'];
                            $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'" and service_plan_id="1" ');
                            if($service_detail){
                                $service['price']=$service_detail['price'];
                            }else{
                                $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'"');
                                $service['price']=$service_detail['price'];
                            }
                            if($service['images']){
                                $images=$this->splitTrimData($service['images']);
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
                            $service['images']=$productImages;
                            array_push($vendorServices,$service);
                       }
                   }
                    $vendor['services']=$vendorServices;
                    if($vendorServices){
                        array_push($serviceArr,$vendor);
                    }
               }
           }
           //print_r($serviceArr);exit;
           if($serviceArr){
               return array('service'=>$serviceArr,'filterData'=>['min_price'=>100,'max_price'=>500]);
           }else{
               return false;
           }
        }
        
        function getServiceList_old($data){
            $serviceArr=array();
            $where='u.status="1" and service.status="1" and service.category_id="'.$data['category_id'].'"';
            $getVendors =$this->db->select("service.vendor_id,service.category_id,service.service_id,u.name as vendor_name,u.image as vendor_image")
                            ->where($where)
                            //->having('distance>=', 10)
                            ->join("vendor as u", "service.vendor_id=u.id")
                            ->limit($data['limit'],$data['start'])
                            ->group_by('service.vendor_id')
                            ->get("service")->result_array();
//                            print_r($services);exit;
           if($getVendors){ 
               foreach($getVendors as $vendor){
                   $vendorServices=array();
                   $services=$this->getTableDataArray('service','vendor_id="'.$vendor['vendor_id'].'"');
                   if($services){
                       foreach($services as $service){
                            $productImages=array();
                            $service_category=$this->getSingleDataRow('service_category','id="'.$vendor['category_id'].'"');
                            $service['category_name']=$service_category['name'];
                            $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$vendor['service_id'].'" and service_plan_id="1" ');
                            if($service_detail){
                                $service['price']=$service_detail['price'];
                            }else{
                                $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'"');
                                $service['price']=$service_detail['price'];
                            }
                            if($service['images']){
                                $images=$this->splitTrimData($service['images']);
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
                            $service['images']=$productImages;
                            array_push($vendorServices,$service);
                       }
                   }
                   $vendor['services']=$vendorServices;
                   array_push($serviceArr,$vendor);
               }
           }
           //print_r($serviceArr);exit;
           if($serviceArr){
               return array('service'=>$serviceArr);
           }else{
               return false;
           }
        }
        
        function getServiceDetail($data){
            $serviceArr=array();
            $similarServicesArr=array();
            $where='u.status="1" and service.status="1" and service.service_id="'.$data['service_id'].'"';
            $service =$this->db->select("service.*,u.name as vendor_name,u.image as vendor_image,u.mobile as vendor_mobile")
                            ->where($where)
                            ->join("vendor as u", "service.vendor_id=u.id")
                            ->get("service")->row_array();
            if($service){
                $productImages=array();
                $devilery_charges=$this->getSingleDataRow('devilery_charges','id="1"');
                $service['service_fees']=$devilery_charges['service_fees'];
                $service_category=$this->getSingleDataRow('service_category','id="'.$service['category_id'].'"');
                $service['category_name']=$service_category['name'];
                $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'" and service_plan_id="1" ');
                if($service_detail){
                    $service['price']=$service_detail['price'];
                    $service['detail_id']=$service_detail['detail_id'];
                }else{
                    $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'"');
                    $service['price']=$service_detail['price'];
                    $service['detail_id']=$service_detail['detail_id'];
                }
                if($service['images']){
                    $images=$this->splitTrimData($service['images']);
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
                $service['images']=$productImages;
                $serviceDetailData =$this->db->select("service_detail.*,sp.name as plan_name")
                            ->where('service_id',$data['service_id'])
                            ->join("service_plan as sp", "service_detail.service_plan_id=sp.plan_id")
                            ->get("service_detail")->result_array();
                $service['plans']=$serviceDetailData;
                $service['is_fav']=0;
                
                $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$service['service_id'].'" and type="2"');
                if($wishlist){
                    $service['is_fav']="1";
                }else{
                    $service['is_fav']="0";
                }
                $service_review_count=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'"');
                if($service_review_count){
                    $service['review_count']=count($service_review_count);
                }else{
                    $service['review_count']=0;
                }
                
                $reviewArr=array();
                $this->db->where('service_id',$data['service_id']);
                $this->db->limit(1,0);
                $service_review = $this->db->get('service_review')->result_array();
                if($service_review){
                    foreach($service_review as $value){
                        $users=$this->getSingleDataRow('users','id="'.$value['user_id'].'"');
                        if($users){
                            $value['user_name']=$users['name'];
                            $value['user_image']=$users['image'];
                        }else{
                            $value['user_name']='anonymous';
                            $value['user_image']='anonymous';
                        }
                        array_push($reviewArr,$value);
                    }
                }
                $service['review']=$reviewArr;
            
                $where='u.status="1" and service.status="1" and service.category_id="'.$service['category_id'].'"';
                $similarServices =$this->db->select("service.*,u.name as vendor_name,u.image as vendor_image")
                            ->where($where)
                            ->join("vendor as u", "service.vendor_id=u.id")
                            ->limit(10,0)
                            ->get("service")->result_array();
                if($similarServices){
                    foreach($similarServices as $serviceRow){
                        $productImages=array();
                        $service_category=$this->getSingleDataRow('service_category','id="'.$serviceRow['category_id'].'"');
                        $serviceRow['category_name']=$service_category['name'];
                        $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$serviceRow['service_id'].'" and service_plan_id="1" ');
                        if($service_detail){
                            $serviceRow['price']=$service_detail['price'];
                        }else{
                            $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$serviceRow['service_id'].'"');
                            $serviceRow['price']=$service_detail['price'];
                        }
                        if($serviceRow['images']){
                            $images=$this->splitTrimData($serviceRow['images']);
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
                        $serviceRow['images']=$productImages;
                        array_push($similarServicesArr,$serviceRow);
                   }
               }
                //print_r($similarServicesArr);exit;
                return array('service_detail'=>$service,'similarService'=>$similarServicesArr);
            }else{
                return false;
            }
        }
        
        function getSimilarServices($data){
            $similarServicesArr=array();
            $where='u.status="1" and service.status="1" and service.category_id="'.$data['category_id'].'"';
            $similarServices =$this->db->select("service.*,u.name as vendor_name,u.image as vendor_image")
                        ->where($where)
                        ->join("vendor as u", "service.vendor_id=u.id")
                        ->get("service")->result_array();
            if($similarServices){
                foreach($similarServices as $serviceRow){
                    $productImages=array();
                    $service_category=$this->getSingleDataRow('service_category','id="'.$serviceRow['category_id'].'"');
                    $serviceRow['category_name']=$service_category['name'];
                    $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$serviceRow['service_id'].'" and service_plan_id="1" ');
                    if($service_detail){
                        $serviceRow['price']=$service_detail['price'];
                    }else{
                        $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$serviceRow['service_id'].'"');
                        $serviceRow['price']=$service_detail['price'];
                    }
                    if($serviceRow['images']){
                        $images=$this->splitTrimData($serviceRow['images']);
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
                    $serviceRow['images']=$productImages;
                    array_push($similarServicesArr,$serviceRow);
               }
               return array('similarService'=>$similarServicesArr);
           }else{
               return false;
           }
        }
        
        function getServiceReviews($data){
        $reviewDescription=array();
        $reviewArr=array();
        $service_review=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'"');
        if($service_review){
            foreach($service_review as $value){
                $users=$this->getSingleDataRow('users','id="'.$value['user_id'].'"');
                $value['user_name']=$users['name'];
                $value['user_image']=$users['image'];
                array_push($reviewArr,$value);
            }
        }
        for($i=1;$i<=5;$i++){
            $service_review_count=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="'.$i.'"');
            if($service_review_count){
                $reviewCount=count($service_review_count);
            }else{
                $reviewCount=0;
            }
            $arr=array('review_'.$i=>$reviewCount);
            array_push($reviewDescription,$arr);
        }
        $service=$this->getSingleDataRow('service','service_id="'.$data['service_id'].'"');
        $userReview=$this->getSingleDataRow('service_review','service_id="'.$data['service_id'].'" and user_id="'.$data['user_id'].'"');
        if($userReview){
            $isReview=1;
        }else{
            $isReview=0;
        }
        return array('reviewArr'=>$reviewArr,'reviewDescription'=>$reviewDescription,'isReview'=>$isReview,'total_rating'=>$service['rating']);
    }
    
    function addServiceReview($data){
        $results = $this->db->insert('service_review', $data);
        if($results){
            $service=$this->getSingleDataRow('service','service_id="'.$data['service_id'].'" ');
            if($service['rating']>0){
                $rating=($service['rating']+$data['rating'])/2;   
            }else{
                 $rating=($data['rating']);   
            }
            $update = $this->db->query("update af_service set rating = '".$rating."' where service_id= '" . $data['service_id'] . "' ");
            return true;
        }else{
            return false;
        }
    }
    
    function serviceBooking($data){
        $data['payment_type']=2;
        $data['payment_status']=1;
        $data['status']=1;
        $data['created_at']=date('Y-m-d H:i:s');
        $results = $this->db->insert('service_booking', $data);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    
    function placeOrder($data){
        $myCart=$this->getTableDataArray('cart','user_id="'.$data['user_id'].'"');
        if($myCart){
            $order=array(
                'user_id'           => $data['user_id'],
                'mobile'            => $data['mobile'],
                'amount'            => $data['amount'],
                'delivery_charges'  => $data['delivery_charges'],
                'tax'               => $data['tax'],
                'total'             => $data['total'],
                'latitude'          => $data['latitude'],
                'longitude'         => $data['longitude'],
                'landmark'          => $data['landmark'],
                'user_name'         => $data['user_name'],
                'address'           => $data['address'],
                'payment_type'      => 2,
                'payment_status'    => 0,
                'status'            => 1,
                'created_at'        => date('Y-m-d H:i:s'),
            );
            $insetOrder=$this->insertDataTable('orders',$order);
            if($insetOrder){
                $insert_id = $this->db->insert_id();
                foreach ($myCart as $value) {
                    $orderItem=array(
                        'order_id'      => $insert_id,
                        'vendor_id'     => $value['vendor_id'],
                        'product_id'    => $value['product_id'],
                        'price'         => $value['price'],
                        'discount'      => $value['discount'],
                        'amount'        => $value['amount'],
                        'quantity'      => $value['quantity'],
                        'total'         => $value['total']
                    );
                    $insetOrderItem=$this->insertDataTable('order_items',$orderItem);
                    $this->db->where("cart_id", $value['cart_id'])
                             ->delete('cart');
                }
                return array('status'=>true,'code'=>100,'message'=>'Order placed successfully.','data'=>new stdClass());
            }else{
                return array('status'=>false,'code'=>101,'message'=>'Some error found.Try again.','data'=>new stdClass());
            }
        }else{
            return array('status'=>false,'code'=>102,'message'=>'Cart is empty.','data'=>new stdClass());
        }
    }
    
    function myOrders($data){
        $active=$this->getTableDataArrayOrderBy('orders','user_id="'.$data['user_id'].'" and (status="1" or status="2" or status="3")','order_id');
        $complete=$this->getTableDataArrayOrderBy('orders','user_id="'.$data['user_id'].'" and (status="4")','order_id');
        $cancel=$this->getTableDataArrayOrderBy('orders','user_id="'.$data['user_id'].'" and (status="5")','order_id');
        return array('activeOrder'=>$active,'completeOrder'=>$complete,'cancelOrder'=>$cancel);
    }
    
    function orderDetail($data){
        $orderItemsArr=array();
        $orders = $this->db->where("order_id",$data['order_id'])
                            ->where("user_id",$data['user_id'])
                            ->get("orders")->row_array();
        if($orders){
            $orderItems = $this->db->select("orders.order_id,oi.product_id,oi.vendor_id,oi.price as product_price,oi.discount as product_discount,oi.amount as product_amount,oi.quantity as product_quantity,oi.total as product_total")
                            ->where("oi.order_id",$data['order_id'])
                            ->join("order_items as oi", "orders.order_id=oi.order_id")
                            ->get("orders")->result_array();
            if($orderItems){
                foreach($orderItems as $value){
                    $productData=$this->getSingleDataRow('products','product_id="'.$value['product_id'].'"');
                    $value['name']=$productData['name'];
                    
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
                    $value['specification']=$productSpecification;
                    
                    $bannerImages=array();
                    if($productData['images']){
                            $banner=$this->splitTrimData($productData['images']);
                            $bannerExp=explode(',',$banner);
                            if($bannerExp){
                                foreach ($bannerExp as $imgVal) {
                                    $files=$this->getSingleDataRow('files','id="'.$imgVal.'"');
                                    if($files){
                                        $files['image']=$files['file_path'].$files['file_name'];
                                        array_push($bannerImages,$files);
                                    }
                                }
                            }
                        }
                    $value['images']=$bannerImages;
                    array_push($orderItemsArr,$value);
                }
                $orders['items']=$orderItemsArr;
                
            }
            return $orders;
        }else{
            return false;
        }
    }
    
    function myBookings($data){
        $active=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and (status="1" or status="2")','booking_id');
        $complete=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and (status="3")','booking_id');
        $cancel=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and (status="4")','booking_id');
        return array('activeBooking'=>$active,'completeBooking'=>$complete,'cancelBooking'=>$cancel);
    }

    function bookingDetail($data){
        $orderItemsArr=array();
        $orders = $this->db->where("booking_id",$data['booking_id'])
                            ->where("user_id",$data['user_id'])
                            ->get("service_booking")->row_array();
        if($orders){
            $productImages=array();
            $service=$this->getSingleDataRow('service','service_id="'.$orders['service_id'].'"');
            $orders['service_name']=$service['name'];
            if($service['images']){
                    $images=$this->splitTrimData($service['images']);
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
            $orders['images']=$productImages;
            $serviceDetailData =$this->db->select("service_detail.*,sp.name as plan_name")
                            ->where('detail_id',$orders['detail_id'])
                            ->join("service_plan as sp", "service_detail.service_plan_id=sp.plan_id")
                            ->get("service_detail")->row_array();
            $orders['plans']=$serviceDetailData['price'];
            $orders['plans_name']=$serviceDetailData['plan_name'];
            return $orders;
        }else{
            return false;
        }
    }
    
    function filterVendor($data){
        $serviceArr=array();
        $where='u.status="1" and service.status="1" and service.category_id="'.$data['category_id'].'"';
        if(isset($data['rating'])){
            if($data['rating']){
                $where=$where.' and service.rating between 1 and "'.$data['rating'].'"';
            }
        }
        $getVendors =$this->db->select("service.service_id,service.vendor_id,service.category_id,service.service_id,u.name as vendor_name,u.image as vendor_image")
                        ->where($where)
                        //->having('distance>=', 10)
                        ->join("vendor as u", "service.vendor_id=u.id")
                        ->group_by('service.vendor_id')
                        ->get("service")->result_array();
                           //print_r($getVendors);exit;
       if($getVendors){ 
           foreach($getVendors as $vendor){
               $vendorServices=array();
               $whereVendor='vendor_id="'.$vendor['vendor_id'].'" and category_id="'.$data['category_id'].'" and status="1"';
               if(isset($data['rating'])){
                    if($data['rating']){
                        $whereVendor=$whereVendor.' and rating between 1 and "'.$data['rating'].'"';
                    }
                }
               $services=$this->getTableDataArray('service',$whereVendor);
               //print_r($services);exit;
               if($services){
                   foreach($services as $service){
                        $checkPriceFilter=true;
                        if(isset($data['min_price']) and isset($data['max_price'])){
                            if($data['min_price'] and $data['max_price']){
                                $wherePlan='service_id="'.$service['service_id'].'" and price between "'.$data['min_price'].'" and "'.$data['max_price'].'"';
                                $serviceDetailData =$this->db->select("service_detail.*,sp.name as plan_name")
                                                        ->where($wherePlan)
                                                        ->join("service_plan as sp", "service_detail.service_plan_id=sp.plan_id")
                                                        ->get("service_detail")->result_array();
                                if($serviceDetailData){
                                    $checkPriceFilter=true;
                                }else{
                                    $checkPriceFilter=false;
                                }
                            }
                        }
                        
                        if($checkPriceFilter){
                            $productImages=array();
                            $service_category=$this->getSingleDataRow('service_category','id="'.$data['category_id'].'"');
                            $service['category_name']=$service_category['name'];
                            $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'" and service_plan_id="1" ');
                            if($service_detail){
                                $service['price']=$service_detail['price'];
                            }else{
                                $service_detail=$this->getSingleDataRow('service_detail','service_id="'.$service['service_id'].'"');
                                $service['price']=$service_detail['price'];
                            }
                            if($service['images']){
                                $images=$this->splitTrimData($service['images']);
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
                            $service['images']=$productImages;
                            array_push($vendorServices,$service);
                        }
                   }
               }
               if($vendorServices){
                    $vendor['services']=$vendorServices;
                    array_push($serviceArr,$vendor);
               }
           }
       }
       //print_r($serviceArr);exit;
       if($serviceArr){
           return array('service'=>$serviceArr);
       }else{
           return false;
       }
    }
    
    function submitContactUs($data){
        $contact_us=$this->insertDataTable('contact_us',$data);
        if($contact_us){
            return true;
        }else{
            return false;
        }
    }
    
    function getContactSubject($data){
        $contact_subject=$this->getTableDataArrayOrderBy('contact_subject','status="1"','id');
        return array('contact_subject'=>$contact_subject);
    }



 ////////////////////////////////////////////////////CHAT///////////////////////////////////
    function sendMessage($data) {
        $getConversation = $this->db->query("SELECT c_id  FROM af_conversation  WHERE  (user_id='" . $data['user_id'] . "' AND vendor_id='" . $data['vendor_id'] . "')")->row_array();
        //print_r($getConversation);exit;
        $sender_id=$data['sender_id'];unset($data['sender_id']);
        $user_type=$data['user_type'];unset($data['user_type']);
        if ($getConversation) {
            $updated_at = array('updated_at' => strtotime(date('Y-m-d H:i:s')));
            $this->db->where('c_id', $getConversation['c_id']);
            $this->db->update('conversation', $updated_at);
            $reply = array('sender_id' => $sender_id,'user_type'=>$user_type, 'reply' => $data['message'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'c_id_fk' => $getConversation['c_id']);
            $conversation_reply = $this->db->insert('conversation_reply', $reply);
            $reply_insert_id = $this->db->insert_id();
        } else {
            $doc = array('user_id' => $data['user_id'], 'vendor_id' => $data['vendor_id'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
            $conversation = $this->db->insert('conversation', $doc);
            $insert_id = $this->db->insert_id();
            $reply = array('sender_id' => $sender_id,'user_type'=>$user_type, 'reply' => $data['message'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'c_id_fk' => $insert_id);
            $conversation_reply = $this->db->insert('conversation_reply', $reply);
            $reply_insert_id = $this->db->insert_id();
        }
        if ($conversation_reply) {
//            $getConversationList = $this->db->query("SELECT R.cr_id,R.created_at,R.reply as message,R.sender_id,R.user_type,R.c_id_fk  as c_id,U.id as user_id,U.name,U.email,U.image FROM af_users U, af_conversation_reply R WHERE R.sender_id=U.id and R.cr_id='" . $reply_insert_id . "' ORDER BY R.cr_id ASC LIMIT 20")->row_array();
//            if ($getConversationList) {
//                $getConversationList['is_sender'] = '1';
//            }
//            $user_auth = $this->getRowData(['user_id' => $data['user_id2']], 'user_auth');
//            $user = $this->getRowData(['id' => $data['user_id2']], 'user');
//            $sender = $this->getRowData(['id' => $data['user_id1']], 'user');
//
//            // print_r($pushData);exit;
//            $messageData = $data['message'];
//            $pushData['title'] = "New message from " . $sender['full_name'];
//            $pushData['body'] = $messageData;
//            $pushData['type'] = 'user_chat';
//            $pushData['cr_id'] = $getConversationList['cr_id'];
//            $pushData['created_at'] = $getConversationList['created_at'];
//            $pushData['user_id_fk'] = $getConversationList['user_id_fk'];
//            $pushData['user_id'] = $getConversationList['user_id'];
//            $pushData['full_name'] = $getConversationList['full_name'];
//            $pushData['email'] = $getConversationList['email'];
//            $pushData['profile_image'] = $getConversationList['profile_image'];
//            $pushData['c_id'] = $getConversationList['c_id'];
//            $pushData['message'] = $data['message'];
//            $pushData['is_sender'] = '0';
//            $message = json_encode($pushData);
//            if ($user_auth['device_type'] == 2) {
//                $notify = $this->sendIosFcmPush($user_auth['device_token'], $pushData);
//            } else {
//                $notify = $this->sendAndroidPush($user_auth['device_token'], $message);
//            }

            $getConversationList = $this->db->query("SELECT R.cr_id,R.created_at,R.reply as message,R.sender_id,R.user_type,R.c_id_fk  as c_id FROM af_conversation_reply R WHERE  R.cr_id='" . $reply_insert_id . "' ORDER BY R.cr_id ASC LIMIT 20")->row_array();
            return array('last_message'=>$getConversationList);
        } else {
            return false;
        }
    }

    function getMessageDetail($data) {
        $user_id = $data['user_id'];
        $getConversationListArr = array();
//        $getConversationList = $this->db->query("SELECT R.cr_id,R.created_at,R.reply as message,R.user_id_fk,U.id as user_id,U.full_name,U.email,U.profile_image FROM user U, conversation_reply R WHERE R.user_id_fk=U.id and (NOT FIND_IN_SET('$user_id', delete_chat_user)) and R.c_id_fk='" . $data['c_id'] . "' ORDER BY R.cr_id DESC LIMIT " . $data['start'] . ",50")->result_array();
        ///print_r($getConversationList);exit;
        $getConversation = $this->db->query("SELECT c_id  FROM af_conversation  WHERE  (user_id='" . $data['user_id'] . "' AND vendor_id='" . $data['vendor_id'] . "')")->row_array();
        if($getConversation){
            $this->db->where('c_id_fk',$getConversation['c_id']);
            $this->db->order_by('cr_id','DESC');
            $this->db->limit(50,$data['start']);
            $getConversationList = $this->db->get('conversation_reply')->result_array();
            if($getConversationList){
                foreach($getConversationList as $value){
                    $value['message']=$value['reply'];unset($value['reply']);
                    if ($value['sender_id'] == $data['user_id']) {
                         $value['is_sender'] = '1';
                    }else {
                        $value['is_sender'] = '0';
                    }
                    array_push($getConversationListArr, $value);
                }
                return array('message_data'=>$getConversationListArr);
            }else {
                return false;
            }
        }else{
            return false;
        }
    }
 ////////////////////////////////////////////////////CHAT/////////////////////////////////// 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////API MODULES////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        





        
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////OLD MODULES//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////   
        
}
////axios
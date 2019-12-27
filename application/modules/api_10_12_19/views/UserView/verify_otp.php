<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
        $model                         = new User_model();
        $required = array ('email', 'otp','device_type', 'device_id', 'device_token');
        $headers                        = getallheaders();
        $lang                           = isset($headers['Lang']) ? $headers['Lang'] : "en";
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        $document['email']              = $_REQUEST['email'];
        $document['otp']                = $_REQUEST['otp'];
        $document['device_type']        = $_REQUEST['device_type'];
        $document['device_id']          = $_REQUEST['device_id'];
        $document['device_token']       = $_REQUEST['device_token'];

        $check_email                    = $model->check_email($_REQUEST);
	    if($check_email){
                if($check_email['status']==99){
                    $error          = true;
                    $code           = 203;
                    $msg            = 'This account is permanently de-activated.';
                    $data           = new stdClass();
                }else{
                    if($check_email['status']==2){
                        $error          = true;
                        $code           = 204;
                        $msg            = 'You are blocked by admin.';
                        $data           = new stdClass();
                    }else{
                        $send               =  $model->check_OTP($document);
                        if($send){
                            $msg            = 'User Verified Successfully';
                            $error          = false;
                            $code           = 200;
                            $data           = $send;
                        }else{
                            $error          = true;
                            $code           = 201;
                            $msg            = 'please check otp';
                            $data           = new stdClass();
                        }
                    }
                }
        }else{
            $error                      = true;
            $code                       = 202;
            $msg                        = 'This Email is not registered';
            $data                       = new stdClass();
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
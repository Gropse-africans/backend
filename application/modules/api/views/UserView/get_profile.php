<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $headers                    = getallheaders();
    $document                   = array();
    $document['device_id']      = isset($headers['DeviceId']) ? $headers['DeviceId'] : "";
    $document['security_token'] = isset($headers['SecurityToken']) ? $headers['SecurityToken'] : "";
    $lang                       = isset($headers['Lang']) ? $headers['Lang'] : "en";
    //Check Authentication
    $exist=$model->is_valid_header($document);
    if($exist){
        $required = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        //Check Required Fields
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $check                      = $model->getProfile($_REQUEST);
            if($check){
                $error                  = false;
                $code                   = 200;
                $msg                    = 'Profile Getting Sucessfully';
                $data                   = $check;
            }else{
                $error                  = true;
                $code                   = 97;
                $msg                    = 'User not exist.';
                $data                   = new stdClass();
            }
        }
    }else{
        $error                  = true;
        $code                   = 301;
        $msg                    = 'Authentication failed.';
        $data                   = new stdClass();
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
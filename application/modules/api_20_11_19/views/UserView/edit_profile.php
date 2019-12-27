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
        //Check Required Fields
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $check                              = $model->getProfile($_REQUEST);
            if($check){
                $errorMobile=false;
                if(isset($_REQUEST['mobile'])){
                    $checkMbl                       = $model->getSingleDataRow('users','mobile="'.$_REQUEST['mobile'].'" and id!="'.$_REQUEST['user_id'].'"');
                    if($checkMbl){
                        $errorMobile=true;
                    }
                }
                
                if($errorMobile){
                    $error                  = true;
                    $code                   = 202;
                    $msg                    = 'Mobile is already exist.';
                    $data                   = new stdClass();
                }else{
                    $editProfile                    = $model->profile($_REQUEST);
                    if($editProfile){
                        $check                      = $model->getProfile($_REQUEST);
                        if($check){
                            $error                  = false;
                            $code                   = 200;
                            $msg                    = 'Profile Updated Sucessfully';
                            $data                   = $check;
                        }else{
                            $error                  = true;
                            $code                   = 201;
                            $msg                    = 'Some Error Found';
                            $data                   = new stdClass();
                        }
                    }else{
                        $error                  = true;
                        $code                   = 201;
                        $msg                    = 'Some Error Found';
                        $data                   = new stdClass();
                    }
                }
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
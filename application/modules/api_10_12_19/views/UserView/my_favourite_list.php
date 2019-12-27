<?php
    $model                      = new User_model();
    $headers                    = getallheaders();
    $document                   = array();
    $document['device_id']      = isset($headers['DeviceId']) ? $headers['DeviceId'] : "";
    $document['security_token'] = isset($headers['SecurityToken']) ? $headers['SecurityToken'] : "";
    $lang                       = isset($headers['lang']) ? $headers['lang'] : "en";
    $required                   = array ('user_id');
    $exist                      = $model->is_valid_header($document);
    
    if($exist){
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
            if($checkRequired['status']){
                $error              = true;
                $code               = 98;
                $msg                = $checkRequired['field'].' field is required.';
                $data               = new stdClass();
            }else{
                $check              = $model->myFavouriteList($_REQUEST); 
                if($check){
                    $error                  = false;
                    $code                   = 200;
                    $msg                    = "My Wishlist List.";
                    $data                   = $check;
                }else{
                    $error                  = true;
                    $code                   = 201;
                    $msg                    = "My Wishlist List.";
                    $data                   = new stdClass();
                }
            }
    }else{
        $error                  = true;
        $code                   = 301;
        $msg                    = 'Authentication failed.';
        $data                   = new stdClass();
    }
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));

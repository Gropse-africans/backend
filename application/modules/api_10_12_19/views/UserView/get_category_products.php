<?php
    $model                      = new User_model();
    $headers                    = getallheaders();
    $document                   = array();
    $document['device_id']      = isset($headers['DeviceId']) ? $headers['DeviceId'] : "";
    $document['security_token'] = isset($headers['SecurityToken']) ? $headers['SecurityToken'] : "";
    $lang                       = isset($headers['lang']) ? $headers['lang'] : "en";
//    $required                   = array ('user_id','category_id','sub_category_id','latitude','longitude','limit');
    $required                   = array ('user_id','latitude','longitude','limit');
    
    if($_REQUEST['user_id']==00){
        $exist=true;
    }else{
        $exist=$model->is_valid_header($document);
    }
    if(isset($_REQUEST['start'])){
        if($_REQUEST['start']){
            $_REQUEST['start']=$_REQUEST['start'];
        }else{
            $_REQUEST['start']='0';
        }
    }else{
        $_REQUEST['start']='0';
    }
    if($exist){
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
            if($checkRequired['status']){
                $error              = true;
                $code               = 98;
                $msg                = $checkRequired['field'].' field is required.';
                $data               = new stdClass();
            }else{
                $data               = $model->getCategoryProducts($_REQUEST); 
                $error              = false;
                $code               = 200;
                $msg                = 'Product data';
                $data               = $data;
            }
    }else{
        $error                  = true;
        $code                   = 301;
        $msg                    = 'Authentication failed.';
        $data                   = new stdClass();
    }
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));

<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $required = array ( 'user_id','password');
    $model                          = new User_model();
    $headers                        = getallheaders();
    $lang                           = isset($headers['Lang']) ? $headers['Lang'] : "en";
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        //	$model->printRecord("register_req", $_REQUEST);
            $_REQUEST['password']               = md5($_REQUEST['password']);
            $checkPassword                      = $model->getSingleDataRow('users','id="'.$_REQUEST['user_id'].'" and password="'.$_REQUEST['password'].'"');
            if($checkPassword){
                $error                          = false;
                $code                           = 200;
                $msg                            = 'Password match.';
                $data                           = new stdClass();
            }else{
                $error                          = false;
                $code                           = 201;
                $msg                            = 'password incorrect.';
                $data                           = new stdClass();
            }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
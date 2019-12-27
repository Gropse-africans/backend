<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

        $required = array ('user_id','vendor_id','user_type','message','sender_id');
        //Check Required Fields
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
                $check                      = $model->sendMessage($_REQUEST);
                if($check){
                    $error                  = false;
                    $code                   = 200;
                    $msg                    = "Message send successfully.";
                    $data                   = $check;
                }else{
                    $error                  = true;
                    $code                   = 201;
                    $msg                    = "Some error found.Try again.";
                    $data                   = new stdClass();
                }
            
        }
    
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

        $required = array ('vendor_id','user_id');
        //Check Required Fields
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
                if(isset($_REQUEST['start'])){
                    if($_REQUEST['start']){
                        $_REQUEST['start']=$_REQUEST['start'];
                    }else{
                        $_REQUEST['start']=0;
                    }
                }else{
                    $_REQUEST['start']=0;
                }
                $check                      = $model->getMessageDetail($_REQUEST);
                if($check){
                    $error                  = false;
                    $code                   = 200;
                    $msg                    = "Message Data.";
                    $data                   = $check;
                }else{
                    $error                  = true;
                    $code                   = 201;
                    $msg                    = "Data not found.";
                    $data                   = new stdClass();
                }
            
        }
    
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
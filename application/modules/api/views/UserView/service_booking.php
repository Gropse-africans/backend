<?php
    $model                      = new User_model();
    $headers                    = getallheaders();
    $document                   = array();
    $document['device_id']      = isset($headers['DeviceId']) ? $headers['DeviceId'] : "";
    $document['security_token'] = isset($headers['SecurityToken']) ? $headers['SecurityToken'] : "";
    $lang                       = isset($headers['lang']) ? $headers['lang'] : "en";
    $required                   = array ('user_id','user_name','service_id','detail_id','start_date','start_time','end_date','end_time','service_fees','amount','total','latitude','longitude','address','landmark','mobile');
    
    $exist=$model->is_valid_header($document);
    if($exist){
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
            if($checkRequired['status']){
                $error              = true;
                $code               = 98;
                $msg                = $checkRequired['field'].' field is required.';
                $data               = new stdClass();
            }else{
                $check                      = $model->getProfile($_REQUEST);
                if($check){
                    $data                   = $model->serviceBooking($_REQUEST); 
                    if($data){
                        $error              = false;
                        $code               = 200;
                        $msg                = 'Booking successfully confirmed.';
                        $data               = new stdClass();
                    }else{
                        $error              = true;
                        $code               = 201;
                        $msg                = 'Some error found.';
                        $data               = new stdClass();
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
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));

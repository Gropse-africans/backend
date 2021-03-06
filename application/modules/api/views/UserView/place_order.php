<?php
    $model                      = new User_model();
    $headers                    = getallheaders();
    $document                   = array();
    $document['device_id']      = isset($headers['DeviceId']) ? $headers['DeviceId'] : "";
    $document['security_token'] = isset($headers['SecurityToken']) ? $headers['SecurityToken'] : "";
    $lang                       = isset($headers['lang']) ? $headers['lang'] : "en";
    $required                   = array ('user_id','user_name','amount','tax','delivery_charges','total','latitude','longitude','address','landmark','mobile');
    
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
                    $data                   = $model->placeOrder($_REQUEST); 
                    if($data['status']){
                        $error              = false;
                        $code               = 200;
                        $msg                = 'Order place successfully.';
                        $data               = new stdClass();
                    }else{
                        if($data['code']==102){
                            $error              = true;
                            $code               = 202;
                            $msg                = 'Cart is empty.';
                            $data               = new stdClass();
                        }else{
                            $error              = true;
                            $code               = 201;
                            $msg                = 'Some error found.';
                            $data               = new stdClass();
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
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));

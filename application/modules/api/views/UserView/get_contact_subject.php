<?php
    $model              = new User_model();
    
    $data               = $model->getContactSubject($_REQUEST); 
    $error              = false;
    $code               = 200;
    $msg                = 'Category data';
    $data               = $data;


    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));

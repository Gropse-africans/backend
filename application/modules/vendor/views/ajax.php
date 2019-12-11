<?php 
if ($_POST['method'] == 'add_product') {
    $model = new Vendor_model();
    $subCategory        = $this->input->post('subcategory');
    $getcategoryAttribute=$this->Vendor_model->getcategoryAttribute($subCategory);
    $getcategorySpecification=$this->Vendor_model->getcategorySpecification($subCategory);
    // echo '<pre/>';print_r($getcategoryAttribute);exit;
    //$jsonQuery = json_encode($query);
    if ($getcategoryAttribute || $getcategorySpecification) {
        $error          = false;
        $code           = 200;
        $msg            = 'Attribute list.';
        $data           = array('getcategoryAttribute'=>$getcategoryAttribute,'getcategorySpecification'=>$getcategorySpecification);
    } else {
        $error          = true;
        $code           = 201;
        $msg            = 'Error';
        $data           = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg,      'data' => $data));
}
?>
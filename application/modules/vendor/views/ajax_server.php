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
if ($_POST['method'] == 'changeStatus') {

    $id = $this->input->post('id');
    $update['status'] = $this->input->post('action');
    $query = $this->Vendor_model->updateData('product_id="' . $id . '"', $table, $update);
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'deleteData') {
    $type = $this->input->post('type');
    $id = $this->input->post('id');
    if ($type == 1) {
        $updateData = $this->Vendor_model->updateData(['product_id' => $id], 'products', array('status' => '99'));
    }else if ($type == 2) {
        $updateData = $this->Vendor_model->updateData(['id' => $id], 'slider', array('status' => '99'));
    }else{
        $updateData=false;
    }
    if ($updateData) {
        $error = false;
        $code = 100;
        $msg = 'Data Updated Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error.';
        $data = array();
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
?>

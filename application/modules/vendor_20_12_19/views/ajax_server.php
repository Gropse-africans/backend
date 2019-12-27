<?php

if ($_POST['method'] == 'add_product') {
    $model = new Vendor_model();
    $subCategory = $this->input->post('subcategory');
    $getcategoryAttribute = $this->Vendor_model->getcategoryAttribute($subCategory);
    $getcategorySpecification = $this->Vendor_model->getcategorySpecification($subCategory);
    // echo '<pre/>';print_r($getcategoryAttribute);exit;
    //$jsonQuery = json_encode($query);
    if ($getcategoryAttribute || $getcategorySpecification) {
        $error = false;
        $code = 200;
        $msg = 'Attribute list.';
        $data = array('getcategoryAttribute' => $getcategoryAttribute, 'getcategorySpecification' => $getcategorySpecification);
    } else {
        $error = true;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
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
    } else if ($type == 2) {
        $updateData = $this->Vendor_model->updateData(['id' => $id], 'slider', array('status' => '99'));
    } else if ($type == 3) {
        $updateData = $this->Vendor_model->updateData(['service_id' => $id], 'service', array('status' => '99'));
    } else {
        $updateData = false;
    }
    if ($updateData) {
        $error = false;
        $code = 100;
        $msg = 'Data Deleted Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error.';
        $data = array();
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'subscribe') {
    $plan = $this->Vendor_model->getRowData(['id' => $this->input->post('plan')], 'subscription_plan');
    if ($plan) {
        $subscription_date = date('Y-m-d H:i:s');
        $expiry_date = date('Y-m-d H:i:s', strtotime($subscription_date.'+ ' . $plan['duration'] . ' Days'));
        $update = $this->Vendor_model->updateData(['id'=>$this->vendor_data['vendor_id']], 'vendor',['plan_id' => $this->input->post('plan'), 'expiry_date' => $expiry_date]);
        if ($update) {
            $insert = $this->Vendor_model->addData('vendor_subscription', ['vendor_id'=>$this->vendor_data['vendor_id'],'plan_id'=>$this->input->post('plan'),'subscribe_date'=>$subscription_date,'expire_date'=>$expiry_date]);
            $error = false;
            $code = 100;
            $msg = 'You Have Subscribed The Plan Successfully';
            $data = array();
        } else {
            $error = false;
            $code = 101;
            $msg = 'Currently Unable To Subscribe Your Plan';
            $data = array();
        }
    } else {
        $error = false;
            $code = 102;
            $msg = 'This Plan Is Unavailable';
            $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

?>

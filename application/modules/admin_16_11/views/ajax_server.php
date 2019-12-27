<?php

if ($_POST['method'] == 'login') {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $query = $this->Admin_model->admin_login($email, $password);
    if ($query) {
        $sessionArr = ['is_login' => true, 'admin_id' => $query['id'], 'username' => $query['username']];
        $this->session->set_userdata('af_s_m_admin_logged_in', $sessionArr);
        $getSession = $this->session->userdata('af_s_m_admin_logged_in');
        //print_r($getSession);exit;
        $error = false;
        $code = 200;
        $msg = 'Login Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'changeStatus') {
    $id = $this->input->post('id');
    $update['status'] = $this->input->post('action');
    $type = $_POST['type'];
    if ($type == '1') {
        $table = 'users';
        $coulmnId = 'id';
    } elseif ($type == '2') {
        $table = 'vendor';
        $coulmnId = 'id';
    } elseif ($type == '3') {
        $table = 'category';
        $coulmnId = 'id';
    } elseif ($type == '4') {
        $table = 'products';
        $coulmnId = 'product_id';
    } elseif ($type == '5') {
        $table = 'slider';
        $coulmnId = 'id';
    } elseif ($type == '6') {
        $table = 'brand';
        $coulmnId = 'id';
    } elseif ($type == '7') {
        $table = 'service';
        $coulmnId = 'service_id';
    } elseif ($type == '8') {
        $table = 'service_category';
        $coulmnId = 'id';
    } elseif ($type == '9') {
        $table = 'subscription_plan';
        $coulmnId = 'id';
    } elseif ($type == '10') {
        $table = 'category_attribute';
        $coulmnId = 'id';
    }
    $query = $this->Admin_model->updatedataTable($table, $coulmnId . '="' . $id . '"', $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'updateVendor') {
    $id = $this->input->post('user_id');
    $update['name'] = $this->input->post('name');
    $update['mobile'] = $this->input->post('mobile');
    $update['shop_name'] = $this->input->post('shop_name');
    $update['address'] = $this->input->post('address');

    $query = $this->Admin_model->updatedataTable('vendor', 'id="' . $id . '"', $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Profile Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'plan') {
    $id = $this->input->post('id');
    $update['name'] = $this->input->post('name');
    $update['price'] = $this->input->post('price');
    $update['duration'] = $this->input->post('days');
    $update['description'] = $this->input->post('description');

    $query = $this->Admin_model->updatedataTable('subscription_plan', 'id="' . $id . '"', $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Profile Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'add_product') {
//    $model = new Admin_model();
    $subCategory = $this->input->post('subcategory');
    $getcategoryAttribute = $this->Admin_model->getcategoryAttribute($subCategory);
    $getcategorySpecification = $this->Admin_model->getcategorySpecification($subCategory);
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

if ($_POST['method'] == 'changeFilter') {
    $id = $this->input->post('id');
    $update['is_filter'] = $this->input->post('action');
    $query = $this->Admin_model->updatedataTable('category_attribute', 'id="' . $id . '"', $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'changeRequired') {
    $id = $this->input->post('id');
    $update['is_required'] = $this->input->post('action');
    $query = $this->Admin_model->updatedataTable('category_attribute', 'id="' . $id . '"', $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Vendor_model'));
        date_default_timezone_set('Asia/Kolkata');
        //$this->load->library('session');
        if (!$this->session->userdata('vendor_logged_in')) {
            redirect('vendor');
        } else {
            $this->vendor_data = $this->session->userdata('vendor_logged_in');
            $vendor = $this->Vendor_model->getRowData(['id' => $this->vendor_data['vendor_id']], 'vendor');
            $this->vendor['name'] = $vendor['name'];
            $this->vendor['image'] = $vendor['image'];
            $this->vendor['plan_id'] = $vendor['plan_id'];
            $this->vendor['expiry_date'] = $vendor['expiry_date'];
        }
    }

    public function index() {
        $vendor = $this->Vendor_model->getRowData(['id' => $this->vendor_data['vendor_id']], 'vendor');
        $orders = $this->Vendor_model->getOrder(['o.status!=' => 0])->result_array();
        if ($orders) {
            $data['order_count'] = count($orders);
        } else {
            $data['order_count'] = 0;
        }
        $service_booking = $this->Vendor_model->getBooking(['b.status!=' => 0, 's.vendor_id' => $this->vendor_data['vendor_id']])->result_array();
        if ($service_booking) {
            $data['booking_count'] = count($service_booking);
        } else {
            $data['booking_count'] = 0;
        }
        $data['user'] = $vendor;
        $data['view_link'] = 'vendors/my_profile';
        $this->load->view('include/template', $data);
    }

    public function edit_profile() {
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'numeric');
        $this->form_validation->set_rules('shop_name', 'Company Name', 'required');
        $this->form_validation->set_rules('latitude', 'Address', 'required');
        if ($this->form_validation->run() == False) {
            $this->session->set_flashdata('error_response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While updating Profile. All Fields Required</div>');
            redirect('vendor/my-profile');
        } else {
            $insertArr = [
                'name' => $this->input->post('name'),
                'shop_name' => $this->input->post('shop_name'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'lat' => $this->input->post('latitude'),
                'lng' => $this->input->post('longitude'),
            ];

            $image = $this->upload_file('file_upload', '/uploads/vendor/', 1);
            if ($image) {
                $insertArr['image'] = $image['url'];
            } else {
                $insertArr['image'] = $this->vendor['image'];
            }

            $returnData = $this->Vendor_model->updateData(['id' => $this->vendor_data['vendor_id']], 'vendor', $insertArr);
            if ($returnData) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile updated successfully</div>');
                redirect('vendor/my-profile');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While updating Profile</div>');
                redirect('vendor/my-profile');
            }
        }
    }

    public function verify_user() {
        if ($this->session->userdata('email')) {

            // $data['view_link'] = 'verification';
            $this->load->view('verification');
        } else {
            redirect('vendor/index');
        }
    }

    function send_mail($to, $title, $subject, $data) {
        //print_r($data); exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "ashutosh@gropse.com";
        $config['smtp_pass'] = "ashutosh@123";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";
        $config['wordwrap'] = TRUE;

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        // Sender email address
        $this->email->from("ashutosh@gropse.com", $title);
        // Receiver email address
        $this->email->to($to);
        // Subject of email
        $this->email->subject($subject);
        $body = $this->load->view('email.php', $data, TRUE);
        // Message in email
        $this->email->message($body);
        $result = $this->email->send();
        if ($result) {
            return true;
            // print_r('success'); exit;
        } else {
            return false;
            // show_error($this->email->print_debugger()); 
            // print_r('fail'); exit;
        }
    }

    public function dashboard() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $orders = $this->Vendor_model->getOrder(['o.status!=' => 0])->result_array();
        if ($orders) {
            $data['order_count'] = count($orders);
        } else {
            $data['order_count'] = 0;
        }
        $service_booking = $this->Vendor_model->getBooking(['b.status!=' => 0, 's.vendor_id' => $this->vendor_data['vendor_id']])->result_array();
        if ($service_booking) {
            $data['booking_count'] = count($service_booking);
        } else {
            $data['booking_count'] = 0;
        }
        $data['products'] = count($this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '', 'product_id', 'DESC'));
        $data['services'] = count($this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'service', '', 'service_id', 'DESC'));
        $data['recent_products'] = $this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '5', 'product_id', 'DESC');
        $data['view_link'] = 'dashboard';
        $this->load->view('include/template', $data);
    }

    public function change_password() {
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        if ($this->form_validation->run() == False) {
            $data['view_link'] = 'vendors/change_password';
            $this->load->view('include/template', $data);
        } else {
//            print_r($_POST);
//            exit;
            $insertArr = ['password' => md5($this->input->post('new_password'))];
            $returnData = $this->Vendor_model->updateData(['id' => $this->vendor_data['vendor_id']], 'vendor', $insertArr);
            if ($returnData) {
                $this->session->set_flashdata('response', '<div class="alert alert-primary"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Change Successful.</div>');
                redirect('vendor/change-password');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured. Please try again.</div>');
                redirect('vendor/change-password');
            }
        }
    }

    public function product_list() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $data['products'] = $this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '', 'product_id', 'DESC');
        $data['view_link'] = 'products/product_list';
        $this->load->view('include/template', $data);
    }

    public function product_detail() {
        $product_id = $this->uri->segment(3);
        $vendor_id = $this->vendor_data['vendor_id'];
        $product = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'product_id' => $product_id, 'status!=' => 99], 'products');
        if ($product) {
            $feature = $this->Vendor_model->getProductFeatures(['product_id' => $product_id]);
            $specification = $this->Vendor_model->getProductSpecification(['product_id' => $product_id]);
            $imageArr = [];
            $images = explode(',', $product['images']);
            foreach ($images as $img) {
                $image = $this->Vendor_model->getRowData(['id' => $img], 'files');
                if ($image) {
                    array_push($imageArr, $image);
                }
            }
            $product['image'] = $imageArr;
            $brand = $this->Vendor_model->getRowData(['id' => $product['brand_id']], 'brand');
            if ($brand) {
                $product['brand'] = $brand['name'];
            } else {
                $product['brand'] = '';
            }
            if ($feature) {
                $product['feature'] = $feature;
            } else {
                $product['feature'] = [];
            }
            if ($specification) {
                $product['specification'] = $specification;
            } else {
                $product['specification'] = [];
            }
        }
        // print_r($product);exit;
        $data['product'] = $product;
        $data['view_link'] = 'products/product_detail';
        $this->load->view('include/template', $data);
    }

    public function add_product() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $vendor = $this->Vendor_model->getRowData(['id' => $vendor_id], 'vendor');
        $data['brand'] = $this->Vendor_model->getData(['status' => 1], 'brand', '', 'id', 'ASC');

        $category = $this->Vendor_model->getData(['parent_id' => 0, 'status' => 1], 'category', '', 'id', 'ASC');
        $cat_attributes = $this->Vendor_model->getData([], 'category_attribute', '', 'id', 'ASC');


        $categoryArr = [];
        foreach ($category as $category1) {
            $subcategory = $this->Vendor_model->getData(['parent_id' => $category1['id'], 'status' => 1], 'category', '', 'id', 'ASC');
            $category1['subCategory'] = $subcategory;
            array_push($categoryArr, $category1);
        }
        $data['subcategory'] = json_encode($categoryArr);
        $data['category'] = $categoryArr;


        $cAttr = [];
        foreach ($categoryArr as $categoryAttr) {
            $subAttr = [];
            foreach ($categoryAttr['subCategory'] as $subCategoryAttr) {
                $catAtt = $this->Vendor_model->getData(['sub_category_id' => $subCategoryAttr['id']], 'category_attribute', '', 'id', 'ASC');
                $catAtt_ValArr = [];
                foreach ($catAtt as $catAtt_Val) {
                    $catAttri_val = $this->Vendor_model->getData(['attribute_id' => $catAtt_Val['id']], 'category_attribute_value', '', 'id', 'ASC');
                    $catAtt_Val['catAttri_val'] = $catAttri_val;
                    array_push($catAtt_ValArr, $catAtt_Val);
                }
                $subCategoryAttr['catAtt'] = $catAtt_ValArr;
                array_push($subAttr, $subCategoryAttr);
            }
            array_push($cAttr, $subAttr);
        }
        //echo '<pre>';print_r($cAttr);exit;


        $catAttArr = [];
        foreach ($catAtt as $catAttribute) {
            $cat_att = $this->Vendor_model->getData(['id' => $catAttribute['sub_category_id']], 'category', '', 'id', 'ASC');
            $catAttribute['cat_att'] = $cat_att;
            array_push($catAttArr, $catAttribute);
        }


        $cat_att_val = $this->Vendor_model->getData([], 'category_attribute_value', '', 'id', 'ASC');
        $catAttValArr = [];
        foreach ($cat_att_val as $catAttValu) {
            $cat_att_val = $this->Vendor_model->getData(['id' => $catAttValu['attribute_id']], 'category_attribute', '', 'id', 'ASC');
            $catAttValu['cat_att_val'] = $cat_att_val;
            array_push($catAttValArr, $catAttValu);
        }

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('category', 'Product Category', 'required');
        $this->form_validation->set_rules('sub_categorys', 'Product Sub Category', 'required');
        $this->form_validation->set_rules('brand', 'Brand name', 'required');
        $this->form_validation->set_rules('price', 'Product Price', 'required');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'required|numeric');
        $this->form_validation->set_rules('discount', 'Total Discount', 'numeric');


        if ($this->form_validation->run() == False) {
            $data['view_link'] = 'products/add_product';
            $this->load->view('include/template', $data);
        } else {
//            echo '<pre>';
//            print_r($_POST);
//            exit;
            $insertArr = [
                'name' => $this->input->post('product_name'),
                'category_id' => $this->input->post('category'),
                'vendor_id' => $vendor_id,
                'sub_category_id' => $this->input->post('sub_categorys'),
                'brand_id' => $this->input->post('brand'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'discount' => $this->input->post('discount'),
                'description' => $this->input->post('description'),
                'latitude' => $vendor['lat'],
                'longitude' => $vendor['lng'],
                'status' => 0,
                'created_at' => time()
            ];
            $image = [];
//            print_r($_FILES);
            if (!empty($_FILES['file_upload']['name'])) {

                foreach ($_FILES['file_upload']['name'] as $key => $file) {
                    if ($file) {
                        $file_ext = explode('.', $file);
                        $uploadPath = 'uploads/products/';
                        $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

                        if (move_uploaded_file($_FILES['file_upload']['tmp_name'][$key], $uploadPath . $uploadFile)) {
                            $insertTmgArr = [
                                'file_path' => base_url() . $uploadPath,
                                'file_name' => $uploadFile,
                                'file_type' => $file_ext[1]
                            ];
                            $returnId = $this->Vendor_model->addData('files', $insertTmgArr);
                            array_push($image, $returnId);
                        }
                    }
                }
            }
            $insertArr['images'] = trim(implode(',', $image), ',');
            $returnData = $this->Vendor_model->addData('products', $insertArr);
            if ($returnData) {
                if ($this->input->post('attribute_id')) {
                    foreach ($this->input->post('attribute_id') as $attribute_id) {
                        if ($this->input->post('attribute_value_' . $attribute_id) != "") {
                            $insert = ['product_id' => $returnData, 'category_id' => $this->input->post('category'), 'sub_category_id' => $this->input->post('sub_categorys'), 'attribute_id' => $attribute_id, 'attribute_value_id' => $this->input->post('attribute_value_' . $attribute_id)];
                            $returnDataAttribute = $this->Vendor_model->addData('product_attribute', $insert);
                        }
                    }
                }
                if ($this->input->post('specifications')) {
                    foreach ($this->input->post('specifications') as $specification) {
                        if ($this->input->post('specification_value_' . $specification) != "") {
                            $insert_s = ['product_id' => $returnData, 'attribute_id' => $specification, 'value' => $this->input->post('specification_value_' . $specification)];
                            $returnDataSpecification = $this->Vendor_model->addData('product_specification', $insert_s);
                        }
                    }
                }
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Product added successfully</div>');
                redirect('vendor/product-list');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While adding new product</div>');
                redirect('vendor/add-product');
            }
        }
    }

    function upload_file($img_name, $uploadPath, $type) {

//print_r($img_name);exit;
        if (!empty($_FILES[$img_name]['name'])) {
            $file_ext = explode('.', $_FILES[$img_name]['name']);

            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], '.' . $uploadPath . $uploadFile)) {
                $insertArr = [
                    'file_path' => base_url() . $uploadPath,
                    'file_name' => $uploadFile,
                    'file_type' => $file_ext[1]
                ];
                if ($type == 2) {
                    $returnId = $this->Admin_model->addFile($insertArr);
                    $returnArr = ['id' => $returnId, 'url' => base_url() . $uploadPath . $uploadFile];
                } else {
                    $returnArr = ['id' => 0, 'url' => base_url() . $uploadPath . $uploadFile];
                }
            } else {
                $returnArr = [];
            }
        } else {
            $returnArr = [];
        }

        return $returnArr;
    }

    public function upload_img($img_name, $uploadPath) {
//print_r($_FILES[$img_name]);exit;
        if (!empty($_FILES[$img_name]['name'])) {

            $file_ext = explode('.', $_FILES[$img_name]['name']);
            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {

                $result = base_url() . $uploadPath . $uploadFile;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

    function my_random_string($char) {
        $characters = $char;
        $length = 20;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function edit_product() {
        $product_id = $this->uri->segment(3);
        $vendor_id = $this->vendor_data['vendor_id'];
        $product = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'product_id' => $product_id, 'status!=' => 99], 'products');
        $feature = $this->Vendor_model->getProductFeatures(['product_id' => $product_id]);
        $specification = $this->Vendor_model->getProductSpecification(['product_id' => $product_id]);
        if ($product) {
            $imageArr = [];
            $images = explode(',', $product['images']);
            foreach ($images as $img) {
                $image = $this->Vendor_model->getRowData(['id' => $img], 'files');
                if ($image) {
                    array_push($imageArr, $image);
                }
            }
            $product['image'] = $imageArr;
            if ($feature) {
                $product['feature'] = $feature;
            } else {
                $product['feature'] = [];
            }
            if ($specification) {
                $product['specification'] = $specification;
            } else {
                $product['specification'] = [];
            }
            $attrlist = [];
            $subcategory_attributes = $this->Vendor_model->getData(['status' => 1, 'sub_category_id' => $product['sub_category_id'], 'type' => 1], 'category_attribute', '', 'id', '');
            foreach ($subcategory_attributes as $attr) {
                $s_attribute_values = $this->Vendor_model->getData(['status' => 1, 'attribute_id' => $attr['id']], 'category_attribute_value', '', 'id', '');
                $attr['values'] = $s_attribute_values;
                array_push($attrlist, $attr);
            }
            $subcategory_specifictation = $this->Vendor_model->getData(['status' => 1, 'sub_category_id' => $product['sub_category_id'], 'type' => 2], 'category_attribute', '', 'id', '');

            $data['attributes'] = $attrlist;
            $data['specification'] = $subcategory_specifictation;
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Product not found.</div>');
            redirect('vendor/product-list');
        }

        $data['product'] = $product;
        $data['brand'] = $this->Vendor_model->getData(['status' => 1], 'brand', '', 'id', 'ASC');

        $category = $this->Vendor_model->getData(['parent_id' => 0], 'category', '', 'id', 'ASC');
        $cat_attributes = $this->Vendor_model->getData([], 'category_attribute', '', 'id', 'ASC');
        $categoryArr = [];
        foreach ($category as $category1) {
            $subcategory = $this->Vendor_model->getData(['parent_id' => $category1['id']], 'category', '', 'id', 'ASC');
            $category1['subCategory'] = $subcategory;
            array_push($categoryArr, $category1);
        }
        $data['subcategory'] = json_encode($categoryArr);
        $data['category'] = $categoryArr;

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('category', 'Product Category', 'required');
        $this->form_validation->set_rules('sub_categorys', 'Product Sub Category', 'required');
        $this->form_validation->set_rules('brand', 'Brand name', 'required');
        $this->form_validation->set_rules('price', 'Product Price', 'required');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'numeric');
        $this->form_validation->set_rules('discount', 'Total Discount', 'numeric');


        if ($this->form_validation->run() == False) {
            $data['view_link'] = 'products/edit_product';
            $this->load->view('include/template', $data);
        } else {
            $insertArr = [
                'name' => $this->input->post('name'),
                'category_id' => $this->input->post('category'),
                'sub_category_id' => $this->input->post('sub_categorys'),
                'brand_id' => $this->input->post('brand'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'discount' => $this->input->post('discount'),
                'description' => $this->input->post('description'),
                'updated_at' => time()
            ];

//            print_r($_FILES);
            if (!empty($_FILES['file_upload']['name'])) {

                foreach ($_FILES['file_upload']['name'] as $key => $file) {
                    if ($file) {
                        $file_ext = explode('.', $file);
                        $uploadPath = 'uploads/products/';
                        $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

                        if (move_uploaded_file($_FILES['file_upload']['tmp_name'][$key], $uploadPath . $uploadFile)) {
                            $insertTmgArr = [
                                'file_path' => base_url() . $uploadPath,
                                'file_name' => $uploadFile,
                                'file_type' => $file_ext[1]
                            ];
                            $returnId = $this->Vendor_model->addData('files', $insertTmgArr);
                            if (isset($images[$key])) {
                                $images[$key] = $returnId;
                            } else {
                                array_push($images, $returnId);
                            }
                        }
                    }
                }
            }
            $insertArr['images'] = trim(implode(',', $images), ',');
            $returnData = $this->Vendor_model->updateData(['product_id' => $product_id], 'products', $insertArr);
            if ($returnData) {
                if ($this->input->post('attribute_id')) {
                    $this->Vendor_model->deleteDataTable('product_attribute', ['product_id' => $product_id]);
                    foreach ($this->input->post('attribute_id') as $attribute_id) {
                        if ($this->input->post('attribute_value_' . $attribute_id) != "") {
                            $insert = ['product_id' => $product_id, 'category_id' => $this->input->post('category'), 'sub_category_id' => $this->input->post('sub_categorys'), 'attribute_id' => $attribute_id, 'attribute_value_id' => $this->input->post('attribute_value_' . $attribute_id)];
                            $returnDataAttribute = $this->Vendor_model->addData('product_attribute', $insert);
                        }
                    }
                }
                if ($this->input->post('specifications')) {
                    $this->Vendor_model->deleteDataTable('product_specification', ['product_id' => $product_id]);
                    foreach ($this->input->post('specifications') as $p_specification) {
                        if ($this->input->post('specification_value_' . $p_specification) != "") {
                            $insert_s = ['product_id' => $product_id, 'attribute_id' => $p_specification, 'value' => $this->input->post('specification_value_' . $p_specification)];
                            $returnDataSpecification = $this->Vendor_model->addData('product_specification', $insert_s);
                        }
                    }
                }
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Product updated successfully</div>');
                redirect('vendor/product-detail/' . $product_id);
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While updating product</div>');
                redirect('vendor/edit-product');
            }
        }
    }

    public function subscription_plan() {
//        $vendor_id = $this->vendor_data['vendor_id'];
        $data['plans'] = $this->Vendor_model->getData(['status' => 1], 'subscription_plan', '', 'id', 'DESC');
        $data['view_link'] = 'subscription/subscription_plan';
        $this->load->view('include/template', $data);
    }

    public function advertisement_list() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $data['ads'] = $this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'slider', '', 'id', 'DESC');
        $data['view_link'] = 'ad_mngt/ad_list';
        $this->load->view('include/template', $data);
    }

    public function advertisement_detail() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $id = $this->uri->segment(3);
        $ad = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'id' => $id], 'slider', '', 'id', 'DESC');
        if ($ad) {
            $data['ad'] = $ad;
            $data['view_link'] = 'ad_mngt/ad_detail';
            $this->load->view('include/template', $data);
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement not found.</div>');
            redirect('vendor/advertisement-list');
        }
    }

    public function add_advertisement() {
        $vendor_id = $this->vendor_data['vendor_id'];

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Advertisement Name', 'required');
        $this->form_validation->set_rules('description', 'Advertisement Description', 'required');
        if ($this->form_validation->run() == False) {
//        $vendor_id = $this->vendor_data['vendor_id'];
            // $data['plans'] = $this->Vendor_model->getData(['status' => 1], 'subscription_plan', '', 'id', 'DESC');
            $data['view_link'] = 'ad_mngt/add_ad';
            $this->load->view('include/template', $data);
        } else {
            $insertArr = [
                'vendor_id' => $vendor_id,
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'status' => 0,
                'checked' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $image = $this->upload_file('file_upload', '/uploads/brand/', 1);
            //print_r($image) ;exit;
            if ($image) {
                $insertArr['image'] = $image['url'];
            }
            $returnData = $this->Vendor_model->addData('slider', $insertArr);
            if ($returnData) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement added successfully</div>');
                redirect('vendor/advertisement-list');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While adding new advertisement</div>');
                redirect('vendor/add-advertisement');
            }
        }
    }

    public function edit_advertisement() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $id = $this->uri->segment(3);
        $ad = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'id' => $id], 'slider', '', 'id', 'DESC');
        if ($ad) {
            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
            $this->form_validation->set_rules('name', 'Advertisement Name', 'required');
            $this->form_validation->set_rules('description', 'Advertisement Description', 'required');
            if ($this->form_validation->run() == False) {
//        $vendor_id = $this->vendor_data['vendor_id'];
                // $data['plans'] = $this->Vendor_model->getData(['status' => 1], 'subscription_plan', '', 'id', 'DESC');
                $data['ad'] = $ad;
                $data['view_link'] = 'ad_mngt/edit_ad';
                $this->load->view('include/template', $data);
            } else {
                $insertArr = [
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                ];

                $image = $this->upload_file('file_upload', '/uploads/brand/', 1);
                if ($image) {
                    $insertArr['image'] = $image['url'];
                } else {
                    $insertArr['image'] = $ad['image'];
                }
                $returnData = $this->Vendor_model->updateData(['id' => $id], 'slider', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement updated successfully</div>');
                    redirect('vendor/advertisement-detail/' . $id);
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While updating Advertisement</div>');
                    redirect('vendor/edit-advertisement');
                }
            }
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement not found.</div>');
            redirect('vendor/advertisement-list');
        }
    }

    public function service_list() {
        $services = $this->Vendor_model->getData(['status !=' => 99, 'vendor_id' => $this->vendor_data['vendor_id']], 'service', '', 'service_id', 'DESC');
        $serviceList = [];
        foreach ($services as $service) {
            $category = $this->Vendor_model->getRowData(['id' => $service['category_id']], 'service_category');
            if ($category) {
                $service['category_name'] = $category['name'];
            } else {
                $service['category_name'] = '';
            }
            array_push($serviceList, $service);
        }
        $data['services'] = $serviceList;
        $data['view_link'] = 'services/service_list';
        $this->load->view('include/template', $data);
    }

    public function service_detail() {
        $id = $this->uri->segment(3);
        $service = $this->Vendor_model->getRowData(['status !=' => 99, 'vendor_id' => $this->vendor_data['vendor_id'], 'service_id' => $id], 'service');

        if ($service) {
            $plans = $this->Vendor_model->getServicePlanData(['sd.service_id' => $service['service_id']]);
            $category = $this->Vendor_model->getRowData(['id' => $service['category_id']], 'service_category');
            if ($category) {
                $service['category_name'] = $category['name'];
            } else {
                $service['category_name'] = '';
            }
            $images = explode(',', $service['images']);
            $service_imgs = [];
            foreach ($images as $image) {
                $img = $this->Vendor_model->getRowData(['id' => $image], 'files');
                if ($img) {
                    $url['url'] = $img['file_path'] . $img['file_name'];
                    array_push($service_imgs, $url);
                }
            }
            $service['plans'] = $plans;
            $service['service_images'] = $service_imgs;
            $data['service'] = $service;
            $data['view_link'] = 'services/service_detail';
            $this->load->view('include/template', $data);
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service not found.</div>');
            redirect('vendor/service-list');
        }
    }

    public function add_service() {
        $category = $this->Vendor_model->getData(['parent_id' => 0, 'status' => 1], 'service_category', '', 'id', 'ASC');
        $plan = $this->Vendor_model->getData(['status' => 1], 'service_plan', '', 'plan_id', 'ASC');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Service Name', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('name', 'Service Name', 'required');
        $this->form_validation->set_rules('service_price', 'Service Price', 'required');
        $this->form_validation->set_rules('service_plan_id', 'Service Plan', 'required');
        $this->form_validation->set_rules('service_description', 'Service Description', 'required');
        if ($this->form_validation->run() == False) {
            $data['category'] = $category;
            $data['service_plan'] = $plan;
            $data['view_link'] = 'services/add_service';
            $this->load->view('include/template', $data);
        } else {
//            echo '<pre>';
//            print_r($_POST);
//            exit;
            $insertArr = [
                'vendor_id' => $this->vendor_data['vendor_id'],
                'category_id' => $this->input->post('category_id'),
                'name' => $this->input->post('name'),
                'short_description' => $this->input->post('short_description'),
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $image = [];
//            print_r($_FILES);
            if (!empty($_FILES['file-upload']['name'])) {

                foreach ($_FILES['file-upload']['name'] as $key => $file) {
                    if ($file) {
                        $file_ext = explode('.', $file);
                        $uploadPath = 'uploads/service/';
                        $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

                        if (move_uploaded_file($_FILES['file-upload']['tmp_name'][$key], $uploadPath . $uploadFile)) {
                            $insertTmgArr = [
                                'file_path' => base_url() . $uploadPath,
                                'file_name' => $uploadFile,
                                'file_type' => $file_ext[1]
                            ];
                            $returnId = $this->Vendor_model->addData('files', $insertTmgArr);
                            array_push($image, $returnId);
                        }
                    }
                }
            }
            $insertArr['images'] = trim(implode(',', $image), ',');
            $returnData = $this->Vendor_model->addData('service', $insertArr);
            if ($returnData) {
                $service_plan_detail = [
                    'service_id' => $returnData,
                    'service_plan_id' => $this->input->post('service_plan_id'),
                    'price' => $this->input->post('service_price'),
                    'description' => $this->input->post('service_description'),
                ];
                $return = $this->Vendor_model->addData('service_detail', $service_plan_detail);
                if ($this->input->post('plan_id')) {
                    foreach ($this->input->post('plan_id') as $key => $plan) {
                        if ($_POST['price'][$key] != '') {
                            $plan_detail = [
                                'service_id' => $returnData,
                                'service_plan_id' => $plan,
                                'price' => $_POST['price'][$key],
                                'description' => $_POST['description'][$key]
                            ];
                            $return = $this->Vendor_model->addData('service_detail', $plan_detail);
                        }
                    }
                }
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service added successfully</div>');
                redirect('vendor/service-list');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While adding new Service</div>');
                redirect('vendor/add-service');
            }
        }
    }

    public function edit_service() {
        $id = $this->uri->segment(3);
        $categorylist = $this->Vendor_model->getData(['parent_id' => 0, 'status' => 1], 'service_category', '', 'id', 'ASC');
        $plan = $this->Vendor_model->getData(['status' => 1], 'service_plan', '', 'plan_id', 'ASC');
        $service = $this->Vendor_model->getRowData(['status !=' => 99, 'vendor_id' => $this->vendor_data['vendor_id'], 'service_id' => $id], 'service');
        if ($service) {
            $plans = $this->Vendor_model->getServicePlanData(['sd.service_id' => $service['service_id']]);
            $category = $this->Vendor_model->getRowData(['id' => $service['category_id']], 'service_category');
            if ($category) {
                $service['category_name'] = $category['name'];
            } else {
                $service['category_name'] = '';
            }
            $images = explode(',', $service['images']);
            $service_imgs = [];
            foreach ($images as $image) {
                $img = $this->Vendor_model->getRowData(['id' => $image], 'files');
                if ($img) {
                    $url['url'] = $img['file_path'] . $img['file_name'];
                    array_push($service_imgs, $url);
                }
            }
            $service['plans'] = $plans;
            $service['service_images'] = $service_imgs;
            $data['service'] = $service;

            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
            $this->form_validation->set_rules('name', 'Service Name', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            $this->form_validation->set_rules('name', 'Service Name', 'required');
            $this->form_validation->set_rules('service_price', 'Service Price', 'required');
            $this->form_validation->set_rules('service_plan_id', 'Service Plan', 'required');
            $this->form_validation->set_rules('service_description', 'Service Description', 'required');
            if ($this->form_validation->run() == False) {
                $data['category'] = $categorylist;
                $data['service_plan'] = $plan;
                $data['view_link'] = 'services/edit_service';
                $this->load->view('include/template', $data);
            } else {
//                echo '<pre>';
//                print_r($_FILES);
//                exit;
                $insertArr = [
                    'category_id' => $this->input->post('category_id'),
                    'name' => $this->input->post('name'),
                    'short_description' => $this->input->post('short_description')
                ];
                if (!empty($_FILES['file-upload']['name'])) {

                    foreach ($_FILES['file-upload']['name'] as $key => $file) {
                        if ($file) {
                            $file_ext = explode('.', $file);
                            $uploadPath = 'uploads/service/';
                            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

                            if (move_uploaded_file($_FILES['file-upload']['tmp_name'][$key], $uploadPath . $uploadFile)) {
                                $insertTmgArr = [
                                    'file_path' => base_url() . $uploadPath,
                                    'file_name' => $uploadFile,
                                    'file_type' => $file_ext[1]
                                ];
                                $returnId = $this->Vendor_model->addData('files', $insertTmgArr);
                                if (isset($images[$key])) {
                                    $images[$key] = $returnId;
                                } else {
                                    array_push($images, $returnId);
                                }
                            }
                        }
                    }
                }
                $insertArr['images'] = trim(implode(',', $images), ',');
//                echo '<pre>';
//                print_r($insertArr);
//                exit;
                $returnData = $this->Vendor_model->updateData(['service_id' => $id], 'service', $insertArr);
                if ($returnData) {
                    $deleteData = $this->Vendor_model->deleteDataTable('service_detail', ['service_id' => $id]);
                    $service_plan_detail = [
                        'service_id' => $id,
                        'service_plan_id' => $this->input->post('service_plan_id'),
                        'price' => $this->input->post('service_price'),
                        'description' => $this->input->post('service_description'),
                    ];
                    $return = $this->Vendor_model->addData('service_detail', $service_plan_detail);
                    if ($this->input->post('plan_id')) {
                        foreach ($this->input->post('plan_id') as $key => $plan) {
                            if ($_POST['price'][$key] != '') {
                                $plan_detail = [
                                    'service_id' => $id,
                                    'service_plan_id' => $plan,
                                    'price' => $_POST['price'][$key],
                                    'description' => $_POST['description'][$key]
                                ];
                                $return = $this->Vendor_model->addData('service_detail', $plan_detail);
                            }
                        }
                    }
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service updated successfully</div>');
                    redirect('vendor/service-detail/' . $id);
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While updating new Service</div>');
                    redirect('vendor/edit-service/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service not found.</div>');
            redirect('vendor/service-list');
        }
    }

    public function order_list() {
        $order = $this->Vendor_model->getOrder(['o.status!=' => 0])->result_array();
        $data['orders'] = $order;
        $data['view_link'] = 'orders/order_list';
        $this->load->view('include/template', $data);
    }

    public function order_detail() {
        $id = $this->uri->segment(3);
        $order = $this->Vendor_model->getOrder(['o.order_id' => $id, 'o.status!=' => 0])->row_array();
        if ($order) {
            $order_items = $this->Vendor_model->getOrderItems(['ot.order_id' => $id, 'ot.vendor_id' => $this->vendor_data['vendor_id']]);
            $order['items'] = $order_items;
            $data['order'] = $order;
            $data['view_link'] = 'orders/order_detail';
            $this->load->view('include/template', $data);
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Order Not Found</div>');
            redirect('vendor/order-list');
        }
    }

    public function booking_list() {
        $order = $this->Vendor_model->getBooking(['b.status!=' => 0, 's.vendor_id' => $this->vendor_data['vendor_id']])->result_array();
        $data['orders'] = $order;
        $data['view_link'] = 'bookings/booking_list';
        $this->load->view('include/template', $data);
    }

    public function booking_detail() {
        $id = $this->uri->segment(3);
        $order = $this->Vendor_model->getBooking(['b.status!=' => 0, 'b.booking_id' => $id, 's.vendor_id' => $this->vendor_data['vendor_id']])->row_array();
        if ($order) {
            $data['order'] = $order;
            $data['view_link'] = 'bookings/booking_detail';
            $this->load->view('include/template', $data);
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Order Not Found</div>');
            redirect('vendor/booking-list');
        }
    }

    public function about_us() {
        $data['view_link'] = 'about_us';
        $this->load->view('include/template', $data);
    }

    public function privacy_policy() {
        $data['view_link'] = 'privacy_policy';
        $this->load->view('include/template', $data);
    }

    public function terms_condition() {
        $data['view_link'] = 'terms_condition';
        $this->load->view('include/template', $data);
    }

    public function ajax() {
        $this->load->view('ajax_server');
    }

}

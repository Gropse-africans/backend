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
        }
    }

    public function index() {
        $this->load->view('index');
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
        $data['products'] = count($this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '', 'product_id', 'DESC'));
        $data['recent_products'] = $this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '5', 'product_id', 'DESC');
        $data['view_link'] = 'dashboard';
        $this->load->view('include/template', $data);
    }

    public function complete_profile() {
        $this->load->view('complete_profile');
    }

    public function shop_banner() {
        $this->load->view('shop_banner');
    }

    public function product_list() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $data['products'] = $this->Vendor_model->getData(['vendor_id' => $vendor_id, 'status!=' => 99], 'products', '', 'product_id', 'DESC');
        $data['view_link'] = 'product_list';
        $this->load->view('include/template', $data);
    }

    public function product_detail() {
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
        $data['view_link'] = 'product_detail';
        $this->load->view('include/template', $data);
    }

    public function add_product() {
        $vendor_id = $this->vendor_data['vendor_id'];
        $vendor = $this->Vendor_model->getRowData(['id' => $vendor_id], 'vendor');
        $data['brand'] = $this->Vendor_model->getData(['status' => 1], 'brand', '', 'id', 'ASC');

        $category = $this->Vendor_model->getData(['parent_id' => 0,'status'=>1], 'category', '', 'id', 'ASC');
        $cat_attributes = $this->Vendor_model->getData([], 'category_attribute', '', 'id', 'ASC');


        $categoryArr = [];
        foreach ($category as $category1) {
            $subcategory = $this->Vendor_model->getData(['parent_id' => $category1['id'],'status'=>1], 'category', '', 'id', 'ASC');
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
            $data['view_link'] = 'add_product';
            $this->load->view('include/template', $data);
        } else {
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
                        $insert = ['product_id' => $returnData, 'category_id' => $this->input->post('category'), 'sub_category_id' => $this->input->post('sub_categorys'), 'attribute_id' => $attribute_id, 'attribute_value_id' => $this->input->post('attribute_value_' . $attribute_id)];
                        $returnDataAttribute = $this->Vendor_model->addData('product_attribute', $insert);
                    }
                }
                if ($this->input->post('specifications')) {
                    foreach ($this->input->post('specifications') as $specification) {
                        $insert_s = ['product_id' => $returnData, 'attribute_id' => $specification, 'value' => $this->input->post('specification_value_' . $specification)];
                        $returnDataSpecification = $this->Vendor_model->addData('product_specification', $insert_s);
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

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], '.'.$uploadPath . $uploadFile)) { 
                $insertArr = [
                    'file_path' => base_url() . $uploadPath,
                    'file_name' => $uploadFile,
                    'file_type' => $file_ext[1],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
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

    // public function add_images(){
    // 			$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
    //       			$this->form_validation->set_rules('file_upload1','Upload Image','required');
    //       			if($this->form_validation->run() == False){
    //       				$this->load->view('add_product');
    //       			}else{
    //       				$path       = "uploads/vendor/";
    // 	        $file_tmp   = $_FILES['file_upload1']['tmp_name'];
    // 	        $file_ext   = explode('.',$_FILES['file_upload1']['name']);
    // 	        $file_name  = $file_ext[0].time().'.'.$file_ext[1];
    // 	          if (move_uploaded_file($file_tmp,$path.$file_name)) {
    // 	                 $personal_photo=base_url().$path.$file_name;
    // 	          } else {
    // 	                 $personal_photo='';
    // 	          }
    //         	$insertArr = [
    //         		'file_path' => base_url().$path,
    //         		'file_name' => base_url().$path.$file_name,
    //         		'file_type' => $file_ext
    //         	];
    //         	print_r($insertArr);exit;
    //         	$resultData = $this->Vendor_model->addData('files',$insertArr);
    //         	if($resultData){
    //         		echo "yes";
    //         	}else{
    //         		echo "no";
    //         	}
    //        	}
    // }

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
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Product not found.</div>');
            redirect('vendor/product-list');
        }
        // print_r($product);exit;
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
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('category', 'Product Category', 'required');
        $this->form_validation->set_rules('sub_categorys', 'Product Sub Category', 'required');
        $this->form_validation->set_rules('brand', 'Brand name', 'required');
        $this->form_validation->set_rules('price', 'Product Price', 'required');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'numeric');
        $this->form_validation->set_rules('discount', 'Total Discount', 'numeric');


        if ($this->form_validation->run() == False) {
            //   print_r($_POST);
            // exit;
            $data['view_link'] = 'edit_product';
            $this->load->view('include/template', $data);
        } else {
            // print_r($_POST);
            // exit;
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
                // if ($this->input->post('attribute_id')) {
                //     foreach ($this->input->post('attribute_id') as $attribute_id) {
                //         $insert = ['product_id' => $returnData, 'category_id' => $this->input->post('category'), 'sub_category_id' => $this->input->post('sub_categorys'), 'attribute_id' => $attribute_id, 'attribute_value_id' => $this->input->post('attribute_value_' . $attribute_id)];
                //         $returnDataAttribute = $this->Vendor_model->addData('product_attribute', $insert);
                //     }
                // }
                // if ($this->input->post('specifications')) {
                //     foreach ($this->input->post('specifications') as $specification) {
                //         $insert_s = ['product_id' => $returnData, 'attribute_id' => $specification, 'value' => $this->input->post('specification_value_' . $specification)];
                //         $returnDataSpecification = $this->Vendor_model->addData('product_specification', $insert_s);
                //     }
                // }
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
        $data['view_link'] = 'subscription_plan';
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
                $data['ad']=$ad;
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
                }else{
                    $insertArr['image']=$ad['image'];
                }
                $returnData = $this->Vendor_model->updateData(['id'=>$id],'slider', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement added successfully</div>');
                    redirect('vendor/advertisement-detail/'.$id);
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error While adding new advertisement</div>');
                    redirect('vendor/edit-advertisement');
                }
            }
        } else {
            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Advertisement not found.</div>');
            redirect('vendor/advertisement-list');
        }
    }

    public function order_list() {
        $this->load->view('order_list');
    }

    public function order_detail() {
        $this->load->view('order_detail');
    }

    public function ajax() {
        $this->load->view('ajax_server');
    }

}

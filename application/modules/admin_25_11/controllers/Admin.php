<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_model'));
        if (!$this->session->userdata('af_s_m_admin_logged_in')) {
            redirect('admin');
        }
    }

    public function index() {
        $data['users'] = $this->Admin_model->getTableDataArray('users', 'status!=99', 'id', '5');
        $users_count = $this->Admin_model->getTableDataArray('users', 'status!=99', 'id', '');
        if($users_count){
            $data['users_count']=count($users_count);
        }else{
            $data['users_count']=0;
        }
        $data['vendor'] = $this->Admin_model->getTableDataArray('vendor', 'status!=99', 'id', '5');
        $vendor_count = $this->Admin_model->getTableDataArray('vendor', 'status!=99', 'id', '');
        if($vendor_count){
            $data['vendor_count']=count($vendor_count);
        }else{
            $data['vendor_count']=0;
        }
        $data['view_link'] = 'dashboard';
        $this->load->view('layout/template', $data);
    }

    public function user_list() {
        $data['users'] = $this->Admin_model->getTableDataArray('users', 'status!=99', 'id', '');
        $data['view_link'] = 'user/index';
        $this->load->view('layout/template', $data);
    }
    

    public function user_detail() {
        $id = $this->uri->segment(3);
        $user = $this->Admin_model->getSingleDataRow('users','id="'.$id.'" and status!=99');
        if($user){
            $data['user'] = $user;
            $data['order'] = array();
            $data['view_link'] = 'user/detail';
            $this->load->view('layout/template', $data);
        }else{
            echo '<script>alert("User not exist");</script>';
            echo '<script>window.location.href="'.base_url("admin/user-list").'"</script>';
        }
    }
    
    public function vendor_list() {
        $data['users'] = $this->Admin_model->getTableDataArray('vendor', 'status!=99', 'id', '');
        $data['view_link'] = 'vendor/index';
        $this->load->view('layout/template', $data);
    }
    
    public function vendor_detail() {
        $id = $this->uri->segment(3);
        $user = $this->Admin_model->getSingleDataRow('vendor','id="'.$id.'" and status!=99');
        if($user){
            if(isset($_POST['imgBtn'])){
                if(($_FILES['image']['name'])){
                    $uploadImage = $this->Admin_model->upload_file('image', 'user');
                    if ($uploadImage) {
                        $insertArr['image'] = base_url() . $uploadImage;
                        $returnData = $this->Admin_model->updatedataTable('vendor','id="'.$id.'"', $insertArr);
                    }
                }
                redirect('admin/vendor-detail/'.$id);
            }else{
                $data['product'] = $this->Admin_model->getTableDataArray('products', 'vendor_id="'.$id.'" and status!=99', 'product_id', '10');
                $product_count = $this->Admin_model->getTableDataArray('products', 'vendor_id="'.$id.'" and status!=99', 'product_id', '');
                $data['product_count'] = count($product_count);
                $data['user'] = $user;
                $data['view_link'] = 'vendor/detail';
                $this->load->view('layout/template', $data);
            }
        }else{
            echo '<script>alert("Vendor not exist");</script>';
            echo '<script>window.location.href="'.base_url("admin/vendor-list").'"</script>';
        }
    }

    public function verify_product_list() {
        $data['product'] = $this->Admin_model->getTableDataArray('products', 'status=1', 'product_id', '');
        $data['view_link'] = 'product/index';
//        echo '<pre/>';        print_r($data);exit;
        $this->load->view('layout/template', $data);
    }
    
    public function unverify_product_list() {
        $data['product'] = $this->Admin_model->getTableDataArray('products', 'status=0', 'product_id', '');
        $data['view_link'] = 'product/unverify_product_list';
//        echo '<pre/>';        print_r($data);exit;
        $this->load->view('layout/template', $data);
    }
    public function product_detail() {
        $id = $this->uri->segment(3);
        $product = $this->Admin_model->getSingleDataRow('products','product_id="'.$id.'" and status!=99');
        if($product){
            $category       = $this->Admin_model->getSingleDataRow('category','id="'.$product['category_id'].'"');
            $product['category']=$category['name'];
            $sub_category   = $this->Admin_model->getSingleDataRow('category','id="'.$product['sub_category_id'].'"');
            $product['sub_category']=$sub_category['name'];
            $imgArr=array();
            if($product['images']){
                $product['images']= ltrim($product['images'],',');
                $product['images']= rtrim($product['images'],',');
                $expArr=explode(',',$product['images']);
                if($expArr){
                    foreach($expArr as $val){
                        $files = $this->Admin_model->getSingleDataRow('files','id="'.$val.'"');
                        if($files){
                            $arr['id']=$files['id'];
                            $arr['image']=$files['file_path'].$files['file_name'];
                            array_push($imgArr,$arr);
                        }
                    }
                }
            }
            $product['images']=$imgArr;
            $data['product'] = $product;
//            echo '<pre/>';print_r($data);exit;
            $data['view_link'] = 'product/detail';
            $this->load->view('layout/template', $data);
        }else{
            echo '<script>alert("Product not exist");</script>';
            echo '<script>window.location.href="'.base_url("admin/verify-product-list").'"</script>';
        }
    }
    
    
    
    
    
    
    
    
    
    public function category() {
        $category = $this->Admin_model->getTableDataArray('category', 'parent_id=0 and status!=99', 'id', '');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Category Name', 'required');


        if ($this->form_validation->run() == False) {
            $data['categories'] = $category;
            $data['view_link'] = 'category/index';
            $this->load->view('layout/template', $data);
        } else {
            if (($_FILES['image']['name'])) {
                $uploadImage = $this->Admin_model->upload_file('image', 'category');
                //print_r($uploadImage);exit;
                if ($uploadImage) {
                    $insertArr = [
                        'parent_id' => 0,
                        'name' => ucwords($this->input->post('name')),
                        'image' => base_url() . $uploadImage,
                        'status' => '1',
                        'created_at' => time()
                    ];
                    $returnData = $this->Admin_model->insertDataTable('category', $insertArr);
                    if ($returnData) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                        redirect('admin/category');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error while adding Category</div>');
                        redirect('admin/category');
                    }
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Image Not Uploaded.</div>');
                    redirect('admin/category');
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Image Not Uploaded.</div>');
                redirect('admin/category');
            }
        }
    }
    public function edit_category() {
        $id = $this->uri->segment(3);
        $singleCategory = $this->Admin_model->getSingleDataRow('category', 'id="'.$id.'" and parent_id=0');
        if($singleCategory){
            $category = $this->Admin_model->getTableDataArray('category', 'parent_id=0 and status!=99', 'id', '');
            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
            $this->form_validation->set_rules('name', 'Category Name', 'required');
            if ($this->form_validation->run() == False) {
            $data['categories'] = $category;
            $data['singleCategory'] = $singleCategory;
            $data['view_link'] = 'category/index';
//            echo '<pre/>';print_r($data);exit;
            $this->load->view('layout/template', $data);
        } else {
            $insertArr = [
                'name' => ucwords($this->input->post('name')),
            ];
            if (($_FILES['image']['name'])) {
                    $uploadImage = $this->Admin_model->upload_file('image', 'category');
                    if ($uploadImage) {
                        $insertArr['image'] = base_url() . $uploadImage;
                    }
                }
                //print_r($insertArr);exit;
                $returnData = $this->Admin_model->updatedataTable('category','id="'.$id.'"', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category updated successfully</div>');
                    redirect('admin/category');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error while update Category</div>');
                    redirect('admin/category');
                }
            }
        }else{
            echo '<script>alert("Category not exist");</script>';
            echo '<script>window.location.href="'.base_url("admin/category").'"</script>';
        }
    }
    public function sub_category() {
        $catArr=array();
        $categoryData = $this->Admin_model->getTableDataArray('category', 'parent_id=0 and status!=99', 'id', '');
        $category = $this->Admin_model->getTableDataArray('category', 'parent_id!=0 and status!=99', 'id', '');
        if($category){
            foreach ($category as $value) {
                $category       = $this->Admin_model->getSingleDataRow('category','id="'.$value['parent_id'].'" and status!=99');
                if($category){
                    $value['category']=$category['name'];
                    array_push($catArr,$value);   
                }
            }
        }
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('category', 'Category Name', 'required');
        $this->form_validation->set_rules('name', 'Sub-Category Name', 'required');


        if ($this->form_validation->run() == False) {
            $data['categories'] = $catArr;
            $data['categoryData'] = $categoryData;
            //echo '<pre/>';print_r($data);exit;
            $data['view_link'] = 'category/sub_category';
            $this->load->view('layout/template', $data);
        } else {
            if (($_FILES['image']['name'])) {
                $uploadImage = $this->Admin_model->upload_file('image', 'category');
                //print_r($uploadImage);exit;
                if ($uploadImage) {
                    $insertArr = [
                        'parent_id' => $this->input->post('category'),
                        'name' => ucwords($this->input->post('name')),
                        'image' => base_url() . $uploadImage,
                        'status' => '1',
                        'created_at' => time()
                    ];
                    $returnData = $this->Admin_model->insertDataTable('category', $insertArr);
                    if ($returnData) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                        redirect('admin/sub-category');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error while adding Category</div>');
                        redirect('admin/sub-category');
                    }
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Image Not Uploaded.</div>');
                    redirect('admin/sub-category');
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Image Not Uploaded.</div>');
                redirect('admin/sub-category');
            }
        }
    }
    public function edit_sub_category() {
        $catArr=array();
        $id = $this->uri->segment(3);
        $singleCategory = $this->Admin_model->getSingleDataRow('category', 'id="'.$id.'" and parent_id!=0');
        if($singleCategory){
            $singleCategoryData = $this->Admin_model->getSingleDataRow('category', 'id="'.$singleCategory['parent_id'].'" ');
            $singleCategory['category_name']=$singleCategoryData['name'];
            $categoryData = $this->Admin_model->getTableDataArray('category', 'parent_id=0 and status!=99', 'id', '');
            $category = $this->Admin_model->getTableDataArray('category', 'parent_id!=0 and status!=99', 'id', '');
            if($category){
                foreach ($category as $value) {
                    $category       = $this->Admin_model->getSingleDataRow('category','id="'.$value['parent_id'].'" and status!=99');
                    if($category){
                        $value['category']=$category['name'];
                        array_push($catArr,$value);   
                    }
                }
            }
            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
            $this->form_validation->set_rules('category', 'Category Name', 'required');
            $this->form_validation->set_rules('name', 'Sub-Category Name', 'required');

        if ($this->form_validation->run() == False) {
            $data['categories'] = $catArr;
            $data['categoryData'] = $categoryData;
            $data['singleCategory'] = $singleCategory;
            //echo '<pre/>';print_r($data);exit;
            $data['view_link'] = 'category/sub_category';
            $this->load->view('layout/template', $data);
        } else {
            $insertArr = [
                'name' => ucwords($this->input->post('name')),
            ];
            if (($_FILES['image']['name'])) {
                    $uploadImage = $this->Admin_model->upload_file('image', 'category');
                    if ($uploadImage) {
                        $insertArr['image'] = base_url() . $uploadImage;
                    }
                }
                //print_r($insertArr);exit;
                $returnData = $this->Admin_model->updatedataTable('category','id="'.$id.'"', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sub-Category updated successfully</div>');
                    redirect('admin/sub-category');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error while update Category</div>');
                    redirect('admin/sub-category');
                }
            }
        }
        else{
            echo '<script>alert("Sub-Category not exist");</script>';
            echo '<script>window.location.href="'.base_url("admin/category").'"</script>';
        }
    }
    
    public function advertisment() {
        $sliderArr=array();
        $slider= $this->Admin_model->getTableDataArray('slider', '', 'id', '');
        if($slider){
            foreach ($slider as $value) {
                $vendor       = $this->Admin_model->getSingleDataRow('vendor','id="'.$value['vendor_id'].'" and status!=99');
                if($vendor){
                    $value['vendor']=$vendor;
                    array_push($sliderArr, $value);
                }
            }
        }
        $data['advertisment'] = $sliderArr;
        $data['view_link'] = 'category/advertisment';
//        echo '<pre/>';        print_r($data);exit;
        $this->load->view('layout/template', $data);
    }
    
    public function add_product() {
        $data['brand'] = $this->Admin_model->getData(['status' => 1], 'brand', '', 'id', 'ASC');
        $category = $this->Admin_model->getData(['parent_id' => 0], 'category', '', 'id', 'ASC');
        $cat_attributes = $this->Admin_model->getData([], 'category_attribute', '', 'id', 'ASC');
        $categoryArr = [];
        foreach ($category as $category1) {
            $subcategory = $this->Admin_model->getData(['parent_id' => $category1['id']], 'category', '', 'id', 'ASC');
            $category1['subCategory'] = $subcategory;
            array_push($categoryArr, $category1);
        }
        $data['subcategory'] = json_encode($categoryArr);
        $data['category'] = $categoryArr;
        $cAttr = [];
        foreach ($categoryArr as $categoryAttr) {
            $subAttr = [];
            foreach ($categoryAttr['subCategory'] as $subCategoryAttr) {
                $catAtt = $this->Admin_model->getData(['sub_category_id' => $subCategoryAttr['id']], 'category_attribute', '', 'id', 'ASC');
                $catAtt_ValArr = [];
                foreach ($catAtt as $catAtt_Val) {
                    $catAttri_val = $this->Admin_model->getData(['attribute_id' => $catAtt_Val['id']], 'category_attribute_value', '', 'id', 'ASC');
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
            $cat_att = $this->Admin_model->getData(['id' => $catAttribute['sub_category_id']], 'category', '', 'id', 'ASC');
            $catAttribute['cat_att'] = $cat_att;
            array_push($catAttArr, $catAttribute);
        }
        $cat_att_val = $this->Admin_model->getData([], 'category_attribute_value', '', 'id', 'ASC');
        $catAttValArr = [];
        foreach ($cat_att_val as $catAttValu) {
            $cat_att_val = $this->Admin_model->getData(['id' => $catAttValu['attribute_id']], 'category_attribute', '', 'id', 'ASC');
            $catAttValu['cat_att_val'] = $cat_att_val;
            array_push($catAttValArr, $catAttValu);
        }
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('category', 'Product Category', 'required');
        $this->form_validation->set_rules('sub_categorys', 'Product Sub Category', 'required');
        $this->form_validation->set_rules('brand', 'Brand name', 'required');
        // $this->form_validation->set_rules('attribute_name','Color');
        // $this->form_validation->set_rules('attribute_name','Size');
        // $this->form_validation->set_rules('attribute_name','Model');
        // $this->form_validation->set_rules('attribute_value','Attribute Value');
        $this->form_validation->set_rules('price', 'Product Price', 'required');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'required');
        $this->form_validation->set_rules('discount', 'Total Discount', 'required');
        if ($this->form_validation->run() == False) {
            $data['view_link'] = 'product/add_product';
            $this->load->view('layout/template', $data);
        } else {
//            print_r($_POST);
//            exit;
            $insertArr = [
                'name' => $this->input->post('product_name'),
                'category_id' => $this->input->post('category'),
                'vendor_id' => 0,
                'sub_category_id' => $this->input->post('sub_categorys'),
                'brand_id' => $this->input->post('brand'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'discount' => $this->input->post('discount'),
                'description' => $this->input->post('description'),
                'status' => 1,
                'created_at' => time()
            ];
            $image=[];
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
                            $returnId = $this->Admin_model->insertDataTable('files',$insertTmgArr);
                            array_push($image,$returnId);
                        }
                    }
                }
            }
            $insertArr['images']= trim(implode(',', $image),',');
            $returnData = $this->Admin_model->insertDataTable('products', $insertArr);
            if ($returnData) {
                if ($this->input->post('attribute_id')) {
                    foreach ($this->input->post('attribute_id') as $attribute_id) {
                        $insert = ['product_id' => $returnData, 'category_id' => $this->input->post('category'), 'sub_category_id' => $this->input->post('sub_categorys'), 'attribute_id' => $attribute_id, 'attribute_value_id' => $this->input->post('attribute_value_' . $attribute_id)];
                        $returnDataAttribute = $this->Admin_model->insertDataTable('product_attribute', $insert);
                    }
                }
                if ($this->input->post('specifications')) {
                    foreach ($this->input->post('specifications') as $specification) {
                        $insert_s = ['product_id' => $returnData, 'attribute_id' => $specification, 'value' => $this->input->post('specification_value_' . $specification)];
                        $returnDataSpecification = $this->Admin_model->insertDataTable('product_specification', $insert_s);
                    }
                }
                $this->session->set_flashdata('response', 'New Product added successfully');
                redirect('admin/verify-product-list');
            } else {
                $this->session->set_flashdata('response', 'Error While adding new product');
                redirect('admin/add-product');
            }
        }
    }
   
    
    
    
    
    
    

    public function product_sub_category() {
        $category = $this->Admin_model->getData(['parent_id !=' => '0'], 'sq_category', '', 'id', 'DESC');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');
        $this->form_validation->set_rules('name_ar', 'Sub Category Name (Ar)', 'required');


        if ($this->form_validation->run() == False) {
            $data['categories'] = $category;
            $data['view_link'] = 'products/sub_category_list';
            $this->load->view('layout/template', $data);
        } else {

            $insertArr = [
                'parent_id' => $this->input->post('category_id'),
                'name' => ucwords($this->input->post('name')),
                'name_ar' => ucwords($this->input->post('name_ar')),
                'status' => '1',
                'created_at' => time()
            ];

            $returnData = $this->Admin_model->addData('sq_category', $insertArr);
            if ($returnData) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Sub Category added successfully</div>');
                redirect('admin/product-sub-category');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error while adding Sub Category</div>');
                redirect('admin/product-sub-category');
            }
        }
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

    function upload_file($img_name, $uploadPath) {

        //print_r($image);exit;
        if (!empty($_FILES[$img_name]['name'])) {
            $file_ext = explode('.', $_FILES[$img_name]['name']);

            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {
                $insertArr = [
                    'file_path' => base_url() . $uploadPath,
                    'file_name' => $uploadFile,
                    'file_type' => $file_ext[1],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $returnId = $this->Admin_model->addFile($insertArr);
            } else {
                $returnId = 0;
            }
        } else {
            $returnId = 0;
        }
        return $returnId;
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

    function send_mail($to, $title, $subject, $data) {
        // print_r($data); exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "ashutosh@gropse.com";
        $config['smtp_pass'] = "ashutosh@123";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";

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

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

    

    public function exportdataList() {
        $for = $this->uri->segment(3);
        if ($for == 'vendor') {

            $type = '1';
            $header = array("Id", "Vendor Name", "Shop Name", "Shop Name (Ar)", "Address", "Mobile", "Email", "Registration Date", "Status");
            $usersData = $this->Admin_model->getVendorList(["user_type" => $type], '', 'au.id', 'ASC');
        } else if ($for == 'user') {
            $type = '2';
            $usersData = $this->Admin_model->getUserList(["user_type" => $type], '', 'id', 'ASC');
            $header = array("Id", "User Name", "Gender", "Address", "Mobile", "Email", "Registration Date", "Status");
        }
        $filename = $for . date('YMd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
//        // get data 
        //echo "<pre>";print_r($usersData);exit;
//        // file creation 
        $file = fopen('php://output', 'w');

        fputcsv($file, $header);
        foreach ($usersData as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function logout() {

        $this->session->unset_userdata('af_s_m_admin_logged_in');
        redirect('admin');
    }
     public function ajax() {
        $this->load->view('ajax_server');
    }

}
?>


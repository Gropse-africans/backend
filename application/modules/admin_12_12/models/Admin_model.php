<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function admin_login($email, $password) {
        $password = md5($password);  //change hash function
        $this->db->where('username', $email);
        $this->db->where('password', $password);
        $return = $this->db->get('admin')->row_array();
        if ($return) {
            return $return;
        } else {
            return FALSE;
        }
    }

    public function addFile($insertArr) {

        $query = $this->db->insert('su_files', $insertArr);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function getSingleDataRow($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }

    function getTableDataArrayLimit($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->limit(10, 0);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    function getTableDataArray($table, $where, $orderBy, $limit) {
        //echo $orderBy;exit;
        if ($where) {
            $this->db->where($where);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        if ($limit) {
            $this->db->limit($limit, 0);
        }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    function getTableDataArrayGroupBy($table, $where, $groupBy) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->group_by($groupBy);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    function getTableDataArrayOrderBy($table, $where, $orderBY) {
        $this->db->where($where);
        $this->db->order_by($orderBY, 'DESC');
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    function insertDataTable($table, $doc) {
        $results = $this->db->insert($table, $doc);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    function updatedataTable($table, $where, $data) {
        $this->db->where($where);
        $results = $this->db->update($table, $data);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    function deleteDataTable($table, $where) {
        $results = $this->db->where($where)
                ->delete($table);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    function upload_file($x, $path) {
        $errors = array();
        $file_tmp = $_FILES[$x]['tmp_name'];
        $file_ext = explode('.', $_FILES[$x]['name']);
        $myCount = count($file_ext) - 1;
        //echo '<pre/>';print_r($file_ext);exit;
        $file_name = strtotime(date('Y-m-d H:i:s')) . rand(1000, 9999) . '.' . $file_ext[$myCount];
        $file_name = urlencode($file_name);
        //echo $file_name;exit;
        $folder_name = "uploads/" . $path . "/";
        if (empty($errors) == true) {
            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            if ($data) {
                return $folder_name . $file_name;
            }
            return $data;
        } else {
            return false;
        }
    }

    function getcategoryAttribute($subCategoryId) {
        $getAttributeArr = array();
        $categoryAttr = $this->getData(['sub_category_id' => $subCategoryId, 'type' => 1, 'status' => 1], 'category_attribute', '', '', '');
        if ($categoryAttr) {
            foreach ($categoryAttr as $value) {
                $val = $value['id'];
                $categoryAttrVal = $this->getData(['attribute_id' => $val], 'category_attribute_value', '', '', '');
                $value['attribute_value'] = $categoryAttrVal;
                array_push($getAttributeArr, $value);
            }
            return $getAttributeArr;
        } else {
            return false;
        }
    }

    function getcategorySpecification($subCategoryId) {
        $getAttributeArr = array();
        $categoryAttr = $this->getData(['sub_category_id' => $subCategoryId, 'type' => 2, 'status' => 1], 'category_attribute', '', '', '');
        //echo '<pre>';print_r($categoryAttr);exit;
        if ($categoryAttr) {
            return $categoryAttr;
        } else {
            return false;
        }
    }
    public function getData($condition, $table, $limit, $order, $sort) {
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->where($condition)
                ->order_by($order, $sort)
                ->get($table);
        return $query->result_array();
    }
    
    function getProductFeatures($condition){
        $featureAttr=$this->db->where($condition)->select('product_attribute.*,category_attribute.title,category_attribute_value.value')->join('category_attribute','category_attribute.id=product_attribute.attribute_id')->join('category_attribute_value','category_attribute_value.id=product_attribute.attribute_value_id')->from('product_attribute')->get()->result_array();
        //echo '<pre>';print_r($categoryAttr);exit;
        if($featureAttr){
            return $featureAttr;
        }else{
            return false;
        }
    }
    function getProductSpecification($condition){
        $featureAttr=$this->db->where($condition)->select('product_specification.*,category_attribute.title')->join('category_attribute','category_attribute.id=product_specification.attribute_id')->from('product_specification')->get()->result_array();
        //echo '<pre>';print_r($categoryAttr);exit;
        if($featureAttr){
            return $featureAttr;
        }else{
            return false;
        }
    }
    
     public function getServicePlanData($condition) {   
        $query = $this->db->where($condition)->from('service_detail sd')->join('service_plan sp','sp.plan_id=sd.service_plan_id')
                ->get();
        return $query->result_array();
    }
    
    public function getOrderItems($condition) {
        $query = $this->db->select('ot.*,p.name as product_name,v.name as vendor_name')->where($condition)->from('order_items ot')->join('products p','p.product_id=ot.product_id')->join('vendor v','v.id=ot.vendor_id')
                ->get();
        return $query->result_array();
    }

}

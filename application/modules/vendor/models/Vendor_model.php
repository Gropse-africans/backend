<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vendor_model extends CI_Model {

    public function vendor_login($email, $password) {
        $email = $email;
        $password = md5($password); //change hash function
        $return = $this->db->where(['email' => $email, 'password' => $password])->get('vendor');
        // echo $this->db->last_query();
        if ($return->num_rows()) {
            return $return->row_array();
        } else {
            return FALSE;
        }
    }

    public function addData($table, $insertArr) {
        $query = $this->db->insert($table, $insertArr);
        $insertId = $this->db->insert_id();
        return $insertId;
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

    function get_category(){
        $query = $this->db->get('category');
        return $query;  
    }
 
    function get_sub_category($category_id){
        $query = $this->db->get_where('category', array('subcategory_category_id' => $parent_id));
        return $query;
    }

    public function getRowData($condition, $table) {

        $query = $this->db->where($condition)
                ->get($table);

        return $query->row_array();
    }

    public function updateData($condition, $table, $updateArr) {
        $this->db->where($condition);
        $query = $this->db->update($table, $updateArr);
        //  echo $this->db->last_query();
        if ($query) {
            return $this->db->get_where($table, $condition)->row_array();
        } else {
            return array();
        }
    }

    function getcategoryAttribute($subCategoryId){
        $getAttributeArr=array();
        $categoryAttr=$this->getData(['sub_category_id'=>$subCategoryId,'type'=>1,'status'=>1],'category_attribute','','','');
        if($categoryAttr){
            foreach ($categoryAttr as $value) {
                $val=$value['id'];
               $categoryAttrVal=$this->getData(['attribute_id'=>$val],'category_attribute_value','','','');
               $value['attribute_value']=$categoryAttrVal;
               array_push($getAttributeArr, $value);
            }
            return $getAttributeArr;    
        }else{
            return false;
        }
    }
    function getcategorySpecification($subCategoryId){
        $getAttributeArr=array();
        $categoryAttr=$this->getData(['sub_category_id'=>$subCategoryId,'type'=>2,'status'=>1],'category_attribute','','','');
        //echo '<pre>';print_r($categoryAttr);exit;
        if($categoryAttr){
            return $categoryAttr;    
        }else{
            return false;
        }
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
}
?>
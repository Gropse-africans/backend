<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->helper('push_helper');
        date_default_timezone_set('Asia/Kolkata');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////USER MODULE////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function getSingleDataRow($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }

    function getTableDataArray($table, $where) {
        if ($where) {
            $this->db->where($where);
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

    function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }

    function sanitize($input) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInput($input);
            $output = $this->escapeString($input);
        }
        return $output;
    }

    function cleanInput($input) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
        $output = preg_replace($search, '', $input);
        echo $output;
    }

    function getDataSearch($data) {

        if (isset($data['search']) && $data['search']) {
            $this->db->like('job_title', $data['search']);
            $title = $this->db->get('job_designation')->result_array();
            if ($title) {
                $type = [];
                foreach ($title as $job) {
                    array_push($type, $job['id']);
                }
                $cat_id = implode(',', $type);
                $this->db->where('job_title IN('.$cat_id.')');
            }
        }
        if (isset($data['job_location']) && $data['job_location']) {
            $this->db->like('job_location', $data['job_location']);
        }
        if (isset($data['category_id']) && $data['category_id']) {
            $this->db->where('category_id', $data['category_id']);
        }

        $this->db->where('status', 1);
        $jobs = $this->db->get('job_post')->result_array();
        return $jobs;
    }

}

////axios
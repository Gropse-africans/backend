<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function apiCallHeader($path, $headerData, $bodyData) {
        $headers = array("Lang:" . $headerData['lang'], "DeviceId:" . $headerData['device_id'], "SecurityToken:" . $headerData['security_token'], "Content-Type:multipart/form-data");
//        $url = base_url() . "user/" . $path;
      $url = "http://auctionbuy.in/african_super_market/user/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
//              echo '<pre/>';print_r($myvar);exit;
        return $myvar;
    }

    function apiCall($path, $strPost) {
        $headers = array("Content-Type:multipart/form-data");
//       $url = base_url() . "user/" . $path;
        $url = "http://auctionbuy.in/african_super_market/user/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
//        echo '<pre/>';print_r($myvar);exit;
        return $myvar;
    }

    function apiCallJSON($path, $strPost) {
        $url = base_url() . "user/" . $path;
        $ch = curl_init($url);
        $payload = $strPost;
        //print_r($payload);exit;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        $url = base_url() . "user/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
        return $myvar;
    }

}

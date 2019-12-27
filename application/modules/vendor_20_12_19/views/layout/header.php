<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/vendor/common/images/logo/favicon.png">

        <title>Africans Supermarket : Vendor: Login Registration</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/ionicons.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/simple-line-icons.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/jquery.mCustomScrollbar.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/css/style.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/common/fonts/responsive.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <style>
            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 100%;
                height: 100%;
                position: absolute;
                position: fixed;
                display: block;
                opacity: 1;
                z-index: 9999;
                text-align: center;
                background: rgba(0,0,0,0.5);

            }
            .lds-ellipsis div {
                position: absolute;
                top:50%;

                width: 11px;
                height: 11px;
                border-radius: 50%;
                background: #fff;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
                text-align: center;
            }
            .lds-ellipsis div:nth-child(1) {
                left: 47%;
                animation: lds-ellipsis1 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(2) {
                left: 48%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(3) {
                left: 50%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(4) {
                left: 51%;
                animation: lds-ellipsis3 0.6s infinite;
            }
            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
            }
            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(19px, 0);
                }
            }

            .fav{
                color: #fff !important;
                background: #fab112 !important;
            }
            .selected-filter{
                background-color: antiquewhite;
            }
        </style>
    </head>

    <body>
        <div id="loading" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        <div class="sufee-login d-flex align-content-center flex-wrap beaytulogin beaytusignup" style="height:auto">

            <div class="container">

                <div class="login-content">

                    <div class="logo">

                        <span class="logo-default">

                            <img alt="" src="<?php echo base_url(); ?>assets/vendor/common/images/logo/logo_header.png" alt="Logo">

                        </span>

                    </div>
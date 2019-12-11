<!DOCTYPE >
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Africa Supermarket : Online Supermarket  in Sauth Africa</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets\css\font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets\css\ionicons.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets\css\simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets\css\jquery.mCustomScrollbar.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets\css\style.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets\css\responsive.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets\css\dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- data live search -->
        <link href="<?= base_url() ?>assets\css\liveselect.css" rel="stylesheet">
        <!-- search end -->
        <!-- summereditor -->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
        <!-- editor end -->
        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
            /*sweetalert end*/
            .mytoggle .switch
            {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 23px;
            }
            .mytoggle .switch input {
                display: none;
            }
            .mytoggle input:checked + .slider {
                background-color: #2196F3;
            }

            .mytoggle .slider.round {
                border-radius: 34px;
            }
            .mytoggle .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }
            .mytoggle input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            .mytoggle .slider.round:before {
                border-radius: 50%;
            }
            .mytoggle .slider:before {
                position: absolute;
                content: "";
                height: 15px;
                width: 15px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }
        </style>
        <!--bs4 data table-->
        <link href="<?= base_url() ?>assets\css\dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets\css\style.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets\css\responsive.css" rel="stylesheet">



    </head>

    <body>
        <div class="container" style="margin-top:20%;text-align: center;">
            <h1>Session Expired! </h1>
            <span>go back to <a href="<?=base_url()?>">Home</a></span>
        </div>
    </body>

    <script type="text/javascript" src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets\js\bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- chart js -->

    <script src="<?= base_url() ?>assets\js\Chart.bundle.js"></script>
    <script src="<?= base_url() ?>assets\js\utils.js"></script>

<!-- <script src="<?= base_url() ?>assets\js\chart.js"></script> -->
    <script type="text/javascript" src="<?= base_url() ?>assets\js\jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?= base_url() ?>assets\js\jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets\js\dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets\js\custom.js" type="text/javascript"></script>
    <!-- datatable -->
    <!-- data live search -->
    <script src="<?= base_url() ?>assets\js\liveselect.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>
        $(document).ready(function () {
            $('#bs4-table').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var t = $('#summernote').summernote({
                height: 100,
                focus: true,
                popover: false
            }
            );
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var t = $('#c_notes').summernote({
                height: 100,
                focus: true,
                popover: false
            }
            );
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var t = $('#sub_complaint').summernote({
                height: 100,
                focus: true,
                popover: false
            }
            );
        });
    </script>
</html>

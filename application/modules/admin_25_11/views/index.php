<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url(); ?>common/images/logo/favicon.png">
        <title>Africans Supermarket : Admin: Login</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ionicons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/fonts/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .errorPrint{
                font-size: 12px;
                color: #ffc107;
                padding: 5px 5px;
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="sufee-login d-flex align-content-center flex-wrap beaytulogin">
            <div class="container">
                <div class="login-content">
                    <div class="logo">
                        <span class="logo-default">
                            <img alt="" src="<?php echo site_url(); ?>assets/admin/images/logo/logo_white.png" alt="Logo">
                        </span>
                    </div>
                    <div class="login-form">
                        <form>
                            <span class="alert alert-danger" style="padding: 11px 153px;display: none;" id="alertMessage">Wrong Email Or Password.</span>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" id="email" class="form-control" placeholder="Email">
                                <p class="errorPrint" id="emailError">Email field is required</p>
                            </div>
                            <div class="form-group eyepassword">
                                <label>Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Password">
                                <i class="fa fa-eye-slash" onclick="showPassword(this)" id="showPassword"></i>
                                <p class="errorPrint" id="passwordError">Password field is required</p>
                            </div>
<!--                            <div class="form-group">
                                <a href="<?php echo base_url('forgot-pass'); ?>"class="panel-title pull-right text-white mb-2">Forgot Password ?</a>
                            </div>-->
                            <button type="button" onclick="login(this)" class="btn btn-success btn-flat m-b-30 m-t-30" style="margin-top: 13px;">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/admin/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/popper.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/Chart.bundle.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/utils.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/chart.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/js/custom.js'); ?>"></script>
        <script type="text/javascript">
           function login(obj){
                $(".errorPrint").css('display','none');
                var idValidate=false;
                $(".form-control").each(function (index, value) {
                    // console.log('div' + index + ':' + $(this).attr('id'));
                    if($(this).val()){
                        $("#"+$(this).attr('id')+'Error').css('display','none');
                    }else{
                        idValidate=true;
                        $("#"+$(this).attr('id')+'Error').empty();
                        $("#"+$(this).attr('id')+'Error').append('*'+$(this).attr('placeholder')+' is required field');
                        $("#"+$(this).attr('id')+'Error').css('display','block');
                    }
                });
                if(idValidate){
                    return false;
                }else{
                    var email          = $("#email").val();
                    var password       = $("#password").val();
                    $.ajax({
                        url: "<?= base_url(); ?>admin/login/ajax",
                        type: 'post',
                        data: 'method=login&email=' + email + '&password=' + password,
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                window.location.href="admin/dashboard";
                            } else {
                                $("#alertMessage").css('display','block')
                            }
                        }
                    });
                }
           }
           function showPassword(obj){
                var type       = $("#password").attr('type');
                if(type=='text'){
                    $("#password").attr('type','password');
                    $(obj).removeClass('fa-eye');
                    $(obj).addClass('fa-eye-slash');
                }else{
                    $("#password").attr('type','text');
                    $(obj).removeClass('fa-eye-slash');
                    $(obj).addClass('fa-eye');
                }
            }
        </script>
    </body>
</html>
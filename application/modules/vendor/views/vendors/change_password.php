<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Change Password </h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-md-end d-md-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url() ?>vendor/dashboard">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Change Password

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <form id="registerForm" method="post" class="right-text-label-form" name="addForm" enctype="multipart/form-data">
            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">
                        <?= $this->session->flashdata('response'); ?>
                        <div class="card card-shadow mb-4">


                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name"> Enter Old Password</label>
                                            <span class="error text-danger" id="old_password"></span>
                                            <?= form_error('old_password') ?>
                                            <input type="password" name="old_password" class="form-control" onchange="checkPassword(this);" placeholder="Enter Old Password">
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="container-fluid" id="changePasswordDiv" style="display:none;">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-body">
                                <div class='row'>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name"> New Password</label>
                                            <span class="error text-danger" id="new_password"></span>
                                            <?= form_error('new_password') ?>
                                            <input type="password" name="new_password" class="form-control validate" placeholder="Enter New Password">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name"> Confirm Password</label>
                                            <span class="error text-danger" id="c_password"></span>
                                            <?= form_error('c_password') ?>
                                            <input type="password" name="c_password" class="form-control validate" placeholder="Confirm Password">
                                        </div>

                                    </div>
                                    <div class="col-sm-12 offset-10">

                                        <button type="button" class="btn btn-primary" name="signup" onclick="validate();">

                                            Change 

                                        </button>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>





    </main>

</div>
<script>
    function validate() {
        var flag = true;
        var password = '';
        var c_password = '';
        var formData = $("#registerForm").find('.validate:input').not(':input[type=button]');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0') {
                $('#' + name).html('* required field');
                flag = false;
            } else {

                if (name == 'new_password') {
                    if (val.length < 8) {
                        $('#' + name).html('password must be 8 in length');
                    } else {
                        password = val;
                        $('#' + name).html('');
                    }

                } else {
                    $('#' + name).html('');
                    c_password = val;
                }
            }
        });
        if (password != c_password) {
            flag = false;
            $('#c_password').html('Password Do Not Match');
        }
        if (flag) {
            $('#registerForm').submit();
        } else {
            return false;
        }

    }


    function checkPassword(obj) {
        var old_password = $(obj).val();
        if (old_password) {
            $.ajax({
                url: "<?= base_url(); ?>vendor/home/ajax",
                type: 'post',
                data: 'method=changeData&data=' + old_password,
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "100") {
                        $('#changePasswordDiv').css('display', 'block');
                        $('#old_password').html('');
                        $('html, body').animate({
                            scrollTop: $("#changePasswordDiv").offset().top
                        }, 1000);
                    } else {
                        $('#old_password').html(jsonData['message']);
                    }
                }
            });
        } else {
            return false;
        }
    }
</script>


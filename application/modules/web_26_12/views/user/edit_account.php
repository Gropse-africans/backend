<div id="account-wishlist" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
        <li><a>Account</a></li>
        <li><a>Edit Account</a></li>
    </ul>
    <div class="row">
        <?php $this->load->view('sidebar'); ?>

        <div id="content" class="col-sm-9 my_wishlist">
            <h2>Edit Account</h2>
            <?=$this->session->flashdata('response');?>
            <span class="text-danger" id="error"></span>
            <form method="post" class="form-horizontal" id="profile_form" enctype="multipart/form-data">
                <div class="form-group required">    
                    <div class="col-sm-8">
                        <img width="145px" id="blah1" hieght="150px" src="<?= $user['image'] ? $user['image'] : base_url() . 'assets/web/images/user.jpg' ?>"><br>
                        <label class="btn btn-success" for="profile_image_input">Change Image</label>
                        <span class="text-danger" id="profile_image"></span>
                        <input type="file" onchange="readURL(this, 1);" name="profile_image" style="display:none" id="profile_image_input" >
                    </div>
                </div>

                <fieldset>
                    <legend>Your Personal Details</legend>
                    <div class="form-group required">
                        <label class="col-sm-2" for="input-email">Email Id</label>
                        <span class="text-danger" id="email"></span>
                        <div class="col-sm-8">
                            <label class="col-sm-2" for="input-email"><?= $user['email'] ?></label>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-firstname">Your Name </label>
                        <div class="col-sm-8">
                            <input type="text" name="name" placeholder="" onchange="checkName(this);" class="form-control" value="<?= $user['name'] ?>">
                        </div>
                        <div class="col-sm-2">
                            <span class="text-danger" id="name"></span>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-telephone">Mobile No </label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile" onchange="checkMobile(this);" placeholder="" value="<?= $user['mobile'] ?>" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <span class="text-danger" id="mobile"></span>
                        </div>
                    </div>

                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-right">
                        <button class="btn btn-default" onclick="validate();" type="button">continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var valid_mobile = true;
    var valid_email = true;
    var valid_name = true;
    var message = "";
    function checkEmail(element) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test($(element).val())) {
            valid_email = false;
            $('#email').html('email invalid');
            message = 'email invalid';
        } else {
            valid_email = true;
            $('#email').html('');
        }
    }

    function checkName(element) {
        var regex = /^([a-zA-Z ])+$/;
        if (!regex.test($(element).val())) {
            valid_name = false;
            $('#name').html('name invalid');
            message = 'name invalid';
        } else {
            valid_name = true;
            $('#name').html('');
        }
    }

    function checkMobile(element) {
        var regex = /^([0-9])+$/;
        if (!regex.test($(element).val())) {
            valid_mobile = false;
            $('#mobile').html('mobile invalid');
            message = 'mobile invalid';
        } else {

            if ($(element).val() < 6 || $(element).val() < 15) {
                valid_mobile = false;
                message = 'mobile invalid';
                $('#mobile').html('mobile invalid');
            } else {
                valid_mobile = true;
                $('#mobile').html('');

            }
        }
    }

    function validate() {
        var flag = true;
        var formData = $("#profile_form").find(':input').not(':input[type=button], :input[type=file]');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');

            if (val == '' || val == '0') {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });

        if (flag && valid_mobile && valid_email && valid_name) {
//            $.ajax({
//                url: '<?= base_url() ?>ajax/edit_userprofile',
//                type: 'POST',
//                data: $("#profile_form").serialize(),
//                success: function (data) {
////                    var response=trim(jsonParse(data));
//                    var dt = $.trim(data);
//
//                    var jsonData = JSON.parse(dt);
//                    if (jsonData['error_code'] == 200) {
//                        window.location.href = "<?= base_url() ?>my-account";
//                    } else {
//                        $('#error').html(jsonData['message']);
//                    }
//                }
//            });
            $('#profile_form').submit();
        } else {
            if (!flag) {
                return false;
            } else {
                if (!valid_mobile) {
                    $('#mobile').html('mobile invalid');
                } else {
                    $('#mobile').html('');
                }
                if (!valid_email) {
                    $('#email').html('email invalid');
                } else {
                    $('#email').html('');
                }
                if (!valid_name) {
                    $('#name').html('name invalid');
                } else {
                    $('#name').html('');
                }
            }
        }
    }

</script>
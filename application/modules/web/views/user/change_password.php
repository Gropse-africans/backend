<div id="account-wishlist" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?php echo base_url(''); ?>">Account</a></li>
        <li><a href="<?php echo base_url('change-password'); ?>">Change Password</a></li>
    </ul>
    <div class="row">
        <?= $this->load->view('sidebar'); ?>

        <div id="content" class="col-sm-9 my_wishlist">
            <h2>Change Password</h2>
            <span class="text-danger" style="margin-bottom: 5px;" id="error"></span>
            <span class="text-success" style="margin-bottom: 5px;" id="success"></span>
            <form method="post" class="form-horizontal" id="reset_password_form">
                <fieldset>
                    <div class="form-group required verify">
                        <label class="col-sm-2 control-label" for="input-firstname">Old Password </label>
                        <div class="col-sm-8">
                            <input type="password" name="old_password" class="form-control">

                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-default verify" onclick="checkPassword();" type="button">continue</button>
                        </div>
                    </div>
                    <div class="form-group required new_password" style="display:none;">
                        <label class="col-sm-2 control-label" for="input-email">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password"  class="form-control">
                        </div>
                        <span class="text-danger" id="password"></span>
                    </div>
                    <div class="form-group required new_password" style="display:none;">
                        <label class="col-sm-2 control-label" for="input-telephone">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="c_password"  class="form-control">
                        </div>
                        <span class="text-danger" id="c_password"></span>
                    </div>
                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-right">
                        <button class="btn btn-default new_password" onclick="changePassword();" style="display:none;" type="button">continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    function checkPassword() {
        var flag = true;
        var old_password = $('input[name="old_password"]').val();

        if (old_password) {
            $('#error').html('');
            $.ajax({
                url: '<?= base_url() ?>web/ajax/check_password',
                type: 'POST',
                data: 'data=' + old_password,
                success: function (data) {
//                    var response=trim(jsonParse(data));
                    var dt = $.trim(data);

                    var jsonData = JSON.parse(dt);
                    if (jsonData['error_code'] == 200) {
                        $('.new_password').css('display', 'block');
                        $('.verify').css('display', 'none');
                    } else if (jsonData['error_code'] == 301) {
                        alert(jsonData['message'] + '. Please Log-in');
                        window.location.href = "<?= base_url() ?>logout";
                    } else {
                        $('#error').html(jsonData['message']);
                    }
                }
            });
            return true;

        } else {
            $('#error').html('Old password is required field');
        }
    }

    function changePassword() {
        var flag = true;
        var password = '';
        var c_password = '';
        var formData = $(".new_password").find(':input').not(':input[type=button]');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');

            if (val == '' || val == '0') {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                if (name == 'password') {
                    if (val.length < 8) {
                        flag = false;
                        $('#' + name).html('minimum length 8');
                    } else {
                        password = val;
                    }
                } else if (name == 'c_password') {
                    c_password = val;
                } else {
                    $('#' + name).html('');
                }
            }
        });

        if (flag) {
            if (((c_password.length > 0) && (password.length > 0))) {
                if (c_password != password) {
                    flag = false;
                    $('#c_password').html('Password do not match');
                    return false;
                } else {
                    $('#error').html('');
                    $.ajax({
                        url: '<?= base_url() ?>web/ajax/changePassword',
                        type: 'POST',
                        data: $(formData).serialize(),
                        success: function (data) {
//                    var response=trim(jsonParse(data));
                            var dt = $.trim(data);
                            var jsonData = JSON.parse(dt);
                            if (jsonData['error_code'] == 200) {
                                $('#success').html(jsonData['message']);
                                $('#error').html('');
                                $('#reset_password_form').trigger('reset');
                            } else if (jsonData['error_code'] == 301) {
                                alert(jsonData['message'] + '. Please Log-in');
                                window.location.href = "<?= base_url() ?>logout";
                            } else {
                                $('#error').html(jsonData['message']);
                                $('#success').html('');
                            }
                        }
                    });
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>
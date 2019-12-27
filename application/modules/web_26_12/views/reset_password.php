
<div id="account-wishlist" class="container">

    <div class="row">
        <aside id="column-left" class="col-sm-3 hidden-xs">

        </aside>

        <div id="content" class="col-sm-9 my_wishlist">
            <h2>Reset Password</h2>
            <span class="text-danger" id="error"></span>
            <form method="post" class="form-horizontal" id="reset_password_form">
                <fieldset>
                    <div class="form-group required">
                        <label class="col-sm-3 control-label" for="input-email">New Password</label>
                        <div class="col-sm-5">
                            <input type="password" name="password" class="form-control">
                        </div>
                        <span class="text-danger" id="password"></span>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-3 control-label" for="input-telephone">Confirm Password</label>
                        <div class="col-sm-5">
                            <input type="password" name="c_password" class="form-control">
                        </div>
                        <span class="text-danger" id="c_password"></span>
                    </div>
                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-right">
                        <button class="btn btn-default" type="button" onclick="validate();">continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function validate() {
        var flag = true;
        var c_password = '';
        var password = '';
        var formData = $("#reset_password_form").find(':input').not(':input[type=button]');
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
                        url: '<?= base_url() ?>ajax/user_login',
                        type: 'POST',
                        data: $("#reset_password_form").serialize(),
                        success: function (data) {
//                    var response=trim(jsonParse(data));
                            var dt = $.trim(data);

                            var jsonData = JSON.parse(dt);
                            if (jsonData['error_code'] == 200) {
                                window.location.href = "<?= base_url() ?>my-account";
                            } else {
                                $('#error').html(jsonData['message']);
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
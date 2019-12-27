
<div class="conteiner-fluid login-fluid">
    <div class="container">
        <div class="login-page">
            <div class="row">
                <div class="col-md-4">
                    <div class="leftpart">
                        <h2>NEW CUSTOMER</h2>
                        <h3>Register Here</h3>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <div class="continue">
                            <a href="<?php echo base_url('register'); ?>">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rightpart">
                        <h2>Forgot Password</h2>
                        <span class="text-danger error" id="error"></span>
                        <span class="text-success success" id="success"></span>
                        <form method="post" id="forgot_password_form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Id</label>
                                <span class="text-danger error" id="email"></span>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <button type="button" onclick="forgot_password();" class="btn btn-default">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function forgot_password() {

        var email = $("#forgot_password_form").find(':input[name="email"]');
        var msg = '';
        if (email.val()) {
            $.ajax({
                url: "<?= base_url(); ?>ajax/resend_otp",
                type: 'post',
                data: 'email=' + email.val(),
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = JSON.parse(dt);
                    msg = jsonData.message;
                    if (jsonData.error_code == 200) {
                        window.location.href="<?=base_url()?>verification?forgot-password";
                    } else {
                        $('#error').html(msg);
                        $('#success').html('');
                    }
                }
            });
        } else {
            $('#email').html('* required field');
        }
    }
</script>
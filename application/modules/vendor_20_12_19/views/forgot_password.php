<div class="login-form">
    <?= $this->session->flashdata('response'); ?>
    <form id="registerForm" method="post" enctype="multipart/form-data">
        <span class="error text-danger" id="error"></span>
        <span class="error" style="color: #ffc107;" id="success"></span>
        <div class="form-group">
            <label>Email address</label>
            <span class="error text-danger" id="email"></span>

            <input type="email" class="form-control validate" placeholder="Email" name="email" value="<?= set_value('email') ?>">
            <?= form_error('email') ?>
        </div>
        <div class="form-group otp-verification" style="display:none;">
            <label>Enter Otp received</label>
            <span class="error text-danger" id="otp"></span>
            <input type="text" class="form-control validate" placeholder="Enter Otp" name="otp" value="<?= set_value('otp') ?>">
            <?= form_error('otp') ?>
        </div>

        <button type="button" onclick="validateSendEmail();" class="btn btn-success btn-flat m-b-30 m-t-30 verify">Continue</button>
        <button type="button" onclick="verifyOtp();" style="display:none;" class="btn btn-success btn-flat m-b-30 m-t-30 otp-verification">Verify</button>

    </form>
    <div class="register-link m-t-15 text-center">
        <p>Go back to
            <a href="<?php echo base_url('vendor'); ?>"> Sign In </a>
        </p>
    </div>

</div>

</div>

</div>

</div>

<script>

    function verifyOtp() {
        var formData = $("#registerForm").find(':input[name="email"]').val();
        var otp = $("#registerForm").find(':input[name="otp"]').val();
        if (formData && otp) {
            $.ajax({
                url: '<?= base_url() ?>vendor/login/verify',
                type: 'post',
                data: $("#registerForm").serialize(),
                success: function (data) {
                    var dt = $.trim(data);
                    var response = JSON.parse(dt);
//                   console.log(response);
                    if (response.error) {
                        $('#error').html(response.message);
                        $('#success').html('');
                    } else {
                        window.location.href = "<?= base_url() ?>vendor/reset-password/" + response.data['user'];
                        $('#error').html('');
                        $('#success').html(response.message);
                    }
                }
            });
        } else {
            if (formData == '') {
                $('#email').html('* required field');
            } else {
                $('#otp').html('* required field');
            }

        }
    }

    function validateSendEmail() {
        var formData = $("#registerForm").find(':input[name="email"]').val();
        if (formData) {
            $.ajax({
                url: '<?= base_url() ?>vendor/login/sendotp',
                type: 'post',
                data: 'email=' + formData,
                success: function (data) {
                    var dt = $.trim(data);
                    var response = JSON.parse(dt);
//                   console.log(response);
                    if (response.error) {
                        $('#email').html(response.message);
                        $('#success').html('');
                    } else {
                        $('#email').html('');
                        $('#success').html(response.message);
                        $('.otp-verification').css('display', 'block');
                        $('.verify').css('display', 'none');
                    }
                }
            });
        } else {
            $('#email').html('* required field');
        }
    }



</script>
<div class="login-form" style="padding:100px;">
    <?= $this->session->flashdata('response'); ?>
    <form id="registerForm" method="post" enctype="multipart/form-data">
        <span class="error text-danger" id="error"></span>
        <span class="error" style="color: #ffc107;" id="success"></span>
        <div class="form-group">
            <label>Enter New Password</label>
            <span class="error text-danger" id="password"></span>

            <input type="password" class="form-control validate" placeholder="Enter new password" name="password">
            <?= form_error('password') ?>
        </div>
        <div class="form-group otp-verification">
            <label>Confirm Password</label>
            <span class="error text-danger" id="c_password"></span>
            <input type="password" class="form-control validate" placeholder="Confirm Password" name="c_password">
            <?= form_error('c_password') ?>
        </div>

        <button type="button" onclick="validate();" class="btn btn-success btn-flat m-b-30 m-t-30 verify">Continue</button>

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


<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
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

                if (name == 'password') {
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

</script>
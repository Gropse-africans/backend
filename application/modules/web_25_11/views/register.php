
<div class="conteiner-fluid login-fluid register-fluid ">
    <div class="container">
        <div class="login-page">
            <div class="row">
                <div class="col-md-4">
                    <div class="leftpart">
                        <h2>RETURNING CUSTOMER</h2>
                        <h3>Login Here</h3>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <div class="continue">
                            <a href="<?php echo base_url('login'); ?>">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rightpart">
                        <h2>NEW CUSTOMER</h2>
                        <span class="error text-danger" id="error"></span>
                        <form method="post" id="register_form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Your Name</label>
                                <span class="error text-danger" id="name"></span>
                                <input type="text" class="form-control" onchange="checkName(this);" name="name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Id</label>
                                <span class="text-danger" id="email"></span>
                                <input type="email" class="form-control" onchange="checkEmail(this);" id="emaill" name="email" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mobile No</label>
                                <span class="text-danger" id="mobile"></span>
                                <input type="text" class="form-control" onchange="checkMobile(this);" name="mobile" placeholder="Mobile No">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <span class="text-danger" id="password"></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <button type="button" onclick="validate();" id="signup_btn" class="btn btn-default">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//    $(document).ready(function () {
//        $("#mobile_no").keypress(function () {
//            $("#mobile").html('Invalid Mobile No.');
//        });
//    });
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
    
//     $('.characterOnly').keypress(function (e) {
//        var regex = new RegExp(/^[a-zA-Z\s]+$/);
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        } else {
//            e.preventDefault();
//            return false;
//        }
//    });

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
        var formData = $("#register_form").find(':input').not(':input[type=button]');
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
            $.ajax({
                url: '<?= base_url() ?>ajax/register',
                type: 'POST',
                data: $("#register_form").serialize(),
                success: function (data) {
//                    var response=trim(jsonParse(data));
                    var dt = $.trim(data);

                    var jsonData = JSON.parse(dt);
                    if (jsonData['error_code'] == 200) {
                        window.location.href="<?=base_url()?>verification";
                    } else {
                        $('#error').html(jsonData['message']);
                    }
                }
            });
        } else {
            if(!valid_mobile){
                $('#mobile').html('mobile invalid');
            }else{
                $('#mobile').html('');
            }
            if(!valid_email){
                $('#email').html('email invalid');
            }else{
               $('#email').html('');
            }
            if(!valid_name){
                $('#name').html('name invalid');
            }else{
               $('#name').html('');
            }
        }
    }
</script>

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
                            <a href="<?php echo base_url('register');?>">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rightpart">
                        <h2>OTP Verification</h2>
                        <h4 class='text-info'>we've sent 4 digit code on email address <?=$this->session->userdata('verify_email')?></h4>
                        <span class="text-danger error" id="error"></span>
                        <span class="text-success success" id="success"></span>
                        <form method="post" id="otp_form">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Enter OTP</label>
                            <span class="text-danger error" id="otp"></span>
                            <input type="text" class="form-control" placeholder="" name="otp">
                          </div>
                          <button type="button" onclick="validate();" class="btn btn-default">Verify</button>
                          <a onclick="resend();" style="cursor:pointer;" class="linkpage">Resend OTP</a>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
<script>
    function validate() {
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&'); // Returns path only (/path/example.html)
        var type=(hashes['0'] == 'forgot-password'?2:1);
        var flag = true;
        var formData = $("#otp_form").find(':input').not(':input[type=button]');
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

        if (flag) {
            $.ajax({
                url: '<?= base_url() ?>ajax/verify',
                type: 'POST',
                data: $("#otp_form").serialize()+'&type='+type,
                success: function (data) {
//                    var response=trim(jsonParse(data));
                    var dt = $.trim(data);

                    var jsonData = JSON.parse(dt);
                    if (jsonData['error_code'] == 200) {
                        
                        if(type == 2){
                            window.location.href="<?=base_url()?>reset-password";
                        }else{
                            window.location.href="<?=base_url()?>";
                        }
                        
                    } else {
                        $('#error').html(jsonData['message']);
                        $('#success').html('');
                    }
                }
            });
        } else {
           return false;     
        }
    }
    
     function resend() {

        var email = "<?=$this->session->userdata('verify_email')?>";
        var msg='';
        if (email) {
            $.ajax({
                url: "<?= base_url(); ?>ajax/resend_otp",
                type: 'post',
                data: 'email='+email,
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = JSON.parse(dt);
                    msg = jsonData.message;
                    if (jsonData.error_code == 200) {
                        $('#success').html(msg);
                         $('#error').html('');
                    } else {
                        $('#error').html(msg);
                        $('#success').html('');
                    }
                }
            });
        } else {
            return false;
        }
    }
</script>
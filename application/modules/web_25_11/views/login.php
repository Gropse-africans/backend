
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
                        <h2>RETURNING CUSTOMER</h2>
                        <span class="error text-danger" id="error"></span>
                        <?= $this->session->flashdata('response'); ?>      
                        <form method="post" id="login_form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email Id</label>
                                <span class="text-danger" id="email"></span>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <span class="text-danger" id="password"></span>
                                <input type="password" name="password" class="form-control"  placeholder="Password">
                            </div>
                            <button type="button" class="btn btn-default" onclick="validate();">Login</button>
                            <a href="<?php echo base_url('forgot-password'); ?>" class="linkpage">Forgot Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validate() {
        var flag = true;
        var formData = $("#login_form").find(':input').not(':input[type=button]');
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
                url: '<?= base_url() ?>ajax/login',
                type: 'POST',
                data: $("#login_form").serialize(),
                success: function (data) {
//                    var response=trim(jsonParse(data));
                    var dt = $.trim(data);

                    var jsonData = JSON.parse(dt);
                    if (jsonData['error_code'] == 200) {
                        window.location.href = "<?= base_url() ?>";
                    }else if (jsonData['error_code'] == 203) {
                        window.location.href = "<?= base_url() ?>verification";
                    } else {
                        $('#error').html(jsonData['message']);
                    }
                }
            });
        } else {
          return false;
        }
    }
</script>
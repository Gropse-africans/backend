
<div class="login-form">
    <?= $this->session->flashdata('response') ?>
    <form action="" method="post">

        <div class="form-group">

            <label>Email address</label>

            <input type="text" class="form-control" placeholder="Email" name="email">

        </div>

        <div class="form-group">

            <label>Password</label>

            <input type="password" class="form-control" placeholder="Password" name="password">

        </div>

        <div class="checkbox">
            <!--
                                        <label>
            
                                            <input type="checkbox"> Remember Me
            
                                        </label>-->

            <label class="pull-right">

                <a href="<?= base_url() ?>vendor/forgot-password">Forgotten Password?</a>

            </label> 

        </div>

        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>

    </form>
    <div class="register-link m-t-15 text-center">
        <p>Don't have account ?
            <a href="<?php echo base_url('vendor/register'); ?>"> Sign Up Here</a>
        </p>
    </div>

</div>

</div>

</div>

</div>


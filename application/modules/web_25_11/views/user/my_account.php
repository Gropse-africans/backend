<div id="account-wishlist" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
        <li><a >Account</a></li>
        <li><a >My Account</a></li>
    </ul>
    <div class="row">
        <?php $this->load->view('sidebar');?>

        <div id="content" class="col-sm-9 my_wishlist">
            <h2>My Account</h2>
            <?=$this->session->flashdata('response');?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td class="text-left">Profile Image:</td>
                            <td class="text-left"><img width="100px" hieght="100px" src="<?=$user['image']?$user['image']:base_url().'assets/web/images/user.jpg'?>"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Name:</td>
                            <td class="text-left"><?=$user['name']?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Email Id:</td>
                            <td class="text-left"><?=$user['email']?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Mobile No:</td>
                            <td class="text-left"><?=$user['mobile']?></td>
                        </tr>
                        <tr>
                            <td class="text-left">Location:</td>
                            <td class="text-left"><?=$user['address']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right">
                    <a href="<?php echo base_url('edit-account'); ?>" class="btn btn-default">Edit Account Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
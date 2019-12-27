<div id="information-information" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('');?>"><i class="fa fa-home"></i></a></li>
        <li><a>Contact Us</a></li>
    </ul>
    <div class="row">
        <?=$this->load->view('user_side_link')?>
        <div id="content" class="col-sm-9">
            <h1 class="page-title">Contact Us</h1>
                    <form action="#" method="post"  class="form-horizontal">
                        <fieldset>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-name">Your Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value=""  class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">Enter Your ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value=""  class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">Enter Mobile No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="mobile no" value="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
                                <div class="col-sm-10">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control textareaauto"></textarea>
                                </div>
                            </div>

                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
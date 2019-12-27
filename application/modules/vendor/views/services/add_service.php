<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Add Service </h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-md-end d-md-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url() ?>vendor/dashboard">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Add Service

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <form id="Franchisee" method="post" class="right-text-label-form" name="addForm" enctype="multipart/form-data">
            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">
                        <?=$this->session->flashdata('response');?>
                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Add Service Information

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name"> Service Name</label>
                                            <span class="error text-danger" id="name"></span>
                                            <?= form_error('name') ?>
                                            <input type="text" name="name" class="form-control validate" placeholder="Enter Service Name">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name">Service Category</label>
                                            <span class="error text-danger" id="category_id"></span>
                                            <?= form_error('category_id') ?>
                                            <select class="form-control validate" name="category_id">
                                                <option selected disabled>Select Category</option>
                                                <?php foreach ($category as $categry): ?>
                                                    <option value="<?= $categry['id'] ?>" style="font-weight:550;"><?= $categry['name'] ?></option>
                                                    <option disabled class="bg-light text-secondary small text-monospace">&nbsp;&nbsp;<?= $categry['title'] ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">

                                            <label for="name">Short Description</label>
                                            <span class="error text-danger" id="short_description"></span>
                                            <?= form_error('short_description') ?>
                                            <textarea name="short_description" class="form-control" placeholder="Short Description.."></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Service Plans

                                </div>
                                <span class="error text-danger" id="plan_id_repeat"></span>
                            </div>

                            <div class="card-body plan_div">
                                <div class="row plan_1">
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Service Price</label>
                                            <span class="error text-danger" id="service_price"></span>
                                            <?= form_error('service_price') ?>
                                            <input type="text" name="service_price" class="form-control validate numberOnly" value="10" placeholder="Enter Price">

                                        </div>

                                    </div>

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Service Plan</label>
                                            <span class="error text-danger" id="service_plan_id"></span>
                                            <?= form_error('service_plan_id') ?>
                                            <select class="form-control plan-id-select validate" name="service_plan_id">
                                                <?php foreach ($service_plan as $plan): ?>
                                                    <option value="<?= $plan['plan_id'] ?>"><?= $plan['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Service Description </label>
                                            <span class="error text-danger" id="service_description"></span>
                                            <?= form_error('service_description') ?>
                                            <textarea name="service_description" class="form-control validate" placeholder="Service Description.."></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-info" data-id="1" type="button" onclick="addMore(this);">Add More</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>



            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Service Images

                                </div>
                                <span class="error text-danger" id="image_error"></span>
                            </div>

                            <div class="card-body">

                                <div class=" right-text-label-form" >

                                    <div class="form-group row titleeventimage">

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah1" src="<?php echo base_url(); ?>assets/vendor/images/logo/dummy.jpg" alt="your image" />

                                            <label for="upload1" class="file-upload__label">Upload Image </label>

                                            <input id="upload1" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, 1);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah2" src="<?php echo base_url(); ?>assets/vendor/images/logo/dummy.jpg" alt="your image" />

                                            <label for="upload2" class="file-upload__label">Upload Image </label>

                                            <input id="upload2" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, 2);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah3" src="<?php echo base_url(); ?>assets/vendor/images/logo/dummy.jpg" alt="your image" />

                                            <label for="upload3" class="file-upload__label">Upload Image </label>

                                            <input id="upload3" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, 3);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah4" src="<?php echo base_url(); ?>assets/vendor/images/logo/dummy.jpg" alt="your image" />

                                            <label for="upload4" class="file-upload__label">Upload Image </label>

                                            <input id="upload4" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, 4);">

                                        </div>




                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>






            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-body">

                                <div class="col-sm-12 ml-auto">

                                    <button type="button" class="btn btn-primary" name="signup" onclick="validate();">

                                        Upload 

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>





    </main>

</div>
<script>
    var service_plan =<?= json_encode($service_plan) ?>;
    function addMore(obj) {
        var count = parseInt($(obj).attr('data-id'));
        var plan_count = count + 1;
        if (plan_count <= 3) {
            var html = '';
            html += '<div class="row plan_' + plan_count + '"><div class="col-sm-3"><div class="form-group"><label for="name">Service Price</label>' +
                    '<input type="text" name="price[]" class="form-control numberOnly" value="1" placeholder="Enter Price">' +
                    '</div></div><div class="col-sm-3"><div class="form-group"><label for="name">Service Plan</label>' +
                    '<select class="form-control plan-id-select" name="plan_id[]">';
            $(service_plan).each(function (i, v) {
                html += '<option value="' + v['plan_id'] + '" ' + (plan_count == v['plan_id'] ? "selected" : "") + '>' + v['name'] + '</option>';
            });
            html += '</select></div></div><div class="col-sm-6"><div class="form-group"><label for="name">Service Description </label>' +
                    '<textarea name="description[]" class="form-control" placeholder="Service Description.."></textarea></div></div></div>';

            $('.plan_div').append(html);
            if (plan_count < 3) {
                $(obj).attr('data-id', plan_count);
            } else {
                $(obj).hide();
            }
        } else {
            return false;
        }
    }

    function checkSelect() {
        var flag = true;
        var formData = $(".plan_div").find('.plan-id-select:input');
        var plans = [];
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            if (val != '' || val != '0' || val != null) {
                plans.push(val);
            }
        });
        var all_plan = plans.length;
        var uni_plans = jQuery.unique(plans);
        if (uni_plans.length != all_plan) {
            flag = false;
            return flag;
            alert(flag);
        } else {
            flag = true;
            return flag;
        }
    }

    function validate() {
        var flag = true;
        var formData = $("#Franchisee").find('.validate:input').not(':input[type=button],:input[type=file]');
        var imgData = $("#Franchisee").find(':input[type="file"]');

        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0' || val == null) {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });
        var count = 0;
        var empty = 0;
        $(imgData).each(function () {
            var img = $(this);
            var val = img.val();
//            var name = img.attr('name');

            if (val == '' || val == '0') {
                empty++;
            } else {
                count++;
            }
        });

        if (count < 1) {
            $('#image_error').html('* required field');
            flag = false;
        } else {
            $('#image_error').html('');
        }

        var selection = checkSelect();
        if (selection) {
            $('#plan_id_repeat').html('');
        } else {
            $('#plan_id_repeat').html('* duplicate price for plan not allowed');
            flag = false;
        }
        // alert(flag);
        if (flag) {
            $('#Franchisee').submit();
        } else {
            return false;
        }
    }
</script>


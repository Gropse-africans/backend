<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Edit Service </h1>

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

                                    Edit Service

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
                        <?= $this->session->flashdata('response'); ?>
                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Service Information

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">

                                            <label for="name"> Service Name</label>
                                            <span class="error text-danger" id="name"></span>
                                            <?= form_error('name') ?>
                                            <input type="text" name="name" value="<?= $service['name'] ?>" class="form-control validate" placeholder="Enter Service Name">
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Select Vendor</label>
                                            <span class="error text-danger" id="vendor_id"></span>
                                            <?= form_error('vendor_id') ?>
                                            <select class="form-control validate" name="vendor_id">
                                                <option selected disabled>Select Vendor</option>
                                                <?php foreach ($vendors as $vendor): ?>
                                                    <option value="<?= $vendor['id'] ?>" <?=$service['vendor_id']==$vendor['id']?'selected':''?>><?= $vendor['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('vendor_id') ?>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Service Category</label>
                                            <span class="error text-danger" id="category_id"></span>
                                            <?= form_error('category_id') ?>
                                            <select class="form-control validate" name="category_id">
                                                <option selected disabled>Select Category</option>
                                                <?php foreach ($category as $categry): ?>
                                                    <option value="<?= $categry['id'] ?>" <?= $service['category_id'] == $categry['id'] ? 'selected' : '' ?> style="font-weight:550;"><?= $categry['name'] ?></option>
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
                                            <textarea name="short_description" class="form-control" placeholder="Short Description.."><?= $service['short_description'] ?></textarea>
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
                                <?php foreach ($service['plans'] as $key => $plan): ?>
                                    <div class="row plan_<?= $key + 1 ?>">
                                        <div class="col-sm-3">

                                            <div class="form-group">

                                                <label for="name">Service Price</label>
                                                <span class="error text-danger" id="service_price"></span>
                                                <?= form_error('service_price') ?>
                                                <input type="text" name="<?= $key ? 'price[]' : 'service_price' ?>" class="form-control <?= $key ? '' : 'validate' ?> numberOnly" value="<?= $plan['price'] ?>" placeholder="Enter Price">

                                            </div>

                                        </div>

                                        <div class="col-sm-3">

                                            <div class="form-group">

                                                <label for="name">Service Plan</label>
                                                <span class="error text-danger" id="service_plan_id"></span>
                                                <?= form_error('service_plan_id') ?>
                                                <select class="form-control plan-id-select <?= $key ? '' : 'validate' ?>" name="<?= $key ? 'plan_id[]' : 'service_plan_id' ?>">
                                                    <?php foreach ($service_plan as $plans): ?>
                                                        <option value="<?= $plans['plan_id'] ?>" <?= $plan['service_plan_id'] == $plans['plan_id'] ? 'selected' : '' ?>><?= $plans['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Service Description </label>
                                                <span class="error text-danger" id="service_description"></span>
                                                <?= form_error('service_description') ?>
                                                <textarea name="<?= $key ? 'description[]' : 'service_description' ?>" class="form-control <?= $key ? '' : 'validate' ?>" placeholder="Service Description.."><?= $plan['description'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-sm-12">
                                <?php if (count($service['plans']) < 3) { ?>
                                    <div class="form-group">
                                        <button class="btn btn-info" data-id="<?= count($service['plans']) ?>" type="button" onclick="addMore(this);">Add More</button>
                                    </div>
                                <?php } ?>
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
                                        <?php
                                        for ($i = 1; $i <= 4; $i++):
                                            $j = $i - 1;
                                            if (isset($service['service_images'][$j])):
                                                ?>
                                                <div class="col-sm-3 file-upload">

                                                    <img id="blah<?= $i ?>" src="<?= $service['service_images'][$j]['url'] ? $service['service_images'][$j]['url'] : base_url() . 'assets/vendor/images/logo/dummy.jpg' ?>" alt="your image" />

                                                    <label for="upload<?= $i ?>" class="file-upload__label">Upload Image </label>

                                                    <input id="upload<?= $i ?>" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, <?= $i ?>);">

                                                </div>
                                            <?php else: ?>
                                                <div class="col-sm-3 file-upload">

                                                    <img id="blah<?= $i ?>" src="<?php echo base_url(); ?>assets/vendor/images/logo/dummy.jpg" alt="your image" />

                                                    <label for="upload<?= $i ?>" class="file-upload__label">Upload Image </label>

                                                    <input id="upload<?= $i ?>" class="file-upload__input" type="file" name="file-upload[]" onchange="readURL(this, <?= $i ?>);">

                                                </div>
                                            <?php endif;endfor; ?>

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

                                        Update 

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


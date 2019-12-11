
<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Add Product </h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-md-end d-md-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url() ?>admin">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Add Product

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <form id="Franchisee" method="post" class="right-text-label-form" enctype="multipart/form-data">
            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Add Product Information

                                </div>

                            </div>

                            <div class="card-body">
                                <?= $this->session->flashdata('response'); ?>
                                <div class="row">

                                    <div class="col-sm-4">

                                        <div class="form-group">

                                            <label for="name"> Product Name</label>
                                            <span class="error text-danger" id="product_name"></span>
                                            <input type="text" class="form-control validate" placeholder="Enter Product Name" name="product_name">
                                            <?= form_error('product_name') ?>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Product Category</label>
                                            <span class="error text-danger" id="category"></span>
                                            <select class="form-control validate" id="categories" name="category" onchange="getSubCat(this);">
                                                <option selected="selected" value="">Select Category</option>
                                                <?php foreach ($category as $row) { ?>
                                                    <option value="<?= $row['id'] ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('category') ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Product Sub Category</label>
                                            <span class="error text-danger" id="sub_categorys"></span>
                                            <select class="form-control validate" id="sub_category" name="sub_categorys" onchange="subCatTitle(this);">
                                                <option selected="selected" value="">Select Sub-Category</option>
                                            </select>
                                            <?= form_error('sub_categorys') ?>
                                        </div>

                                    </div>

                                </div>




                            </div>

                        </div>

                    </div>

                    <div class=" col-md-12" id="productAttributesDiv" style="display: none;">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Product Attributes

                                </div>

                            </div>

                            <div class="card-body">
                                <div class="row" id="attributeData"></div>

                            </div>

                        </div>

                    </div>

                    <div class=" col-md-12" id="productSpecificationDiv" style="display: none;">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Product Specification

                                </div>

                            </div>

                            <div class="card-body">
                                <div class="row" id="attributeSpecData"></div>

                            </div>

                        </div>

                    </div>




      <!-- <span id="dots"></span><span id="more" style="display: none;"> -->  
                    <div class=" col-md-12" id="myDIV">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Add Product Features
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" >
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Brand Name</label>
                                            <span class="error text-danger" id="brand"></span>
                                            <select class="form-control validate" id="brand" name="brand">
                                                <option value="">Select Brand</option>
                                                <?php foreach ($brand as $brands) { ?>
                                                    <option value="<?= $brands['id'] ?>"><?php echo $brands['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Product Price</label>
                                            <span class="error text-danger" id="price"></span>
                                            <input type="number" class="form-control validate" placeholder="Enter Price" name="price">
                                            <?= form_error('price') ?>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Product Quantity</label>
                                            <span class="error text-danger" id="quantity"></span>
                                            <input type="number" class="form-control validate" placeholder="Enter Quantity" name="quantity">
                                            <?= form_error('quantity') ?>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Total Discount</label>
                                            <span class="error text-danger" id="discount"></span>
                                            <input type="number" class="form-control validate" placeholder="Discount" min="0" max="100" name="discount">
                                            <?= form_error('discount') ?>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">

                                        <div class="form-group">

                                            <label for="name">Select Vendor</label>
                                            <span class="error text-danger" id="vendor"></span>
                                            <select class="form-control validate" id="vendor_name" name="vendor">
                                                <option value="">Select Vendor</option>
                                                <?php foreach ($vendor as $val) { ?>
                                                    <option value="<?= $val['id'] ?>"><?php echo $val['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- </span>
                    <button onclick="myFunction()" id="myBtn">Read more</button>
                    -->
                </div>



            </div>
            <div class="container-fluid">

                <div class="row">

                    <div class=" col-md-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Product Description

                                </div>
                                <span class="error text-danger" id="description"></span>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="editor-wrapper">

                                            <textarea id="editor" class="editor validate" name="description"></textarea>

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

                                    Product Images

                                </div>
                                <span class="error text-danger" id="image_error"></span>
                            </div>

                            <div class="card-body">

                                <div class=" right-text-label-form" >





                                    <div class="form-group row titleeventimage">

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah1" src="<?php echo base_url(); ?>assets/admin/images/logo/dummy.jpg" alt="your image" />





                                            <label for="upload1" class="file-upload__label">Upload Image 1</label>

                                            <input id="upload1" class="file-upload__input" type="file" name="file_upload[]" onchange="readURL(this, 1);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah2" src="<?php echo base_url(); ?>assets/admin/images/logo/dummy.jpg" alt="your image" />





                                            <label for="upload2" class="file-upload__label">Upload Image 2</label>

                                            <input id="upload2" class="file-upload__input" type="file" name="file_upload[]" onchange="readURL(this, 2);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah3" src="<?php echo base_url(); ?>assets/admin/images/logo/dummy.jpg" alt="your image" />





                                            <label for="upload3" class="file-upload__label">Upload Image 3</label>

                                            <input id="upload3" class="file-upload__input" type="file" name="file_upload[]" onchange="readURL(this, 3);">

                                        </div>

                                        <div class="col-sm-3 file-upload">

                                            <img id="blah4" src="<?php echo base_url(); ?>assets/admin/images/logo/dummy.jpg" alt="your image" />





                                            <label for="upload4" class="file-upload__label">Upload Image 4</label>

                                            <input id="upload4" class="file-upload__input" type="file" name="file_upload[]" onchange="readURL(this, 4);">

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

                                    <button type="button" onclick="validate();" class="btn btn-primary" name="signup" value="Sign up">

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


<script type="text/javascript">
    var getCategory = <?php echo $subcategory; ?>;

    function getSubCat(obj) {
        var category_id = $(obj).val();
        $(getCategory).each(function (index, value) {
            if (value.id == category_id) {
                var id = value.subCategory;
                $("#sub_category").empty();
                $("#sub_category").append('<option selected="selected">Select Sub-Category</option>');
                $(id).each(function (i, v) {
                    $("#sub_category").append("<option value=" + v.id + ">" + v.name + "</option>");
                })
            }
        });
        $("#attributeData").empty();
        $("#productAttributesDiv").css('display', 'none');
    }
</script>

<script type="text/javascript">
    function subCatTitle(obj) {
        $("#attributeData").empty();
        $("#productAttributesDiv").css('display', 'none');
        var subSategory_id = $(obj).val();
        //console.log(subSategory_id);
        $.ajax({
            url: "<?= base_url(); ?>admin/Admin/ajax",
            type: 'post',
            data: 'method=add_product&subcategory=' + subSategory_id,
            success: function (data) {
                var dt = $.trim(data);
                var jsonData = $.parseJSON(dt);
                console.log(jsonData);

                if (jsonData['error_code'] == "200") {
                    var html = '';
                    $(jsonData['data']['getcategoryAttribute']).each(function (index, value) {
//                        console.log(value['title']);
                        var attribute_value = value['attribute_value'];
                        //console.log(attribute_value);
                        html += '<div class="col-sm-4" id="type1">';
                        html += '<div class="form-group">';
                        html += '<label for="name">' + value['title'] + '</label><span class="error text-danger" id="attribute_value_' + value['id'] + '"></span>';
                        html += '<input type="hidden" name="attribute_id[]" value="' + value['id'] + '">';
                        html += '<select name="attribute_value_' + value['id'] + '" class="form-control" id="attribute_name">';
                        var arrtVal = '';
                        $(attribute_value).each(function (i, v) {
                            arrtVal += '<option value="' + v['id'] + '">' + v['value'] + '</option>';
                        });
                        html += arrtVal;
                        html += '</select>';

                        html += '</div>';
                        html += '</div>';
                    })
//                    console.log(html);
                    $("#attributeData").empty();
                    $("#attributeData").append(html);
                    $("#productAttributesDiv").css('display', 'block');
                } else {
                    return false;
                }

                if (jsonData['error_code'] == "200") {
                    var htmlSpec = '';
                    $(jsonData['data']['getcategorySpecification']).each(function (specIndex, specValue) {
                        console.log(specValue);
                        var attribute_specValue = specValue['attribute_value'];
                        htmlSpec += '<div class="col-sm-4" id="type2">';
                        htmlSpec += '<div class="form-group">';
                        htmlSpec += '<label for="name">' + specValue['title'] + '</label><br>';
                        htmlSpec += '<input type="hidden" name="specifications[]" value="' + specValue['id'] + '">';
                        htmlSpec += '<input type="text" placeholder="Enter Specification Name" name="specification_value_' + specValue['id'] + '" class="form-control" id="attributeSpec_name">';
                        // var arrSpecVal='';
                        // $(attribute_specValue).each(function(ind,val){
                        //    arrSpecVal+='<option>'+val['value']+'</option>';
                        // });
                        htmlSpec += '</div>';
                        htmlSpec += '</div>';
                    })
                    console.log(htmlSpec);
                    $("#attributeSpecData").empty();
                    $("#attributeSpecData").append(htmlSpec);
                    $("#productSpecificationDiv").css('display', 'block');
                } else {

                }
            }
        });

    }


    function validate() {
        var flag = true;
        var formData = $("#Franchisee").find('.validate:input').not(':input[type=button],:input[type=file],:input[type=hidden],:input[name=discount]');
        var imgData = $("#Franchisee").find(':input[type="file"]');
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
        var count = 0;
        var empty = 0;
        $(imgData).each(function () {
            var img = $(this);
            var val = img.val();
//            alert(img.val());
//            var name = img.attr('name');

            if (val == '' || val == '0') {
                empty++;
            } else {
                count++;
            }
        });
        if (count < 2) {
            $('#image_error').html('* required field');
            flag = false;
        } else {
            $('#image_error').html('');
        }
        // alert(flag);
        if (flag) {
            $('#Franchisee').submit();
        } else {
            return false;
        }
    }
</script>






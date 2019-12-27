<style>
    .imgResponsive{
        width: 50px;
        height: auto;
        /*        height: 50px;*/
        /*        border-radius: 58%;
                border: 3px solid #12551e;*/
    }
</style>
<div class="container-fluid">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Attribute List</h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-end d-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url('admin/dashboard'); ?>">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Attribute List

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="container-fluid">

            <div class="row mb-2">
                <div class=" col-md-12">
                    <?= $this->session->flashdata('response') ?>
                    <div class="card card-shadow card-body mb-4">
                        <form method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Category</label>
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Sub Category</label>
                                        <span class="error text-danger" id="sub_categorys"></span>
                                        <select class="form-control validate" id="sub_category" name="sub_category_id" onchange="subCatTitle(this);">
                                            <option selected="selected" value="">Select Sub-Category</option>
                                        </select>
                                        <?= form_error('sub_category_id') ?>
                                    </div>

                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select class="form-control mb-2" name="type" id="attribute_type">
                                            <option selected disabled>Select Type</option>
                                            <option value="1" <?= set_value('type') == 1 ? 'selected' : '' ?>>Select</option>
                                            <option value="2" <?= set_value('type') == 2 ? 'selected' : '' ?>>Text</option>
                                        </select>  
                                        <?= form_error('type') ?>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Attribute Title</label>
                                        <input type="text" class="form-control mb-2" placeholder="Attribute Name" name="name" value="<?= set_value('name') ?>">  
                                        <?= form_error('name') ?>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <input type="checkbox" class="form-checkbox mt-5" id="is_required" name="is_required" checked value="1">  
                                        <label for="is_required">Set Required</label>
                                    </div> 
                                </div> 
                            </div>
                            <button type="submit" class="btn btn-success ml-auto mt-4 ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class=" col-md-12">

                    <div class="card card-shadow card-body mb-4 width50">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1> Attribute List</h1>

                            </div>

                        </div>
                        <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Attribute Title</th>
                                    <th>Sub Category Name</th>
                                    <th>Type</th>
                                    <th>Filter</th>
                                    <th>Required</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($attributes) {
                                    $sr = 1;
                                    foreach ($attributes as $value) {
                                        ?>
                                        <tr>
                                            <td><?= $sr ?></td>
                                            <td><?= $value['title']; ?></td>
                                            <td><?= $value['category']; ?></td>
                                            <td><?= $value['type'] == 1 ? 'Select' : 'Text'; ?></td>
                                            <td><input type="checkbox" <?= $value['is_filter'] == '1' ? 'checked' : '' ?> onchange="isFilter(this,<?= $value['id'] ?>)"></td>
                                            <td><input type="checkbox" <?= $value['is_required'] == '1' ? 'checked' : '' ?> onchange="isRequired(this,<?= $value['id'] ?>)"></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?= $value['status'] == '1' ? 'checked' : '' ?> onchange="checkStatus(this,<?= $value['id'] ?>)"> <span class="slider round"></span> </label>
                                                </div>

                                            </td>
                                            <td><?php if ($value['type'] == 1) { ?>
                                                    <a class="btn btn-dark btn-sm" title="view values" href="<?= base_url('admin/attribute-detail/' . $value['id']); ?>">Values</a>
                                                <?php } else {
                                                    echo 'Text Field';
                                                } ?>                                                
        <!--<a href="<?= base_url('admin/product-category/' . $value['id']); ?>"><i class="fa fa-edit fa-2x"></i></a>-->
                                    <!--<a style="cursor:pointer" onclick="deleteCategory(this, '<?= $value['id']; ?>')" ><i class="fa fa-trash fa-2x"></i></a>-->
                                            </td>
                                        </tr>
                                        <?php
                                        $sr++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>



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
<script>

    function checkStatus(obj, id) {
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=10',
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "200") {
                        location.reload();
                    } else {
                        alert(jsonData['message']);
                    }
                }
            });
        } else {
            alert("Something Wrong");
        }
    }
    function isFilter(obj, id) {
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=changeFilter&id=' + id + '&action=' + status,
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "200") {
                        location.reload();
                    } else {
                        alert(jsonData['message']);
                    }
                }
            });
        } else {
            alert("Something Wrong");
        }
    }
    
    function isRequired(obj, id) {
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=changeRequired&id=' + id + '&action=' + status,
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "200") {
                        location.reload();
                    } else {
                        alert(jsonData['message']);
                    }
                }
            });
        } else {
            alert("Something Wrong");
        }
    }
    function deleteCategory(obj, id) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            var status = '99';
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=3',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            alert('Category Deleted.');
                            window.location.href = "<?= base_url(); ?>admin/product-category";
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
    }
    $(document).ready(function () {
        $('#example1').DataTable();
    });
</script>

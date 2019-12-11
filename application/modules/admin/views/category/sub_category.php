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

                                <h1>Sub Category Add</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?= base_url('admin/dashboard');?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                      Sub Category List

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


   
                    <div class="container-fluid">

                        <div class="row mb-2">
                            <?php if(isset($singleCategory)){
                                ?>
                            <div class=" col-md-6">
                                <div class="card card-shadow card-body mb-4">
                                    <form method="post"  enctype="multipart/form-data">
                                        <label for="validationCustom01" class="mt-2">Select Category</label>
                                        <select class="form-control" required name="category">
                                            <option ><?=$singleCategory['category_name'];?></option>
                                        </select>
                                        <label for="validationCustom01" class="mt-2">Sub-Category Name</label>
                                        <input type="text" name="name" required="" value="<?=$singleCategory['name']?>" class="form-control" placeholder="Category Name" >
                                        <?= form_error('name') ?>
                                        
                                        <label for="validationCustom01" class="mt-2">Image</label>
                                        <img style="width:25px; height: 25px;" src="<?=$singleCategory['image']; ?>" />
                                        <input type="file" name="image"  value="<?= set_value('image') ?>" class="form-control" placeholder="Category Name" Value=" ">
                                        <?= form_error('image') ?>
                                        <button type="submit" class="btn btn-success ml-auto mt-4 ">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                            }else{
                                ?>
                            <div class=" col-md-6">
                                <div class="card card-shadow card-body mb-4">
                                    <form method="post"  enctype="multipart/form-data">
                                        <label for="validationCustom01" class="mt-2">Select Category</label>
                                        <select class="form-control" required name="category">
                                            <option value="">--SELECT CATEGORY</option>
                                            <?php if($categoryData){
                                                foreach($categoryData as $val){
                                                    ?>
                                            <option value="<?=$val['id'];?>"><?=$val['name'];?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?= form_error('name') ?>
                                        
                                        <label for="validationCustom01" class="mt-2">Sub-Category Name</label>
                                        <input type="text" name="name" required="" value="<?= set_value('name') ?>" class="form-control" placeholder="Category Name" Value=" ">
                                        <?= form_error('name') ?>
                                        
                                        <label for="validationCustom01" class="mt-2">Image</label>
                                        <input type="file" name="image" required value="<?= set_value('image') ?>" class="form-control" placeholder="Category Name" Value=" ">
                                        <?= form_error('image') ?>
                                        <button type="submit" class="btn btn-success ml-auto mt-4 ">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            
                        </div>
                        <div class="row mb-2">
                            <div class=" col-md-12">

                                <div class="card card-shadow card-body mb-4 width50">
<div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Sub Category List</h1>

                            </div>

                        </div>
                                    <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Image</th>
                                                <th>Category Name</th>
                                                <th>Sub-Category Name</th>
                                                <!--<th>Action</th>-->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($categories){
                                                $sr=1;
                                                foreach ($categories as $value) {
                                                   ?>
                                                    <tr>
                                                        <td><?=$sr?></td>
                                                        <td>
                                                            <img class="imgResponsive" src="<?=$value['image']?>">
                                                        </td>
                                                        <td><?=$value['category'];?></td>
                                                        <td><?=$value['name'];?></td>
<!--                                                        <td>
                                                            <button class="btn"><i class="fa fa-edit"></i></button>
                                                        </td>-->
                                                        <td>
                                                           <div class="mytoggle">
                                                            <label class="switch">
                                                                <input type="checkbox" <?= $value['status'] == '1' ? 'checked' : '' ?> onchange="checkStatus(this,<?= $value['id'] ?>)"> <span class="slider round"></span> </label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                           <a href="<?= base_url('admin/sub-category/'.$value['id']); ?>"><i class="fa fa-edit fa-2x"></i></a>
                                                           <a style="cursor:pointer" onclick="deleteCategory(this,'<?=$value['id'];?>')" ><i class="fa fa-trash fa-2x"></i></a>
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
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=3',
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
                                alert('Sub-Category Deleted.');
                                window.location.href="<?= base_url(); ?>admin/sub-category";
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

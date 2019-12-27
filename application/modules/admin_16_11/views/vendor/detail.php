<style>
    .edit_anchor{
        position: absolute;
        margin-left: 20px;
        background: #ff9800;
        border-radius: 14px;
        padding: 1px 5px;
        cursor: pointer;
    }
    .errorPrint{
        font-size: 12px;
        color: #196e2f;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Vendor Detail</h1>

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

                                        Vendor Detail

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

            </div>





                <!--page title end-->
                <div class="container-fluid">
                    <!-- state start-->
                    <div class="row">
                        <div class=" col-md-8" id="updateDive" style="display:none;">

                        <div class="card card-shadow mb-4">

                            <div class="card-header">

                                <div class="card-title">

                                    Edit Vendor Profile

                                </div>

                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control validate" id="name" value="<?=$user['name'];?>" placeholder="Name">
                                            <p class="errorPrint" id="nameError"></p>
                                            <input type="hidden" class="form-control" id="user_id" value="<?=$user['id'];?>" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Mobile</label>
                                            <input type="number" class="form-control validate" id="mobile" value="<?=$user['mobile'];?>" placeholder="Mobile">
                                            <p class="errorPrint" id="mobileError"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Company Name</label>
                                            <input type="text" class="form-control validate" id="shop_name" value="<?=$user['shop_name'];?>" placeholder="Company Name">
                                             <p class="errorPrint" id="shop_nameError"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" class="form-control validate" id="address" value="<?=$user['address'];?>" placeholder="Address">
                                             <p class="errorPrint" id="addressError"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 ml-auto">
                                        <button type="button" onclick="editProfile();" class="btn btn-primary" name="signup" value="Sign up">Upload</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                        
                        <div class="col-lg-8"  id="detailDive">
                            <div class="panel profile-cover">
                                <div class="profile-cover__img">
                                    <?php echo form_open_multipart('admin/vendor_detail/'.$user['id'], array('method' => 'post')); ?>
                                        <!--<label for="changeImg" class="edit_anchor"><i class="fa fa-edit"></i></label>-->
                                        <!--<input  type="hidden" name="user_id" value="<?=$user['id'];?>">-->
                                        <!--<input id="changeImg" style="display:none;" onchange="loadFile(event, 'changeImg')" class="file-upload__input" type="file" name="image">-->
                                        <!--<button type="submit" id="imgBtn" hidden name="imgBtn">Save</button>-->
                                    </form>
                                   <?php if($user['image']){
                                         ?>
                                    <img src="<?=$user['image'];?>" alt="">
                                    <?php
                                    }else{
                                        ?>
                                        <img src="https://library.kissclipart.com/20180901/krw/kissclipart-user-thumbnail-clipart-user-lorem-ipsum-is-simply-bfcb758bf53bea22.jpg" alt="">
                                    <?php
                                    }
                                    ?>
                                    <h3 class="h3"><?=$user['name'];?></h3>
                                </div>
                                <div class="profile-cover__action bg--img" data-overlay="0.3">
                                    <button class="btn btn-rounded btn-info">
                                        <i class="fa fa-circle"></i>
                                        <span>
                                            <?php if($user['status']==1){
                                                echo 'Verify';
                                            }elseif($user['status']==2){
                                                echo 'Blocked';
                                            }else{
                                                 echo 'Un-verify';
                                            }
                                            ?>
                                        </span>
                                    </button>
                                    <!--<a onclick="showProfile(this);" class="btn btn-rounded btn-info">-->
                                    <!--    <i class="fa fa-edit"></i>-->
                                    <!--    <span>Edit Detail</span>-->
                                    <!--</a>-->
                                </div>
                                <div class="profile-cover__info">
                                    <ul class="nav">
                                        <li>
                                            <strong><?=$product_count;?></strong>Product
                                        </li>
                                        <li>
                                            <strong><?=$order_count?></strong>Order
                                        </li>
                                        <li>
                                            <strong><?=$booking_count?></strong>Booking
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                <div class="card card-shadow mb-4">
                                    <div class="chart_headibg">
                                        <h3>Product List</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Product Id</th>

                                                    <th>Product Name</th>
                                                    <th>Amount</th>
                                                    <th>Quantity </th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1;
                                                if($product){
                                                foreach ($product as $value):
                                                    ?>
                                                <tr>
                                                    <td>#<?=$value['product_id'];?></td>

                                                    <td><?=$value['name'];?></td>
                                                    <td><?=$value['price'];?></td>
                                                    <td><?=$value['quantity'];?></td>
                                                    <td>
                                                        <?php if($value['quantity']>0){ ?>
                                                            <span class="label label-default">Available</span>
                                                        <?php }else{ ?>
                                                            <span class="label label-danger"> O. O. S.</span> 
                                                        <?php }?></td>
                                                    <td><a href="<?= base_url('admin/product-detail/'.$value['product_id']);?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                                </tr>
                                                <?php $count++;
                                                        endforeach;
                                                   }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">About Me</h3>
                                    <!--<a class="panel-title" onclick="deleteUser(this,'<?=$user['id'];?>')" style="position: absolute;margin-left: 192px;cursor: pointer;">-->
                                    <!--    <i class="fa fa-trash fa-2x"></i></a>-->
                                </div>
                                <div class="panel-content panel-about">
<!--                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem odit esse quae, et praesentium eligendi, corporis minima
                                        repudiandae similique voluptatum dolorem temporibus doloremque.
                                    </p>-->
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-envelope"></i>Email</th>
                                                <td><?=$user['email'];?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-mobile-phone"></i>Mobile No.</th>
                                                <td>
                                                    <a href="#" class="btn-link"><?=$user['mobile'];?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-map-marker"></i>Company Name</th>
                                                <td><?php if($user['shop_name']){
                                                    echo $user['shop_name'];
                                                }else{
                                                    echo "N/A";
                                                }
                                                ?></td>
                                            </tr>
                                             <tr>
                                                <th>
                                                    <i class="fa fa-map-marker"></i>Location</th>
                                                <td>
                                                <?php if($user['address']){
                                                    echo $user['address'];
                                                }else{
                                                    echo "N/A";
                                                } ?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-map-marker"></i>Date</th>
                                                <td><?=date('Y-m-d H:i:s',$user['created_at']);?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-map-marker"></i>Status</th>
                                                <td><select class="form-control" onchange="checkStatus(this,'<?=$user['id'];?>')">
                                                        <option value="" disabled="">Status</option>
                                                        <option value="1" <?php if($user['status']==1){ echo 'selected'; }?>>Verify</option>
                                                        <option value="2"<?php if($user['status']==2){ echo 'selected'; }?>>Block</option>
                                                    </select></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
<!--                         <div class="panel">
                                    <div class="panel-heading ">
                                        <h3 class="panel-title">Company Detail</h3>
                                    </div>
                                    <div class="panel-content panel-about">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-user"></i>Name</th>
                                                    <td>Souqalasal</td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        <i class="fa fa-map-marker"></i>Locatoin</th>
                                                    <td>123 Lorem Steet, NY, United States.</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-mobile-phone"></i>Mobile No.</th>
                                                    <td>
                                                        <a href="#" class="btn-link">731-839-7510</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-globe"></i>Email</th>
                                                    <td>
                                                        <a href="#" class="btn-link">Ronery08@gmail.com</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>-->

                            </div>

                    </div>
                    
                    <!-- state end-->
                </div>


        </main>

    </div>

</div>
<script>
        function checkStatus(obj, id) {
            var status = $(obj).val();
            if (id && status) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=2',
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
                //alert("Something Wrong");
            }
        }
        function deleteUser(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
              var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=2',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                window.location.href="<?= base_url(); ?>admin/vendor-list";
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
        function loadFile(event, forimage) {
            $("#imgBtn").click();
        }
        function showProfile(obj){
            $("#detailDive").hide();
            $("#updateDive").show();
        }
        function editProfile(obj){
                $(".errorPrint").css('display','none');
                var idValidate=false;
                $(".validate").each(function (index, value) {
                    // console.log('div' + index + ':' + $(this).attr('id'));
                    if($(this).val()){
                        $("#"+$(this).attr('id')+'Error').css('display','none');
                    }else{
                        idValidate=true;
                        $("#"+$(this).attr('id')+'Error').empty();
                        $("#"+$(this).attr('id')+'Error').append('*'+$(this).attr('placeholder')+' is required field');
                        $("#"+$(this).attr('id')+'Error').css('display','block');
                    }
                });
                if(idValidate){
                    return false;
                }else{
                    var user_id         = $("#user_id").val();
                    if(user_id){
                        var name            = $("#name").val();
                        var mobile          = $("#mobile").val();
                        var shop_name       = $("#shop_name").val();
                        var address         = $("#address").val();
                        $.ajax({
                            url: "<?= base_url(); ?>admin/Admin/ajax",
                            type: 'post',
                            data: 'method=updateVendor&name=' + name + '&mobile=' + mobile+'&shop_name='+shop_name+'&address='+address+'&user_id='+user_id,
                            success: function (data) {
                                var dt = $.trim(data);
                                var jsonData = $.parseJSON(dt);
                                if (jsonData['error_code'] == "200") {
                                    location.reload();
                                } else {
                                    $("#alertMessage").css('display','block')
                                }
                            }
                        });
                    }else{
                        alert('Something Went Wrong..')
                    }
                }
           }
    </script>
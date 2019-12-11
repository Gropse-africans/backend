 <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>User Detail</h1>

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

                                        User Detail

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
                        <div class="col-lg-8">
                            <div class="panel profile-cover">
                                <div class="profile-cover__img">
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
                                </div>
                                <div class="profile-cover__info">
                                    <ul class="nav">
                                        <li>
                                            <strong>0</strong>Order
                                        </li>
                                        <li>
                                            <strong>0</strong>Transaction
                                        </li>
                                        <li>
                                            <strong>$0</strong>Wallet Balance
                                        </li>
                                    </ul>
                                </div>
                            </div>
                                                            <div class="card card-shadow mb-4">
                                    <div class="chart_headibg">
                                        <h3>Order Detail</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>

                                                    <th>Date</th>
                                                    <th> Amount</th>
                                                    <th>Address </th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($order){
                                                    foreach ($array as $value) {
                                                        ?>
                                                <tr>
                                                    <td>U1001</td>

                                                    <td>10/10/2018</td>
                                                    <td>9896</td>
                                                    <td>Dubai</td>
                                                    <td><span class="label label-default">pending</span></td>
                                                    <td><a href="http://gropse.com/gropse.com/design/africanssupermarket.com/admin/order-detail"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                                </tr>
                                                <?php
                                                   }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--------table end---------->
                        </div>
                        <div class="col-lg-4">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">About Me</h3>
                                    <a class="panel-title" onclick="deleteUser(this,'<?=$user['id'];?>')" style="position: absolute;margin-left: 192px;cursor: pointer;">
                                        <i class="fa fa-trash fa-2x"></i></a>
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
                                                    <i class="fa fa-map-marker"></i>Locatoin</th>
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
                                                <td>
                                                    <?php if($user['status']==0){?>
                                                            <span class="label label-default">Un-verify</span>
                                                        <?php }else{ ?>
                                                        <select class="form-control" onchange="checkStatus(this,'<?=$user['id'];?>')">
                                                            <option value="1" <?php if($user['status']==1){ echo 'selected'; }?>>Verify</option>
                                                            <option value="2"<?php if($user['status']==2){ echo 'selected'; }?>>Block</option>
                                                        </select>
                                                        <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                                                        <div class="panel">
                                    <div class="weather--panel text-white bg-blue">
                                        <div class="weather--title">
                                            <span>Account Detail</span>
                                        </div>
                                        <div class="account-info">
                                            <p></p>
                                            <p>name : <span>Vaman Rao</span></p>
                                            <p>Bank Name : <span>State Bank Of India</span></p>
                                            <p>Ac. No. : <span>82397584692</span></p>
                                            <p>Ifsc Code : <span>SBIM7584692</span></p>
                                            <p>cvv No. : <span>3974</span></p>
                                            <p>Ex. Date : <span>27/02/2032</span></p>

                                        </div>

                                    </div>
                                </div>
                    </div>
                    <!-- state end-->
                </div>
                </div>


        </main>

    </div>
<script>
        function checkStatus(obj, id) {
            var status = $(obj).val();
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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
        function deleteUser(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
              var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                window.location.href="<?= base_url(); ?>admin/user-list";
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
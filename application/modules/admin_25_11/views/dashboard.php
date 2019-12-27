
<div class="container_full">

    <div class="content_wrapper">

        <div class="container-fluid">

            <!-- breadcrumb -->

            <div class="page-heading">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Dashboard</h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-md-end d-md-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?php echo base_url(''); ?>">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Dashboard

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

            <div class="site_view">

                <div class="row">

                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_green d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-users"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of Users</span>

                                <span class="info_items_number"><?=$users_count;?></span>

                            </div>

                        </div>

                    </div>

                    <!-- /info-box-content -->

                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_yellow d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-user"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of  Vendors</span>

                                <span class="info_items_number"><?=$vendor_count;?></span>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_pink d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-archive"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">Total Order</span>

                                <span class="info_items_number">2055</span>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_blue d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-money"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">Total Sales</span>

                                <span class="info_items_number">$ 15500</span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <section class="student_list">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full_chart card">
                            <div class="chart_header">
                                <div class="chart_headibg">
                                    <h3>Recent Added User</h3>
                                </div>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                </div>
                            </div>
                            <div class="card_chart">
                                <div class="student_table table-responsive-lg">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>User Name</th>
                                                <th>Email Id</th>
                                                <th>Mobile No</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($users){
                                                foreach ($users as $value) {
                                            ?>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">#<?=$value['id'];?></span></td>
                                                    <td><?=$value['name'];?></td>
                                                    <td><?=$value['email'];?></td>
                                                    <td><?=$value['mobile'];?></td>
                                                    <td>
                                                        <?php if($value['status']==1){
                                                            echo '<span class="label label-success">Verify</span>';
                                                        }elseif($value['status']==2){
                                                            echo '<span class="label label-danger">Blocked</span>';
                                                        }else{
                                                             echo '<span class="label label-default">Un-verify</span>';
                                                        }
                                                    ?>
                                                        </td>
                                                    <td><a href="<?php echo base_url('admin/user-detail/'.$value['id']); ?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="student_list">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full_chart card">
                            <div class="chart_header">
                                <div class="chart_headibg">
                                    <h3>Recent Added Vendor</h3>
                                </div>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                </div>
                            </div>
                            <div class="card_chart">
                                <div class="student_table table-responsive-lg">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Vendor Id</th>
                                                <th>Vendor Name</th>
                                                <th>Email Id</th>
                                                <th>Mobile No</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($vendor){
                                                foreach ($vendor as $value) {
                                            ?>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">#<?=$value['id'];?></span></td>
                                                    <td><?=$value['name'];?></td>
                                                    <td><?=$value['email'];?></td>
                                                    <td><?=$value['mobile'];?></td>
                                                    <td>
                                                        <?php if($value['status']==1){
                                                            echo '<span class="label label-success">Verify</span>';
                                                        }elseif($value['status']==2){
                                                            echo '<span class="label label-danger">Blocked</span>';
                                                        }else{
                                                             echo '<span class="label label-default">Un-verify</span>';
                                                        }
                                                    ?>
                                                        </td>
                                                    <td><a href="<?php echo base_url('admin/vendor-detail/'.$value['id']); ?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



        </div>

    </div>

</div>
<!-- Content_right_End -->

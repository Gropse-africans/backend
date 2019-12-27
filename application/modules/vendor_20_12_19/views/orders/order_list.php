<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Order List</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?php echo site_url('vendor/dashboard'); ?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                        Order List

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

                    <div class=" col-sm-12">
                        <?=$this->session->flashdata('response');?>
                        <div class="card card-shadow mb-4">

                            <div class="card-body">

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>
                                            <th>Order Id</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Order Date</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php foreach($orders as $order): ?>
                                        <tr>
                                            <td>
                                                <span class="txt-dark weight-500">#<?=$order['order_id']?></span>
                                            </td>
                                            <td><?=$order['user_name']?></td>
                                            <td><?=$order['email']?></td>
                                            <td>
                                                <span class="txt-success">
                                                    <span><?=date('H:i:s d M,Y',strtotime($order['created_at']))?></span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="txt-dark weight-500">$<?=$order['total_amount']?></span>
                                            </td>
                                            <td>
                                                <?php if($order['status'] == 1){?>
                                                <span class="label label-warning">New Order</span>
                                                <?php }else if($order['status'] == 4){?>
                                                <span class="label label-success">Delivered</span>
                                                <?php }else if($order['status'] == 5){?>
                                                <span class="label label-danger">Order Cancelled</span>
                                                <?php }else {?>
                                                <span class="label label-primary">Order Shipped</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('vendor/order-detail/'.$order['order_id']); ?>"><span class="label action-button">View Detail</span></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>


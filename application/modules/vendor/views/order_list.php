      <?php include 'include/header.php';?>

      <?php include 'include/sidebar.php';?>
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

                                        <a class="parent-item" href="<?php echo site_url('dashboard');?>">Home</a>

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

                        <div class="card card-shadow mb-4">

                            <div class="card-body">

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                    <thead>

                                                    <tr>
                                                        <th>Order Id</th>
                                                        <th>User Name</th>
                                                        <th>Order Date</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                        </tr>

                                    </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span class="txt-dark weight-500">#O101212</span>
                                                        </td>
                                                        <td>James Thoms</td>
                                                        <td>
                                                            <span class="txt-success">
                                                                <span>23-10-2019</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="txt-dark weight-500">$478</span>
                                                        </td>
                                                        <td>
                                                            <span class="label label-warning">New Order</span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('order-detail');?>"><span class="label action-button">View Detail</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="txt-dark weight-500">#O101243</span>
                                                        </td>
                                                        <td>Mark Loother</td>
                                                        <td>
                                                            <span class="txt-success">
                                                                <span>25-10-2019</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="txt-dark weight-500">$578</span>
                                                        </td>
                                                        <td>
                                                            <span class="label label-success">Completed</span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('order-detail');?>"><span class="label action-button">View Detail</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="txt-dark weight-500">#O101245</span>
                                                        </td>
                                                        <td>Mo Kamal Khan</td>
                                                        <td>
                                                            <span class="txt-success">
                                                                <span>26-10-2019</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="txt-dark weight-500">$278</span>
                                                        </td>
                                                        <td>
                                                            <span class="label label-default">In Process</span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('order-detail');?>"><span class="label action-button">View Detail</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="txt-dark weight-500">#O101267</span>
                                                        </td>
                                                        <td>Suzzy Ronald</td>
                                                        <td>
                                                            <span class="txt-success">
                                                                <span>30-10-2019</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="txt-dark weight-500">$1078</span>
                                                        </td>
                                                        <td>
                                                            <span class="label label-danger">Canceled</span>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('order-detail');?>"><span class="label action-button">View Detail</span></a>
                                                        </td>
                                                    </tr>
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

      <?php include 'include/footer.php';?>


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

                                <h1>Notification</h1>

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

                                        Notification

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

                                            <th> Id</th>

                                            <th>Messege</th>

                                            <th>Date</th>

                                            <th>Action</th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>#00101</td>

                                            <td>Digital Marketng</td>
                                            <td>23-10-2019</td>

                                            <td class="mytd"><a href="<?php echo site_url('notification-detail');?>">View Detail</a>

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


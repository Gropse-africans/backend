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

                                <h1>Service List</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>
                                        
                                        <a class="parent-item addnewproduct" href="<?php echo site_url('add-Service');?>">Add New Service</a>
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

                                            <th>Service Id</th>

                                            <th>Service Name</th>

                                            <th>Price</th>

                                            <th>Total Discount</th>

                                            <th>Action</th>

                                            <th>Status</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>#S1200101</td>

                                            <td>Digital Marketng</td>
                                            <td>$200 </td>
                                            <td>10%</td>

                                            <td class="mytd"><a href="<?php echo site_url('service-detail');?>">View Detail</a>

                                            </td>

                                            <td>
                                                <div class="mytoggle">

                                                    <label class="switch">

                                                        <input type="checkbox" checked>

                                                        <span class="slider round"></span>

                                                    </label>

                                                </div>

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


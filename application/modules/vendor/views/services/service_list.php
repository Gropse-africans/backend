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

                                        <a class="parent-item addnewproduct" href="<?php echo site_url('vendor/add-service'); ?>">Add New Service</a>
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
                        <?= $this->session->flashdata('response'); ?>

                        <div class="card card-shadow mb-4">

                            <div class="card-body">

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>

                                            <th>Sr.No</th>
                                            <th>Service Name</th>
                                            <!--<th>Short Description</th>-->
                                            <th>Service Category</th>
                                            <th>Status</th>
                                            <th>Action</th>


                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php foreach ($services as $key => $service): ?>
                                            <tr>

                                                <td><?= $key + 1 ?></td>

                                                <td><?= $service['name'] ?></td>
                                                <!--<td><?= $service['short_description'] ?></td>-->
                                                <td><?= $service['category_name'] ?></td>
                                                <td><?php if ($service['status'] == 1) { ?>
                                                        <span class="label label-success">Verified By Admin</span>
                                                    <?php } else { ?>
                                                        <span class="label label-default">Not Verified</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="mytd"><a href="<?php echo base_url(); ?>vendor/service-detail/<?= $service['service_id'] ?>">View Detail</a>

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


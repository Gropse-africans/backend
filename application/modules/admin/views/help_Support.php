<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Help & Support</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?php echo site_url('admin/dashboard'); ?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                        Issues List

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
                                            <th>Issue Id</th>
                                            <th>Subject</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                            <th>Date</th>

                                        </tr>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php foreach ($support as $sup): ?>
                                            <tr>
                                                <td>
                                                    <span class="txt-dark weight-500">#<?= $sup['id'] ?></span>
                                                </td>
                                                <td><?= $sup['subject'] ?></td>
                                                <td>
                                                    <span class="txt-dark weight-500"><?= $sup['email'] ?></span>
                                                </td>

                                                <td>
                                                    <span class="txt-dark weight-500"><?= $sup['description'] ?></span>
                                                </td>
                                                <td>
                                                    <span class="txt-success">
                                                        <span><?= date('H:i:s d M,Y', strtotime($sup['created_at'])) ?></span>
                                                    </span>
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


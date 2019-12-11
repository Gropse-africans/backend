
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>All Plans</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>
                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?= base_url('vendor/dashboard'); ?>">Home</a>

                                        <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li class="active">

                                        All Plans

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
                                <?= $this->session->flashdata('response'); ?>
                                <table id="bs4-table" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>

                                            <th>Sr.No</th>

                                            <th>Plan Name</th>

                                            <th>Price</th>

                                            <th>Duration</th>

                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php $count=1;foreach ($plans as $plan): ?>
                                            <tr>
                                                <td><?=$count?></td>
                                                <td><?= $plan['name'] ?></td>
                                                <td>$<?= $plan['price'] ?></td>
                                                <td><?= $plan['duration'] ?> days</td>
                                                <td><?= $plan['description'] ?></td>                                               
                                                <td> <span class="label label-primary">Subscribe</span></td>
                                            </tr>
                                        <?php $count++;endforeach; ?>
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



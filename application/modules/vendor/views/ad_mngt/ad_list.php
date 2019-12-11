
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Advertisement List</h1>

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

                                        Advertisement List

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
                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>

                                            <th>Sr.No</th>

                                            <th>Image</th>

                                            <th>Name</th>

                                            <th>Description</th>

                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($ads as $ad): ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><div style="width:250px;max-height:200px;"><a href="<?= $ad['image'] ?>" target="_blank" title="<?= $ad['name'] ?>"><img src="<?= $ad['image'] ?>" class="img-fluid" alt="<?= $ad['name'] ?> img" ></a></div></td>
                                                <td><?= $ad['name'] ?></td>
                                                <td><?= $ad['description'] ?></td>
                                                <td>                                                                                                                                   
                                                    <!--<div class="mytoggle">-->

<!--                                                        <label class="switch">

                                                            <input type="checkbox" <?= $ad['status'] ? 'checked' : '' ?>>

                                                            <span class="slider round"></span>

                                                        </label>
                                                         
                                                    </div>-->
                                                <?= $ad['status'] ? '<span class="text-success">enabled</span>' : '<span class="text-danger">disabled</span>' ?>
                                                </td>  
                                                <td>
                                                    <a href="<?php echo base_url(); ?>vendor/advertisement-detail/<?=$ad['id']?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a>
                                             </td>
                                            </tr>
    <?php $count++;                         
endforeach; ?>
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



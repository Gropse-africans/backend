
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Product List</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <a class="parent-item addnewproduct" href="<?php echo base_url('vendor/add-product'); ?>">Add New Product</a>
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

                                            <th>Product Id</th>

                                            <th>Product Name</th>

                                            <th>Price</th>

                                            <th>Quantity</th>

                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $product['product_id'] ?></td>
                                                <td><?= $product['name'] ?></td>
                                                <td>$<?= $product['price'] ?></td>
                                                <td><?= $product['quantity'] ?></td>
                                                <td>
                                                    <span class="label label-warning"><?= $product['status'] == 1 ? 'Verified' : 'Not Verified' ?></span>
                                                    <!--                                                                                            <div class="mytoggle">
                                                                                                
                                                                                                                                                        <label class="switch">
                                                                                                
                                                                                                                                                            <input type="checkbox" <?= $product['status'] ? 'checked' : '' ?>>
                                                                                                
                                                                                                                                                            <span class="slider round"></span>
                                                                                                
                                                                                                                                                        </label>
                                                                                                
                                                                                                                                                    </div>-->

                                                </td>
                                                
                                                <td class="mytd"><a href="<?= base_url(); ?>vendor/product-detail/<?= $product['product_id'] ?>">View Detail</a>

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



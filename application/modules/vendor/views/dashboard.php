
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

                                    <a class="parent-item" href="<?= base_url('vendor/dashboard'); ?>">Home</a>

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

                                <i class="fa fa-product-hunt"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of Product</span>

                                <span class="info_items_number"><?= $products ?></span>

                            </div>

                        </div>

                    </div>

                    <!-- /info-box-content -->

                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_yellow d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-archive"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of  Order</span>

                                <span class="info_items_number">0</span>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_pink d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-users"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of  Users</span>

                                <span class="info_items_number">0</span>

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

                                <span class="info_items_number">$ 0</span>

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
                                    <h3>Recently Added Products</h3>
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
                                                <th>Product Id</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($recent_products as $product):?>
                                             <tr>
                                                <td>
                                                    <span class="txt-dark weight-500">#<?=$product['product_id']?></span>
                                                </td>
                                                <td><?=$product['name']?></td>
                                                <td>
                                                    <span class="txt-success">
                                                        <span><?=$product['quantity']?></span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$<?=$product['price']?></span>
                                                </td>
                                                <td>
                                                    <span class="label label-warning"><?=$product['status']==1?'Verified':'Not Verified'?></span>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>vendor/product-detail/<?=$product['product_id']?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a>
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
            </section>



        </div>

    </div>

</div>


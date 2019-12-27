
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

                                <i class="fa fa-shopping-cart"></i>

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

                                <i class="fa fa-cubes"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of Order</span>

                                <span class="info_items_number"><?= $order_count ?></span>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_pink d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-first-order"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No Of Booking</span>

                                <span class="info_items_number"><?= $booking_count ?></span>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-3 col-md-3">

                        <div class="info_items bg_blue d-flex align-items-center">

                            <span class="info_items_icon">

                                <i class="fa fa-handshake-o"></i>

                            </span>

                            <div class="info_item_content">

                                <span class="info_items_text">No of Service</span>

                                <span class="info_items_number"><?= $services ?></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-12 m-b-3 alert <?= $this->vendor['plan_id'] ? ($this->vendor['expiry_date'] < date('Y-m-d H:i:s')?'alert-danger':'alert-info') : 'alert-warning' ?>" id="subscription-detail">

                <h3 class="total-view text-center" id="heading"><?php if ($this->vendor['plan_id']): ?>Current Subscription End In<?php endif; ?></h3>
                <div class="widget-info ebox3">
                    <div class="cowndown text-center" id="Counter">

                        <?php if ($this->vendor['plan_id']): ?>
                            Days <span id="days"></span>&nbsp;Hours&nbsp;<span id="hours"></span>&nbsp;Min&nbsp;<span id="minutes"></span>&nbsp;Sec&nbsp;<span id="seconds"></span>
                        <?php else: ?>
                            You Don't Have Any Active Plan ! <a class="text-primary" style="display: inline-block;font-size: 17px;font-weight: 300;" href="<?= base_url() ?>vendor/subscription-plan">Subscribe Now</a> 


                        <?php endif; ?>

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
                                            <?php foreach ($recent_products as $product): ?>
                                                <tr>
                                                    <td>
                                                        <span class="txt-dark weight-500">#<?= $product['product_id'] ?></span>
                                                    </td>
                                                    <td><?= $product['name'] ?></td>
                                                    <td>
                                                        <span class="txt-success">
                                                            <span><?= $product['quantity'] ?></span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="txt-dark weight-500">$<?= $product['price'] ?></span>
                                                    </td>
                                                    <td>
                                                        <?php if ($product['status'] == 1): ?>
                                                            <span class="label label-warning">Verified By Admin</span>
                                                        <?php else: ?>
                                                            <span class="label label-default">Not verified</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>vendor/product-detail/<?= $product['product_id'] ?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a>
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

<script>
    const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;
    var expiry_date = '<?= $this->vendor['expiry_date'] ?>';
    var expiry_timestamp = new Date(expiry_date).getTime();
    if (!isNaN(expiry_timestamp)) {
        var dt = new Date();
        var currentdate = dt.getTime();
        if (currentdate < expiry_timestamp) {
            let countDown = expiry_timestamp,
                    x = setInterval(function () {
                        let now = new Date().getTime(),
                                distance = countDown - now;
                        if (distance >= 0) {
                            if (Math.floor(distance / (day)) == 0) {
                                document.getElementById('subscription-detail').classList.add('alert-danger');
                            }
                            document.getElementById('days').innerText = Math.floor(distance / (day)),
                                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
                        } else {
                            document.getElementById('heading').innerHTML = "";
                            document.getElementById('Counter').innerHTML = "Your Plan Expired! <a class='text-primary' style='display: inline-block;font-size: 17px;font-weight: 300;' href='<?= base_url() ?>vendor/subscription-plan'>Subscribe Now</a>";
                        }

                    }, second);
        } else {
            document.getElementById('heading').innerHTML = "";
            document.getElementById('Counter').innerHTML = "Your Plan Expired! <a class='text-primary' style='display: inline-block;font-size: 17px;font-weight: 300;' href='<?= base_url() ?>vendor/subscription-plan'>Subscribe Now</a>";
        }
    }
</script>
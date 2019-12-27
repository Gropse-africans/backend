
<!--main contents start-->
<main class="content_wrapper bookingdetail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row invoive-info">
                            <div class="col-md-6 col-xs-12 invoice-client-info">
                                <h3>User Information :</h3>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>User Name : </th>
                                            <td><a title="view user" href="<?=base_url()?>admin/user-detail/<?=$order['user_id']?>"><?=$order['user_name']?></a></td>
                                        </tr>
<!--                                        <tr>
                                            <th>Email Id :</th>
                                            <td><?=$order['email']?></td>
                                        </tr>-->
                                        <tr>
                                            <th>Mobile No :</th>
                                            <td>
                                                <?=$order['mobile']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Address :</th>
                                            <td>
                                               <?=$order['address']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Landmark :</th>
                                            <td>
                                               <?=($order['landmark'])?$order['landmark']:'N/A';?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h3>Order Information :</h3>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Order Id :</th>
                                            <td>
                                                #<?=$order['order_id']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date :</th>
                                            <td><?=$order['created_at'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Status :</th>
                                            <td>
                                                <?php if($order['status'] == 1){?>
                                                <span class="label label-warning">New Order</span>
                                                <?php }else if($order['status'] == 4){?>
                                                <span class="label label-success">Delivered</span>
                                                <?php }else if($order['status'] == 5){?>
                                                <span class="label label-danger">Order Cancelled</span>
                                                <?php }else {?>
                                                <span class="label label-primary">Order Shipped</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="chart_headibg">
                                <h3> Order List</h3>
                            </div>
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table  invoice-detail-table">
                                        <thead>
                                            <tr class="thead-default">
                                                <th>Product Name</th>
                                                <th>Vendor Name</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Quantity</th>
                                                
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($order['items'] as $item):?>
                                            <tr>
                                                <td><a title="view product" href="<?=base_url()?>admin/product-detail/<?=$item['product_id']?>"><?=$item['product_name']?></a></td>
                                                <td><a title="view vendor" href="<?=base_url()?>admin/vendor-detail/<?=$item['vendor_id']?>"><?=$item['vendor_name']?></a></td>
                                                <td>$<?=$item['price']?></td>
                                                <td>$<?=$item['discount']?></td>
                                                <td>$<?=$item['amount']?></td>
                                                <td><?=$item['quantity']?></td>
                                                <td>$<?=number_format($item['total'],2)?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 offset-9">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                        <tr>
                                            <th>Sub Total :</th>
                                            <td>$<?=number_format($order['amount'],2)?></td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Charges :</th>
                                            <td>$<?=$order['delivery_charges']?></td>
                                        </tr>
                                        <tr>
                                            <th>TAX :</th>
                                            <td>$<?=$order['tax']?></td>
                                        </tr>
                                        <tr class="text-info">
                                            <td>
                                                <h3 class="text-primary">Total :</h3>
                                            </td>
                                            <td>
                                                <h3 class="text-primary">$<?=number_format($order['total'],2)?></h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


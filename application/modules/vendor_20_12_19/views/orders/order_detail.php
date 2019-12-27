
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
                                            <td><?=$order['user_name']?></td>
                                        </tr>
                                        <tr>
                                            <th>Email Id :</th>
                                            <td><?=$order['email']?></td>
                                        </tr>
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
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $order['sub_total']=0;
                                            $order['total_discount']=0;
                                            foreach($order['items'] as $item): 
                                                $order['sub_total']=$order['sub_total']+$item['price']*$item['quantity'];
                                            $order['total_discount']=$order['total_discount']+$item['discount']*$item['quantity'];
                                            ?>
                                            <tr>
                                                <td><a title="view product" href="<?=base_url()?>vendor/product-detail/<?=$item['product_id']?>"><?=$item['product_name']?></a></td>
                                                <td>$<?=$item['price']?></td>
                                                <td>$<?=$item['discount']?></td>
                                                 <td>$<?=$item['amount']?></td>
                                                <td><?=$item['quantity']?></td>
                                                <td>$<?=$item['total']?></td>
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
                                        <!--<tr>-->
                                        <!--    <th>Sub Total :</th>-->
                                        <!--    <td>$<?=$order['sub_total']?></td>-->
                                        <!--</tr>-->
                                        <!--<tr>-->
                                        <!--    <th>Discount :</th>-->
                                        <!--    <td>$<?=$order['total_discount']?></td>-->
                                        <!--</tr>-->
                                        
                                        <tr class="text-info">
                                            <td>
                                                <h3 class="text-primary">Total :</h3>
                                            </td>
                                            <td>
                                                <h3 class="text-primary">$<?=$order['total_amount']?></h3>
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



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
                                            <td><?=$order['user_email']?></td>
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
                                <h3>Booking Information :</h3>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Booking Id :</th>
                                            <td>
                                                #<?=$order['booking_id']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Booked At :</th>
                                            <td><?=$order['created_at'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Status :</th>
                                            <td>
                                                <?php if($order['status'] == 1){?>
                                                <span class="label label-warning">New Booking</span>
                                                <?php }else if($order['status'] == 3){?>
                                                <span class="label label-success">Completed</span>
                                                <?php }else if($order['status'] == 4){?>
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
                                <h3> Booking List</h3>
                            </div>
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table  invoice-detail-table">
                                        <thead>
                                            <tr class="thead-default">
                                                <th>Service Name</th>
                                                <th>Booking Start Date Time</th>
                                                <th>Booking End Date Time</th>
                                                <th>Plan</th>
                                                <!--<th>Payment Status</th>-->
                                                <!--<th>Total Amount</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a title="view service" href="<?=base_url()?>vendor/service-detail/<?=$order['service_id'];?>"><?=$order['service_name']?></a></td>
                                                <td><?=date('d M,Y H:i:s ',strtotime($order['start_date'].$order['start_time']))?></td>
                                                <td><?=date('d M,Y H:i:s ',strtotime($order['end_date'].$order['end_time']))?></td>
                                                <td><?=$order['plan_name']?></td>
                                                <!--<td><?=$order['payment_status']==1?'Successful':($order['payment_status']==2?'Failed':'Pending')?></td>-->
<!--                                                <td>$<?=$order['amount']?></td>-->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 offset-8">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                        <tr>
                                            <th>Amount :</th>
                                            <td>$<?=number_format($order['amount'],2)?></td>
                                        </tr>
                                        <tr>
                                            <th>Service Fee :</th>
                                            <td>$<?=$order['service_fees']?></td>
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


<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Un-Verify Product List</h1>

                            </div>

                        </div>

                        <!--<div class="col-md-6 justify-content-end d-flex">-->

                        <!--    <div class="breadcrumb_nav">-->

                        <!--        <ol class="breadcrumb">-->

                        <!--            <li>-->
                                        
                        <!--                <a class="parent-item addnewproduct" href="#">Add New Product</a>-->
                        <!--            </li>-->

                        <!--        </ol>-->

                        <!--    </div>-->

                        <!--</div>-->

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

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                    <thead>

                                        <tr>

                                            <th>Product Id</th>

                                            <th>Product Name</th>

                                            <th>Price</th>

                                            <th>Quantity</th>
                                            <th>Discount</th>

                                            <!--<th>Status</th>-->

                                            <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php $count = 1;
                                            if($product){
                                            foreach ($product as $value):
                                                ?>
                                            <tr>
                                                <td>#<?=$value['product_id'];?></td>

                                                <td><?=$value['name'];?></td>
                                                <td><?=$value['price'];?></td>
                                                <td><?=$value['quantity'];?></td>
                                                <td><?=$value['discount'];?></td>
<!--                                                <td>
                                                    <?php if($value['quantity']>0){ ?>
                                                        <span class="label label-default">Available</span>
                                                    <?php }else{ ?>
                                                        <span class="label label-danger"> O. O. S.</span> 
                                                    <?php }?></td>-->
                                                <td><a href="<?= base_url('admin/product-detail/'.$value['product_id']);?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                            </tr>
                                            <?php $count++;
                                                    endforeach;
                                               }
                                            ?>

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
<script>
    $(document).ready(function () {
        $('#example1').DataTable();
    });
</script>
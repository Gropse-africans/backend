 
<div class="container_full">



    <main class="content_wrapper">

        <!--page title start-->
        <?php if ($product): ?>
            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Product Detail</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>
                                        <a class="parent-item addnewproduct" href="<?php echo base_url(); ?>vendor/edit-product/<?= $product['product_id'] ?>">Edit Product Detail</a>
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

                    <div class="col-lg-6">

                        <div class="panel profile-cover">

                            <div id="carouselExampleIndicators" class="carousel slide sliderevent" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <?php foreach ($product['image'] as $key => $img): ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key ? '' : 'active' ?>"></li>
                                    <?php endforeach; ?>
                                    <!--   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      
                                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    -->
                                </ol>
                                <!-- print -->
                                <div class="carousel-inner">
                                    <?php foreach ($product['image'] as $keys => $image): ?>
                                        <div class="carousel-item <?= $keys ? '' : 'active' ?>">

                                            <img src="<?= $image['file_path'] . $image['file_name'] ?>" alt="slider<?= $keys ? $keys : '' ?>">

                                        </div>
                                    <?php endforeach; ?>
                                    <!-- <div class="carousel-item">

                                        <img src="<?php echo base_url(); ?>assets/vendor/images/product/1.png" alt="slider1">

                                    </div>

                                    <div class="carousel-item">

                                        <img src="<?php echo base_url(); ?>assets/vendor/images/product/3.png" alt="slider2">

                                    </div> -->

                                </div>

                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">

                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                                    <span class="sr-only">Previous</span>

                                </a>

                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>

                                    <span class="sr-only">Next</span>

                                </a>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="panel">

                            <div class="panel-content panel-about">

                                <table>

                                    <tbody>


                                        <tr>

                                            <th>

                                                Product Name :</th>

                                            <td><?= $product['name'] ?></td>

                                        </tr>
                                        <tr>

                                            <th>

                                                Product Brand :</th>

                                            <td><?= $product['brand'] ?></td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Product Quantity:</th>

                                            <td><?= $product['quantity'] ?></td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Product Price:</th>

                                            <td> $<?= $product['price'] ?></td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Product Discount (%):</th>

                                            <td><?= $product['discount'] ?></td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Status:</th>

                                            <td><?= $product['status'] == 1 ? 'Verified by admin' : 'Not verified by admin' ?></td>

                                        </tr>
                                        <tr>

                                            <th></th>

                                            <td><a class="btn btn-danger text-white" onclick="deleteProduct(<?=$product['product_id']?>);">Delete Product</a>
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                        <?php if ($product['feature']): ?>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong> Features </strong></h3>
                                </div>
                                <div class="panel-content panel-activity">
                                    <?php foreach ($product['feature'] as $feature): ?>
                                        <div class=" entry-content">
                                            <div class="row">
                                                <label class="col-sm-5"><strong><?= $feature['title'] ?> </strong>:</label>
                                                <label class="col-sm-7"><?= $feature['value'] ?></label>
                                            </div>
                                        </div>  
                                    <?php endforeach;
                                    if ($product['specification']):
                                        ?>
                                        <div class="panel-heading">
                                            <h6 class="panel-title"> Specification </h6>
                                        </div>
                                        <div class="panel-content panel-activity">
            <?php foreach ($product['specification'] as $specification): ?>
                                                <div class=" entry-content">
                                                    <div class="row">
                                                        <label class="col-sm-5"><strong><?= $specification['title'] ?> </strong>:</label>
                                                        <label class="col-sm-7"><?= $specification['value'] ?></label>
                                                    </div>

                                                </div>  
                                        <?php endforeach; ?>
                                        </div>
        <?php endif; ?>
                                </div>
                            </div>
    <?php endif; ?>
                        <div class="panel">

                            <div class="panel-heading">

                                <h3 class="panel-title"><strong> Description </strong></h3>

                            </div>

                            <div class="panel-content panel-activity">

                                <div class=" entry-content">
    <?= $product['description'] ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
<?php else: ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel">

                            <div class="panel-content panel-about text-center">
                                <div id="content" class="col-sm-12 productpage">
                                    <div class="notdatafounderror">
                                        <img src="<?php echo base_url(); ?>assets/web/images/opps-error.png"  alt="no data found">
                                        <h5>No Product Found</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
<?php endif; ?>
    </main>

</div>

<script>
    function deleteProduct(product){
        var check=confirm('Do you want to delete this product?');
       if (product && check) {       
           $.ajax({
               url: "<?= base_url(); ?>vendor/home/ajax",
               type: 'post',
               data: 'method=deleteData&id=' + product + '&type=1',
               success: function (data) {
                   var dt = $.trim(data);
                   var jsonData = $.parseJSON(dt);
                   if (jsonData['error_code'] == "100") {
                       alert('This Product Is Deleted');
                       window.location.href="<?=base_url()?>vendor/product-list";
                   } else {
                       alert(jsonData['message']);
                   }
               }
           });
       } else {
           return false;
       }
    }
</script>


<div id="account-wishlist" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?php echo base_url('my-account'); ?>">Account</a></li>
        <li><a>My Wish List</a></li>
    </ul>
    <div class="row">
        <?= $this->load->view('sidebar'); ?>

        <div id="content" class="col-sm-9 my_wishlist">
            <h2>My wishlist</h2>
            <?php if (isset($items['favouriteList'])): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Brand</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Action</td>
                            </tr>
                        </thead>
                        <?php foreach ($items['favouriteList'] as $item): ?>
                            <tbody> 
                                <tr>
                                    <td class="text-center">
                                        <a href="<?php echo base_url(''); ?>">
                                            <img src="<?php $image = $item['images'][0];
                    echo $image['file_path'] . $image['file_name']; ?>" alt="Print One Shoulder Gown" title="Print One Shoulder Gown" />
                                        </a>
                                    </td>
                                    <td class="text-left"><a href="<?php echo base_url(); ?>product-detail/<?= $item['product_id'] ?>"><?= $item['name'] ?></a></td>
                                    <td class="text-left"><a><?= $item['brand_name'] ?></a></td>
                                    <td class="text-right">
                                        <div class="price"> <b>$<?= $item['price'] ?></b></div>
                                    </td>
                                    <td class="text-right">
                                        <!--<button type="button" onclick="" data-toggle="tooltip" title="Add to Cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></button>-->
                                        <a style="cursor:pointer;" data-toggle="tooltip" title="Remove" class="btn btn-danger" onclick="addtowishlist(<?= $item['product_id'] ?>);"><i class="fa fa-times"></i></a></td>
                                </tr>  
                            </tbody>
    <?php endforeach; ?>
                    </table>
                </div>
<?php else: ?>
                <div class="container-fluid text-center">
                    <img src="<?= base_url() ?>assets/web/images/empty_wishlist.png" alt="Your Cart is Empty">
                </div>
<?php endif; ?>
            <div class="buttons clearfix">
                <div class="pull-right"><a href="<?php echo base_url(); ?>" class="btn btn-primary">Continue Shopping</a></div>
            </div>
        </div>
    </div>
</div>
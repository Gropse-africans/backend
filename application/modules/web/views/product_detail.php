<style>
    .productpage .product-description td {
    min-width: 100px;
}
</style>
<div id="product-product" class="container">
    <div class="row">
        <div id="content" class="col-sm-12 productpage">
            <h2 class="page-title"><?= $products['name'] ?></h2>
            <div class="row">
                <div class="col-sm-6 product-left">
                    <div class="product-info">
                        <div class="left product-image thumbnails">
                            <div class="image" >
                                <a class="thumbnail" title="<?= $products['name'] ?>"><img style="width:443px;height:557px;" id="tmzoom" src="<?= $products['images'][0]['image'] ?>" data-zoom-image="<?= $products['images'][0]['image'] ?>" title="<?= $products['name'] ?>" alt="<?= $products['name'] ?>" /></a>
                            </div>

                            <div class="additional-carousel">
                                <div class="customNavigation">
                                    <span class="fa prev fa-arrow-left">&nbsp;</span>
                                    <span class="fa next fa-arrow-right">&nbsp;</span>
                                </div>

                                <div id="additional-carousel" class="image-additional product-carousel">
                                    <?php foreach ($products['images'] as $image): ?>
                                        <div class="slider-item myslider-item">
                                            <div class="product-block">
                                                <a style="cursor:pointer;" title="<?= $products['name'] ?>" class="elevatezoom-gallery" data-image="<?= $image['image'] ?>" data-zoom-image="<?= $image['image'] ?>"><img onclick="changeImage(this);" src="<?= $image['image'] ?>" width="74" height="74" title="<?= $products['name'] ?>" alt="<?= $products['name'] ?>" /></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <span class="additional_default_width" style="display:none; visibility:hidden"></span>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-sm-6 product-right">

                    <h3 class="product-title"><?= $products['name'] ?></h3>
                    <div class="rating-wrapper">
                        <?php for ($i = 1; $i <= 5; $i++):if ($products['rating'] >= $i): ?>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <?php else: ?>
                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                            <?php endif;endfor; ?>
                    </div>
                    <div class="description">
                        <table class="product-description">
<!--                                <tr>
                                <td><span class="desc">Brands</span></td>
                                <td class="description-right"><a href="<?php echo base_url(''); ?>">Gucchi Fashion</a></td>
                            </tr>
                            <tr>
                                <td><span class="desc">Product Code:</span></td>
                                <td class="description-right"> Gucchi23</td>
                            </tr>-->
                            <tr>
                                <td><span class="desc">Availability:</span> </td>
                                <td class="description-right"><?= $products['quantity'] ? 'In Stock' : 'Currently Unavailable' ?></td>
                            </tr>
                        </table>
                    </div>

                    <ul class="list-unstyled">
                        <li>
                            <h4 class="special-price">$<?= $products['discount_price'] ?></h4><span class="old-price" style="text-decoration: line-through;">$<?= $products['price'] ?></span></li>
                    </ul>
                    <div id="product">
                        <?php if ($products['quantity']): ?>
                            <div class="row">
                                <!--                                <div class="col-md-6">
                                                                    <div class="form-group required">
                                                                        <label class="control-label" for="input-quantity">Qty</label>
                                                                        <input type="text" name="quantity" value="1" class="form-control" />
                                                                        <input type="hidden" name="product_id" value="30" />
                                
                                                                    </div>
                                                                </div>-->
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group prd_page prodetailcart">
                                    <?php if ($products['quantity']): ?>
                                        <button type="button" class="btn btn-primary cart btn-lg" onclick="<?php
                                        if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $products['product_id'] . ')';
                                        else: echo 'checkout()';
                                        endif;
                                        ?>;"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-default wishlist" title="Add to Wish List" onclick="<?php
                                    if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $products['product_id'] . ')';
                                    else: echo 'checkout()';
                                    endif;
                                    ?>;"><?= $products['is_fav'] ? 'Remove from Wish List' : '<i class="fa fa-heart"></i> Add to Wish List' ?> </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="content_product_block" style="width:100%">
                        <div class="product-tabs" id="custom_tab">
                            <ul>
                                <li><a class="first" href="#tab-1" style="display: inline;">Description</a></li>
                                <?php if ($products['attribute']): ?>
                                    <li><a class="fourth" href="#tab-2" style="display: inline;">Features</a></li>
                                    <?php
                                endif;
                                if ($products['specification']):
                                    ?>
                                    <li><a class="third" href="#tab-3" style="display: inline;">Specification</a></li>
                                <?php
                                endif;
                                if ($vendor):
                                    ?>
                                    <li><a class="second" href="#tab-4" style="display: inline;">Vendor Information</a></li>
                        <?php endif; ?>
                            </ul>
                        </div>
                        <div class="tab_product" id="tab-1">
                            <p><?= $products['description'] ?></p>
                        </div>
                        <?php if ($products['specification']): ?>
                            <div class="tab_product" id="tab-3">
                            <?php foreach ($products['specification'] as $specification): ?>
                                    <span><strong><?= $specification['attribute'] ?> :</strong></span><?= $specification['value'] ?><br>
                            <?php endforeach; ?>
                            </div>
                                <?php
                            endif;
                            if ($products['attribute']):
                                ?>
                            <div class="tab_product" id="tab-2">  
                            <?php foreach ($products['attribute'] as $feature): ?>
                                    <span><strong><?= $feature['attribute'] ?> :</strong></span><?= $feature['attribute_value'] ?><br>
    <?php endforeach; ?>
                            </div>
                        <?php
                        endif;
                        if ($vendor):
                            ?>
                            <div class="tab_product" id="tab-4">  
                                <h4><?= $vendor['user_name'] ?></h4>
                            </div>
<?php endif; ?>
                    </div>
                </div>
                <div class="cl-sm-12">

                </div>
            </div>

        </div>
    </div>
</div>
<?php if ($similar_products): ?>
    <div class="container related-fluid">
        <div class="box-heading">
            <div class="peoplesay-title">
                <h2>Related Product</h2>
                <h1>Recommended the Most Popular Product</h1>
            </div>
        </div>
        <div class="row home_row">
            <div id="content" class="col-sm-12">
                <div class="box bestseller relatedproduct">

                    <div class="box-content">
                        <div class="customNavigation">
                            <a class="fa prev fa-arrow-left">&nbsp;</a>
                            <a class="fa next fa-arrow-right">&nbsp;</a>
                        </div>

                        <div class="box-product product-carousel" id="bestseller-carousel">
                                                <?php foreach ($similar_products as $s_products): ?>
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image" style="width:258px;height: 336px;">
                                                <a href="<?php echo base_url(); ?>product-detail/<?= $s_products['product_id'] ?>">
                                                    <?php foreach ($s_products['images'] as $key => $image): if ($key == 0): ?>
                                                            <img style="height:100%" src="<?= $image['file_path'] . $image['file_name'] ?>" title="<?= $s_products['name'] ?>" alt="<?= $s_products['name'] ?>" class="img-responsive" />
                                                            <!--<img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/product/01.png" title="<?= $product['name'] ?> " alt="<?= $product['name'] ?> " />-->
                <?php
            endif;
        endforeach;
        ?>
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
        <?php for ($j = 1; $j <= 5; $j++):if ($s_products['rating'] >= $j): ?>
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
            <?php else: ?>
                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
            <?php endif;endfor; ?>
                                                    </div>
                                                    <h4><a href="<?php echo base_url(); ?>product-detail/<?= $s_products['product_id'] ?>"><?= $s_products['name'] ?>  </a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$<?= $s_products['discount_price'] ?></span> <span class="price-old">$<?= $s_products['price'] ?></span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="<?php
                                                        if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $s_products['product_id'] . ')';
                                                        else: echo 'checkout()';
                                                        endif;
                                                        ?>;" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="View" href="<?php echo base_url(); ?>product-detail/<?= $s_products['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist <?= $s_products['is_fav'] ? 'fav' : '' ?>" type="button" title="<?= $s_products['is_fav'] ? 'Remove from Wish List' : 'Add to Wish List' ?>" onclick="<?php
                                                        if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $s_products['product_id'] . ')';
                                                        else: echo 'checkout()';
                                                        endif;
                                                        ?>;"><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <span class="bestseller_default_width" style="display:none; visibility:hidden"></span>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    function changeImage(obj) {
        var src = $(obj).attr('src');
        $('#tmzoom').attr('src', src);
    }
</script>
<div id="product-special" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i></a></li>
        <li><a>Search Results</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12 column_right">
            <h2 class="page-title">Search Results</h2>
            <div class="row category_thumb">
<!--                <div class="col-sm-2 category_img"><img src="http://gropse.com/gropse.com/design/africanssupermarket.com/common/images/background/list_banner.png" alt="Fantastic Outlet 2019" title="Fantastic Outlet 2019" class="img-thumbnail" />
                </div>-->
            </div>
            <?php if ($products['products']): ?>
                <div class="row">
                    <?php foreach ($products['products'] as $product): ?>
                        <div class="product-layout product-grid col-lg-3 col-md-4 col-sm-4 col-xs-6">
                            <div class="product-block product-thumb">
                                <div class="product-block-inner">
                                    <div class="image" style="width:196px;height: 226px;">
                                        <?php foreach ($product['images'] as $key => $image):if ($key == 0): ?>
                                                <img style="height: 100%;" src="<?= $image['file_path'] . $image['file_name'] ?>" title="<?= $product['name'] ?> " alt="<?= $product['name'] ?> " class="img-responsive" />
                                                <!--<img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/product/01.png" title="<?= $product['name'] ?> " alt="<?= $product['name'] ?> " />-->
                                            <?php endif;
                                        endforeach; ?>
                                    </div>
                                    <div class="product-details grid">
                                        <div class="caption">
                                            <div class="rating">
                                                <?php for($i=1;$i<=5;$i++):if($product['rating'] >= $i):?>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                <?php else: ?>
                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                <?php endif;endfor;?>
                                            </div>
                                            <h4><a href="<?= base_url() ?>product-detail/<?= $product['product_id'] ?>"><?= $product['name'] ?></a></h4>
                                            <p class="price">
                                                <span class="price-new">$<?= $product['discount_price'] ?></span> <span class="price-old">$<?= $product['price'] ?></span>
                                            </p>
                                            <div class="product_hover_block">
                                                <div class="action">
                                                    <button type="button" class="cart_button" onclick="<?php if($this->session->userdata('customer_logged_in')):echo 'addtowishlist('.$product['product_id'].')';else: echo 'checkout()';endif;?>;" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                    <div class="quickview-button">
                                                        <a class="quickbox" title="View" href="<?= base_url() ?>product-detail/<?= $product['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    <button class="wishlist <?=$product['is_fav']?'fav':''?>" type="button" title="<?=$product['is_fav']?'Remove From Wish List ':'Add to Wish List'?>" onclick="<?php if($this->session->userdata('customer_logged_in')):echo 'addtowishlist('.$product['product_id'].')';else: echo 'checkout()';endif;?>;"><i class="fa fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
                </div>
<?php else: ?>
                <div class="row">
                    <div id="content" class="col-sm-12 productpage">
                        <div class="notdatafounderror">
                            <img src="<?php echo base_url(); ?>assets/web/images/opps-error.png"  alt="no data found">
                            <h5>No Product Found</h5>
                        </div>
                    </div>
                </div>
<?php endif; ?>
            <!--            <div class="pagination-wrapper">
                            <div class="col-sm-6 text-left page-link">
                                <ul class="pagination">
                                    <li><a href="http://gropse.com/gropse.com/design/africanssupermarket.com/">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="http://gropse.com/gropse.com/design/africanssupermarket.com/">2</a></li>
                                    <li><a href="http://gropse.com/gropse.com/design/africanssupermarket.com/">&gt;</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 text-right page-result">Showing 1 to 12 of 19 (2 Pages)</div>
                        </div>-->
        </div>
    </div>
</div>

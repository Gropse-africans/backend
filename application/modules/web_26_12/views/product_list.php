<div id="product-special" class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i></a></li>
        <li><a>Product List</a></li>
    </ul>
    <div class="row">
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <div class="box">
                <div class="box-heading">Category</div>
                <div class="box-content">
                    <ul class="box-category treeview-list treeview">
                        <?php if(isset($products['filterData'])):foreach ($products['filterData']['category'] as $p_category): ?>
                            <li>
                                <a><?= $p_category['name'] ?></a>
                                <?php if ($p_category['sub_category']): ?>
                                    <ul>
                                        <?php foreach ($p_category['sub_category'] as $p_sub_category): ?>
                                            <li>
                                                <a href="<?= base_url(); ?>product-list/<?= $p_sub_category['parent_id'] ?>/<?= $p_sub_category['id'] ?>"><?= $p_sub_category['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach;endif; ?>
                    </ul>
                </div>
            </div>

            <div class="box">
                <div class="box-heading">Refine Search</div>
                <form method="post" name="filter_form">
                    <div class="list-group "> 
                        <?php if ($attributes): foreach ($attributes as $main_attribute): ?>
                                <a class="list-group-item heading"><?= $main_attribute['title'] ?></a>

                                <div class="list-group-item  ">
                                    <div id="filter-group1">
                                        <?php foreach ($main_attribute['attribute_value'] as $attribute): ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="filter_attribute[]" value="<?= $attribute['id'] ?>" <?= set_value('filter_attribute') ? (in_array($attribute['id'], set_value('filter_attribute')) ? 'checked' : '') : '' ?> /> <?= $attribute['value'] ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        endif;
                        ?> 
                        <a class="list-group-item heading">Rating</a>
                        <div class="list-group-item  ">
                            <div id="filter-group1">
                                <div class="checkbox">
                                    <label>
                                        <div class="rating"><input type="radio" name="rating" value="1" <?= set_value('rating') ? (set_value('rating') == 1 ? 'checked' : '') : '' ?>/><span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span></div> 
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <div class="rating"><input type="radio" name="rating" value="2" <?= set_value('rating') ? (set_value('rating') == 2 ? 'checked' : '') : '' ?> /><span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span></div>  
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <div class="rating"><input type="radio" name="rating" value="3" <?= set_value('rating') ? (set_value('rating') == 3 ? 'checked' : '') : '' ?>/><span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span></div> 
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <div class="rating"><input type="radio" name="rating" value="4" <?= set_value('rating') ? (set_value('rating') == 4 ? 'checked' : '') : '' ?>/><span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span></div> 
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <div class="rating"><input type="radio" name="rating" value="5" <?= set_value('rating') ? (set_value('rating') == 5 ? 'checked' : '') : '' ?>/><span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span></div> 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <a class="list-group-item heading">Price</a>
                        <div class="list-group-item price-slider">
                            <div id="filter-group4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="row slider-labels">
                                    <div class="col-xs-6 caption">
                                        <strong>Min:</strong> <span id="slider-range-value1"><?= set_value('min_price') ? set_value('min_price') : $min_price ?></span>
                                    </div>
                                    <div class="col-xs-6 text-right caption">
                                        <strong>Max:</strong> <span id="slider-range-value2"><?= set_value('max_price') ? set_value('max_price') : $max_price ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="min_value" id="min-value" value="<?= set_value('min_price') ? set_value('min_price') : $min_price ?>">
                                        <input type="hidden" name="max_value" id="max-value"  value="<?= set_value('max_price') ? set_value('max_price') : $max_price ?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                            <div class="list-group-item  ">
                                                        <div id="filter-group1">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="price[]" value="0-100" <?= set_value('price') ? (in_array("0-100", set_value('price')) ? 'checked' : '') : '' ?> /> Below $100 
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="price[]" value="101-300" <?= set_value('price') ? (in_array("101-300", set_value('price')) ? 'checked' : '') : '' ?>/>$100 - $300
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="price[]" value="301-500" <?= set_value('price') ? (in_array("301-500", set_value('price')) ? 'checked' : '') : '' ?>/> $300 - $500
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="price[]" value="501-1000" <?= set_value('price') ? (in_array("501-1000", set_value('price')) ? 'checked' : '') : '' ?>/> $500 - $1000
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="price[]" value="1000-5000" <?= set_value('price') ? (in_array("1000-5000", set_value('price')) ? 'checked' : '') : '' ?>/> $1000 Above
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>-->
                        <div class="panel-footer text-right">
                            <input type="submit" id="button-filter" name="filter" class="btn btn-primary" value="Refine Search">
                        </div>
                    </div>
                </form>
            </div>
        </aside>
        <div id="content" class="col-sm-9 column_right">
            <h2 class="page-title">Product List</h2>
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
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                    <div class="product-details grid">
                                        <div class="caption">
                                            <div class="rating">
                                                <?php for ($i = 1; $i <= 5; $i++):if ($product['rating'] >= $i): ?>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star fa-stack-2x"></i></span>
                                                    <?php else: ?>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
            <?php endif;endfor; ?>
                                            </div>
                                            <h4><a href="<?= base_url() ?>product-detail/<?= $product['product_id'] ?>"><?= $product['name'] ?></a></h4>
                                            <p class="price">
                                                <span class="price-new">$<?= $product['discount_price'] ?></span> <span class="price-old">$<?= $product['price'] ?></span>
                                            </p>
                                            <div class="product_hover_block">
                                                <div class="action">
                                                    <button type="button" class="cart_button" onclick="<?php
                                                    if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $product['product_id'] . ')';
                                                    else: echo 'checkout()';
                                                    endif;
                                                    ?>;" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                    <div class="quickview-button">
                                                        <a class="quickbox" title="View" href="<?= base_url() ?>product-detail/<?= $product['product_id'] ?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    <button class="wishlist <?= $product['is_fav'] ? 'fav' : '' ?>" type="button" title="<?= $product['is_fav'] ? 'Remove From Wish List ' : 'Add to Wish List' ?>" onclick="<?php
                                                    if ($this->session->userdata('customer_logged_in')):echo 'addtowishlist(' . $product['product_id'] . ')';
                                                    else: echo 'checkout()';
                                                    endif;
                                                    ?>;"><i class="fa fa-heart"></i></button>
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
<script src="<?=base_url()?>assets/web/js/jquery-2.1.1.min.js"></script>
<script src="<?=base_url()?>assets/web/js/priceslider.js"></script>
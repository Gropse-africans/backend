<div class="main-slider">
    <div id="spinner"></div>
    <div class="swiper-viewport">
        <div id="slideshow0" class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(isset($homepage['slider'])):foreach($homepage['slider'] as $slider):?>
                <div class="swiper-slide text-center">
                    <a href="<?php echo base_url(''); ?>"><img src="<?= $slider['image']?$slider['image']: base_url()."assets/web/images/banner/banner.png" ?>" alt="MainBanner1" class="img-responsive" /></a>
                </div>
                <?php endforeach;endif; ?>
            </div>
        </div>
        <div class="swiper-pagination slideshow0"></div>
        <div class="swiper-pager">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row home_row">
        <div id="content" class="col-sm-12">
            <div class="content-top">
                <div class="testimonial-cms">
                    <div class="testimonials" id="testimonial">
                        <div class="box-heading">
                            <div class="peoplesay-title">
                                <h2>Top Categories</h2>
                                <h1>Recommended the Most Popular Categoty</h1></div>
                        </div>
                        <div class="homepage-testimonial-inner">
                            <div class="testimonial_inner">
                                <div class="homepage-testimonials-inner products block_content">
                                    <div class="customNavigation">
                                        <a class="fa prev fa-angle-left"></a>
                                        <a class="fa next fa-angle-right"></a>
                                        <div></div>
                                    </div>
                                    <div id="testimonial-carousel" class="products product-carousel">
                                        <?php if(isset($homepage['category'])):foreach($homepage['category'] as $category):?>
                                        <div class="slider-item">
                                            <div class="peoplesay-block">
                                                <div class="test-image">
                                                    <div class="left-img">
                                                        <a href="<?=base_url()?>subcategory-list/<?=$category['id']?>"><img src="<?=$category['image']?$category['image']:base_url().'assets/web/images/category/category1.png'?>" alt="<?=$category['name']?>"></a>
                                                    </div>
                                                </div>
                                                <div class="test-dec">
                                                    <div class="title">
                                                        <a title="<?=$category['name']?>" href="<?=base_url()?>subcategory-list/<?=$category['id']?>"><?=$category['name']?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;endif;?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial_default_width" style="display: none; visibility: hidden;">&nbsp;</div>
                </div>
            </div>
<!--            <div class="category_list_cms">
                <div class="category_list1 box">
                    <div class="list_inner">
                        <div class="category_img">
                            <a href="<?php echo base_url('product-list'); ?>" title="banner1"><img class="cat_image1" src="<?php echo base_url(); ?>assets/web/images/category/addbanner.png" alt=""></a>
                            <div class="description">
                                <div class="title">Deals On Play</div>
                                <div class="subtitle">Festival Season Is Here</div>
                                <div class="action1">
                                    <a href="<?php echo base_url('product-list'); ?>" class="banner_text">Shop Now</a>
                                </div>
                                <div class="offer-text">No EMI | Exchange Offer</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category_list2 box">
                    <div class="list_inner">
                        <div class="category_img">
                            <a href="<?php echo base_url('product-list'); ?>" title="banner2"><img class="cat_image2" src="<?php echo base_url(); ?>assets/web/images/category/addbanner1.png" alt=""></a>
                            <div class="description">
                                <div class="offer-text">No EMI | Exchange Offer</div>
                                <div class="title1">Upto 70% Flate</div>
                                <div class="subtitle">Festival Season Is Here</div>
                                <div class="action2">
                                    <a href="<?php echo base_url('product-list'); ?>" class="banner_text">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="category_list3 box">
                    <div class="list_inner">
                        <div class="category_img">
                            <a href="<?php echo base_url('product-list'); ?>" title="banner2"><img class="cat_image3" src="<?php echo base_url(); ?>assets/web/images/category/addbanner2.png" alt=""></a>
                            <div class="description">
                                <div class="title">Deals On Play</div>
                                <div class="subtitle">Festival Season Is Here</div>
                                <div class="action3">
                                    <a href="<?php echo base_url('product-list'); ?>" class="banner_text">Shop Now</a>
                                </div>
                                <div class="offer-text">No EMI | Exchange Offer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="box bestseller">
                <div class="box-heading">
                    <div class="peoplesay-title">
                        <h2>Top Product</h2>
                        <h1>Recommended the Most Popular Product</h1>
                    </div>
                </div>
                <div class="box-content">
                    <div class="customNavigation">
                        <a class="fa prev fa-arrow-left">&nbsp;</a>
                        <a class="fa next fa-arrow-right">&nbsp;</a>
                    </div>

                    <div class="box-product product-carousel" id="bestseller-carousel">
                        <?php  if(isset($homepage['product'])):foreach($homepage['product'] as $product):?>
                        <div class="slider-item">
                            <div class="product-block product-thumb transition">
                                <div class="product-block-inner">
                                    <div class="image" style="width:258px;height:336px;">
                                        <a href="<?php echo base_url(); ?>product-detail/<?=$product['product_id']?>">
                                            <?php foreach($product['images'] as $key=>$image):if($key==0):?>
                                            <img style="height:100%;" src="<?=$image['file_path'].$image['file_name']?>" title="<?=$product['name']?> " alt="<?=$product['name']?> " class="img-responsive" />
                                            <!--<img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/product/01.png" title="<?=$product['name']?> " alt="<?=$product['name']?> " />-->
                                            <?php endif;endforeach;?>
                                        </a>
                                    </div>
                                    <div class="product-details">
                                        <div class="caption">
                                            <div class="rating">
                                                <?php for($i=1;$i<=5;$i++):if($product['rating'] >= $i):?>
                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                <?php else: ?>
                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                <?php endif;endfor;?>
                                            </div>
                                            <h4><a href="<?php echo base_url(); ?>product-detail/<?=$product['product_id']?>"><?=$product['name']?> </a></h4>
                                            <p class="price">
                                                <span class="price-new">$<?=$product['discount_price']?></span> <span class="price-old">$<?=$product['price']?></span>
                                            </p>
                                        </div>

                                        <div class="product_hover_block">
                                            <div class="action">
                                                <button type="button" class="cart_button" onclick="<?php if($this->session->userdata('customer_logged_in')):echo 'addtowishlist('.$product['product_id'].')';else: echo 'checkout()';endif;?>;" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                <div class="quickview-button">
                                                    <a class="quickbox" title="View" href="<?php echo base_url(); ?>product-detail/<?=$product['product_id']?>"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <button class="wishlist <?=$product['is_fav']?'fav':''?>" type="button" title="<?=$product['is_fav']?'Remove From Wish List ':'Add to Wish List '?>" onclick="<?php if($this->session->userdata('customer_logged_in')):echo 'addtowishlist('.$product['product_id'].')';else: echo 'checkout()';endif;?>;"><i class="fa fa-heart"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;endif;?>

                    </div>
                </div>
            </div>
            <span class="bestseller_default_width" style="display:none; visibility:hidden"></span>
<!--
            <div class="cmsbanner-block">
                <div class="cms-inner-block1">
                    <div class="cms1_img">
                        <a href="#" title="banner1"><img class="cms_image1" src="<?php echo base_url(); ?>assets/web/images/category/addbanner3.png" alt="Two Seat Sofa"></a>
                        <div class="description">
                            <div class="title">Two Seat Sofa</div>
                            <div class="subtitle">Now in all color varient available grab this offer</div>
                            <div class="action1">
                                <a href="#" class="banner_text">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cms-inner-block2">
                    <div class="cms2_img">
                        <a href="#" title="banner2"><img class="cms2_image2" src="<?php echo base_url(); ?>assets/web/images/category/addbanner4.png" alt="Sony LED TV"></a>
                        <div class="description">
                            <div class="title">Sony LED TV</div>
                            <div class="subtitle">For all mobile accessories, electronics exclusive available</div>
                            <div class="action1">
                                <a href="#" class="banner_text">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="container">
                <div class="row">

                    <div class="box ProductbyCategory">
                        <div class="heading_title">
                            <h4 class="panel-title">Top Services</h4>
                            <div class="category-description"> Lorem Ipsum is simply dummy text of the printing and typesetting industry the industry's standard.</div>
                            <span class="button"><a href="http://opencart.templatemela.com/OPC10/OPC100235/OPC1/index.php?route=product/category&amp;path=33">View All</a></span>
                        </div>

                        <div class="box-content ProductbyCategory">
                            <div class="customNavigation">
                                <a class="fa fa-angle-left prev">&nbsp;</a>
                                <a class="fa fa-angle-right next">&nbsp;</a>
                            </div>

                            <div class="box-product product-carousel" id="productcategory0-carousel">
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image">
                                                <a href="<?php echo base_url('service-list'); ?>">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/services/01.png" title="Transparent Seat Dining Chair" alt="Transparent Seat Dining Chair " class="img-responsive reg-image" />
                                                    <img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/services/01.png" title="Transparent Seat Dining Chair " alt="Transparent Seat Dining Chair " />
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="<?php echo base_url('service-list'); ?>">UI/UX Design</a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$70.00</span> <span class="price-old">$80.00</span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="Add To quickview" href="<?php echo base_url('service-list'); ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist" type="button" title="Add to Wish List " onclick=""><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image">
                                                <a href="<?php echo base_url('service-list'); ?>">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/services/02.png" title="Boys Festive & Party Kurta" alt="Boys Festive & Party Kurta " class="img-responsive reg-image" />
                                                    <img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/services/02.png" title="Boys Festive & Party Kurta " alt="Boys Festive & Party Kurta " />
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="<?php echo base_url('service-list'); ?>">Web design</a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$50.00</span> <span class="price-old">$60.00</span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="Add To quickview" href="<?php echo base_url('service-list'); ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist" type="button" title="Add to Wish List " onclick=""><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image">
                                                <a href="<?php echo base_url('service-list'); ?>">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/services/03.png" title="Festive Men Full Sleeve Blazer" alt="Festive Men Full Sleeve Blazer " class="img-responsive reg-image" />
                                                    <img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/services/03.png" title="Festive Men Full Sleeve Blazer " alt="Festive Men Full Sleeve Blazer " />
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="<?php echo base_url('service-list'); ?>">Mobile App Development</a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$190.00</span> <span class="price-old">$200.00</span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="Add To quickview" href="<?php echo base_url('service-list'); ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist" type="button" title="Add to Wish List " onclick=""><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image">
                                                <a href="<?php echo base_url('service-list'); ?>">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/services/04.png" title="Women Fit and Flare Pink Dress  " alt="Women Fit and Flare Pink Dress  " class="img-responsive reg-image" />
                                                    <img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/services/04.png" title="Women Fit and Flare Pink Dress  " alt="Women Fit and Flare Pink Dress  " />
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="<?php echo base_url('service-list'); ?>">Digital Marketing </a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$290.00</span> <span class="price-old">$300.00</span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="Add To quickview" href="<?php echo base_url('service-list'); ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist" type="button" title="Add to Wish List " onclick=""><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-item">
                                    <div class="product-block product-thumb transition">
                                        <div class="product-block-inner">
                                            <div class="image">
                                                <a href="<?php echo base_url('service-list'); ?>">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/services/05.png" title="Artificial Intelligence" alt="Artificial Intelligence" class="img-responsive reg-image" />
                                                    <img class="img-responsive hover-image" src="<?php echo base_url(); ?>assets/web/images/services/05.png" title="Artificial Intelligence" alt="Artificial Intelligence" />
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="<?php echo base_url('service-list'); ?>"> Artificial Intelligence</a></h4>
                                                    <p class="price">
                                                        <span class="price-new">$290.00</span> <span class="price-old">$330.00</span>
                                                    </p>
                                                </div>

                                                <div class="product_hover_block">
                                                    <div class="action">
                                                        <button type="button" class="cart_button" onclick="" title="Add to Cart"><i class="fa fa-shopping-cart" area-hidden="true"></i> </button>
                                                        <div class="quickview-button">
                                                            <a class="quickbox" title="Add To quickview" href="<?php echo base_url('service-list'); ?>"><i class="fa fa-eye"></i></a>
                                                        </div>
                                                        <button class="wishlist" type="button" title="Add to Wish List " onclick=""><i class="fa fa-heart"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="productcategory0_default_width" style="display:none; visibility:hidden"> </span>

                    </div>
                </div>
            </div>

            <div class="offer_block">
                <div class="offer_img">
                    <a href="#" title="banner1"><img class="cat_image1" src="<?php echo base_url(); ?>assets/web/images/background/Offer-banner.png" alt="Promote Your Service Here"></a>
                    <div class="offer-wrapper">
                        <div class="offer-title">Promote Your Service Here</div>
                        <div class="offer-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                        <div class="offer-desc">for all our new customers</div>
                        <a class="offer-btn" href="<?php echo base_url(); ?>vendor">Join Now</a>
                    </div>
                </div>
            </div>

            <div id="carousel-0" class="banners-slider-carousel">
                <div class="customNavigation">
                    <a class="prev fa fa-arrow-left">&nbsp;</a>
                    <a class="next fa fa-arrow-right">&nbsp;</a>
                </div>
                <div class="product-carousel" id="module-0-carousel">
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/1.jpg" alt="brand1" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/2.jpg" alt="brand2" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/3.jpg" alt="brand3" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/4.jpg" alt="brand4" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/5.jpg" alt="brand5" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/6.jpg" alt="brand6" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/7.jpg" alt="brand7" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/1.jpg" alt="brand9" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/2.jpg" alt="banner8" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="slider-item">
                        <div class="product-block">
                            <div class="product-block-inner">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/brand/3.jpg" alt="brand10" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="module_default_width" style="display:none; visibility:hidden"></span>

        </div>
    </div>
</div>

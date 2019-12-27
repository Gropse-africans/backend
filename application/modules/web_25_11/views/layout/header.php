<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/web/images/logo/favicon.png">
        <title>Africa Supermarket : Online Supermarket  in Sauth Africa</title>
        <meta name="description" content="Online Supermarket Shopping is easy at Sauth Africa. Home Delivery with Convenient 1 hour Slots and New Low Prices. Check your Postcode Today." />
        <meta name="keywords" content="Africa Supermarket, Online Supermarket, Online Supermarket  in Sauth Africa, Online Supermarket Shopping, Africa Supermarket in Sauth Africa" />
        <meta name="author" content="Africa Supermarket" />
        <link href="https://www.africanssupermarket.com/" rel="canonical" />
        <meta name="Classification" content="Africa Supermarket" />
        <meta name="abstract" content="https://www.africanssupermarket.com/" />
        <meta name="audience" content="All" />
        <meta name="robots" content="index,follow" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:title" content="Africa Supermarket : Online Supermarket  in Sauth Africa" />
        <meta property="og:description" content="Online Supermarket Shopping is easy at Sauth Africa. Home Delivery with Convenient 1 hour Slots and New Low Prices. Check your Postcode Today." />
        <meta property="og:url" content="https://www.africanssupermarket.com/" />
        <meta property="og:image" content="<?php echo base_url(); ?>assets/web/images/logo/og.png" />
        <meta property="og:site_name" content="Africa Supermarket" />
        <meta name="googlebot" content="index,follow" />
        <meta name="distribution" content="Global" />
        <meta name="Language" content="en-us" />
        <meta name="doc-type" content="Public" />
        <meta name="site_name" content="Africa Supermarket" />
        <meta name="url" content="https://www.africanssupermarket.com/" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/stylesheet.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/lightbox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/owl.transitions.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/swiper.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/opencart.css">
        <style>
            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 100%;
                height: 100%;
                position: absolute;
                position: fixed;
                display: block;
                opacity: 1;
                z-index: 9999;
                text-align: center;
                background: rgba(0,0,0,0.5);

            }
            .lds-ellipsis div {
                position: absolute;
                top:50%;

                width: 11px;
                height: 11px;
                border-radius: 50%;
                background: #fff;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
                text-align: center;
            }
            .lds-ellipsis div:nth-child(1) {
                left: 47%;
                animation: lds-ellipsis1 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(2) {
                left: 48%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(3) {
                left: 50%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(4) {
                left: 51%;
                animation: lds-ellipsis3 0.6s infinite;
            }
            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
            }
            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(19px, 0);
                }
            }

            .fav{
                color: #fff !important;
                background: #fab112 !important;
            }
            .selected-filter{
                background-color: antiquewhite;
            }
        </style>
    </head>
    <body>
        <div id="loading" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        <header>
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 header-logo">
                            <div id="logo">
                                <a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets/web/images/logo/logo_header.png" title="Africa Supermarket" alt="Africa Supermarket" class="img-responsive" /></a>
                            </div>
                        </div>
                        <div class="header_center">
                            <div class="col-sm-4 header_search">
                                <div id="searchbox" class="input-group searchtoggle">
                                    <form method="post" action="<?= base_url() ?>search-results">
                                        <div class="search_box">
                                            <select name="category_id" class="form-control-select">
                                                <option value="0">Select Type</option>
                                                <option value="Product">Product</option>
                                                <option value="Service">Service</option>
                                            </select>
                                        </div>
                                        <div class="search_box">
                                            <select name="category_id" class="form-control-select">
                                                <option value="0">All Categories</option>
                                                <?php if (isset($header['category'])):foreach ($header['category'] as $header_category): ?>
                                                        <option value="<?= $header_category['id'] ?>"><?= $header_category['name'] ?></option>
                                                    <?php endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                        <input type="text" name="search" value="<?= set_value('search') ? set_value('search') : '' ?>" placeholder="Search Product Here..." onkeyup="checkSearchInput(this);" class="form-control input-lg" />
                                        <span class="input-group-btn">
                                            <button type="submit" disabled="true" id="search_btn" class="btn btn-default btn-lg"></i></button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="header_right">
                            <div class="headertop-text">
                                <div class="second-content main-content">
                                    <div class="cms_content">
                                        <div class="cms_img2"></div>
                                        <div class="cms-block">
                                            <div class="cms_subtitle">Vendor</div>
                                            <div class="cms_title "><a  class="text-white" href="<?= base_url() ?>vendor">Signin/Signup</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="address-content main-content">
                                    <div class="cms_content">
                                        <div class="cms_img3"></div>
                                        <div class="cms-block">
                                            <?php
                                            $user = $this->session->userdata('customer_logged_in');
                                            if ($user && $user['address']) {
                                                $address = $user['address'];
                                            } else {
                                                if ($this->session->userdata('user_location')) {
                                                    $user_location = $this->session->userdata('user_location');
                                                    $address = $user_location['address'];
                                                } else {
                                                    $address = $user['address'];
                                                    echo "<script>$.removeCookie('pop');</script>";
                                                    
                                                }
                                            }



                                            //$cookie = get_cookie('african_super_market');
//                                                if ($cookie) {
//                                                    $location= json_decode($cookie);
//                                                    $address = $location['address'];
//                                                } else {
//                                                    $address = 'Set Your Location';
//                                                }
                                            ?>
                                            <div class="cms_subtitle"><a id="edit" href="#searchlocation" data-toggle="modal">Location <i class="fa fa-pencil"></i></a></div>
                                            <div class="cms_title" id="locator"><?= $address ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container">
                    <div class="row">
                        <div class="box-category-top">
                            <div class="box-subtitle">Shop By</div>
                            <div class="box-heading">Categories <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                        </div>
                        <div class="box-content-category">
                            <ul id="nav-one" class="dropmenu box-category">
                                    <?php if (isset($header['category'])):foreach ($header['category'] as $header_category): ?>
                                        <li class="top_level dropdown"><a style="cursor: pointer;" href="<?=base_url()?>subcategory-list/<?=$header_category['id']?>"><?= $header_category['name'] ?></a><span class="cat"></span>
        <?php if ($header_category['sub_category']): ?>
                                                <div class="dropdown-menu megamenu column3">
                                                    <div class="dropdown-inner">

                                                        <ul class="list-unstyled childs_1">
            <?php foreach ($header_category['sub_category'] as $header_sub): ?>
                                                                <li class="dropdown"><a href="<?= base_url() ?>product-list/<?= $header_sub['parent_id'] ?>/<?= $header_sub['id'] ?>"><?= $header_sub['name'] ?></a>
                                                                </li>
            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                        </li>                               
    <?php endforeach;
endif; ?>
                            </ul>
                        </div>
                        <nav class="nav-container" role="navigation">
                            <div class="nav-inner">
                                <div id="menu" class="main-menu">
                                    <div id="res-menu" class="main-menu nav-container1 responsive-menu">
                                        <div class="nav-responsive"><span>Menu</span>
                                            <div class="expandable"></div>
                                        </div>
                                        <ul class="main-navigation">
                                            <li><a href="<?= base_url() ?>">Home</a></li>
                                                    <?php if (isset($header['category'])):foreach ($header['category'] as $header_category_m): ?>
                                            <li><a style="cursor: pointer;" href="<?=base_url()?>subcategory-list/<?=$header_category_m['id']?>"><?= $header_category_m['name'] ?></a>
                                                        <ul>
        <?php foreach ($header_category_m['sub_category'] as $header_sub_m): ?>
                                                                <li class="dropdown"><a href="<?= base_url() ?>product-list/<?= $header_sub_m['parent_id'] ?>/<?= $header_sub_m['id'] ?>"><?= $header_sub_m['name'] ?></a>

                                                                </li>
                                                    <?php endforeach; ?>
                                                        </ul>
                                                    </li>
    <?php endforeach;
endif; ?>
                                        </ul>
                                    </div>
                                    <div class="static-menu">
                                        <ul id="static-menu">
                                            <li><a href="<?= base_url() ?>">Home</a></li>
                                            <!--<li class="new menu-item"><a href="<?= base_url() ?>product-list">New collection</a></li>-->
                                            <li><a>Brands</a></li>
                                            <li class="menu-item"><a href="<?= base_url() ?>advertisement-list">Advertisement</a></li>
                                            <li><a href="<?= base_url() ?>about-us">About  Us</a></li>
                                            <li><a href="<?= base_url() ?>contact-us">Contact Us</a></li>
                                        </ul>
                                    </div>

                                </div>

                            </div>

                        </nav>

<?php
if ($user) {
    ?>
                            <div class="account">
                                <li class="dropdown myaccount"><a title="My Account" class="dropdown-toggle" style="cursor:pointer;" data-toggle="dropdown"><span class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                                        <div class="drop_account">
                                            <div class="login_acc">
                                                <li><a href="<?= base_url() ?>my-account" id="wishlist-total" title="Account Details">Account Details</a></li>
                                                <!--<li><a href="<?= base_url() ?>my-wishlist" id="wishlist-total" title="Wish List"></a></li>-->
                                                <li><a href="<?= base_url() ?>wishlist" id="wishlist-total" title="Wish List">Wish List</a></li>
                                                <!--<li><a href="<?= base_url() ?>checkout" title="Checkout"><span class="checkout">Checkout</span></a></li>-->
                                                <li><a href="<?= base_url() ?>logout" id="wishlist-total" title="Logout">Logout</a></li>
                                            </div>
                                        </div>
                                    </ul>
                                </li>
                                <div class="col-sm-3 header_cart">
                                    <div id="cart" class="btn-group btn-block">
                                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                                            <div class="cart_detail">
                                                <div class="cart_image"></div><span id="cart-total">
                                                    <!--<span class="item-count">2</span>-->
                                                    <!--<span class="mycart">My cart</span>--> 
                                                    <!--<span class="price"> $500.00 </span>-->

                                                </span>
                                            </div>
                                        </button>
                                        <!--                                        <ul class="dropdown-menu pull-right cart-menu">
                                                                                    <li>
                                                                                        <table class="table table-striped">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-center">
                                                                                                        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/web/images/product/women/01.png" alt="Mandarin Collar Shirt Dress" title="Mandarin Collar Shirt Dress" class="img-thumbnail"></a>
                                                                                                    </td>
                                                                                                    <td class="text-left"><a href="<?= base_url() ?>">Mandarin Collar Shirt Dress</a> </td>
                                                                                                    <td class="text-right">x 1</td>
                                                                                                    <td class="text-right">$180.00</td>
                                                                                                    <td class="text-center">
                                                                                                        <button type="button" onclick="" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-center">
                                                                                                        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/web/images/product/women/02.png" alt="Scoop Neck Maxi Dress" title="Scoop Neck Maxi Dress" class="img-thumbnail"></a>
                                                                                                    </td>
                                                                                                    <td class="text-left"><a href="<?= base_url() ?>">Scoop Neck Maxi Dress</a> </td>
                                                                                                    <td class="text-right">x 1</td>
                                                                                                    <td class="text-right">$200.00</td>
                                                                                                    <td class="text-center">
                                                                                                        <button type="button" onclick="" title="Remove" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div>
                                                                                            <table class="table table-bordered">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="text-right"><strong>Sub-Total</strong></td>
                                                                                                        <td class="text-right">$380.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                                                                                        <td class="text-right">$20.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-right"><strong>VAT (20%)</strong></td>
                                                                                                        <td class="text-right">$100.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="text-right"><strong>Total</strong></td>
                                                                                                        <td class="text-right">$500.00</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <p class="text-right button-container">
                                                                                            <a href="<?= base_url() ?>shopping-cart"><strong> View Cart</strong></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url() ?>checkout"><strong> Checkout</strong></a></p>
                                                                                    </li>
                                                                                </ul>-->
                                    </div>
                                </div>
                            </div>
<?php } else {
    ?>
                            <div class="account loginsignup">
                                <ul>
                                    <li><a href="<?= base_url() ?>login">Login</a></li>
                                    <li><a href="#">/</a></li>
                                    <li><a href="<?= base_url() ?>register">Registration</a></li>
                                </ul>
                            </div>
<?php } ?>
                    </div>

                </div>
            </div>
        </header>
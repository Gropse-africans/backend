

<div class="container_full">

    <div class="side_bar scroll_auto ">

        <div class="user-panel">

            <div class="user_image">

                <img src="<?= $this->vendor['image'] ? $this->vendor['image'] : base_url() . 'assets/vendor/common/images/user/user.jpg' ?>" class="img-circle" alt="User Image">

            </div>

            <div class="info">

                <p>
                    <?= $this->vendor['name'] ? $this->vendor['name'] : 'Vendor Panel' ?>

                </p>

                <a href="<?php echo base_url('dashboard'); ?>">

            </div>

        </div>

        <ul id="dc_accordion" class="sidebar-menu tree">

            <li>

                <a href="<?php echo base_url('vendor/dashboard'); ?>">

                    <i class="fa fa-home"></i>

                    <span>Dashboard</span>

                </a>

            </li>
            <!--          <li class="menu_sub">
            
                        <a href="#">
            
                          <i class="fa fa-first-order"></i>
            
                          <span>Order Management</span>
            
                          <span class="arrow"></span>
            
                        </a>
            
                        <ul class="down_menu">
            
                          <li>
            
                            <a href="<?php echo base_url('vendor/order-list'); ?>">Order List</a>
            
                          </li>
            
                        </ul>
            
                      </li>-->

            <li class="menu_sub">

                <a href="#">

                    <i class="fa fa-archive"></i>

                    <span>Product Management</span>

                    <span class="arrow"></span>

                </a>

                <ul class="down_menu">

                    <li>

                        <a href="<?php echo base_url('vendor/product-list'); ?>">Product List</a>
                        <a href="<?php echo base_url('vendor/add-product'); ?>">Add Product</a>

                    </li>

                </ul>

            </li>
            <!--          <li class="menu_sub">
            
                        <a href="#">
            
                          <i class="fa fa-handshake-o"></i>
            
                          <span>Service Management</span>
            
                          <span class="arrow"></span>
            
                        </a>
            
                        <ul class="down_menu">
            
                          <li>
            
                            <a href="<?php echo base_url('vendor/service-list'); ?>">Service List</a>
                            <a href="<?php echo base_url('vendor/add-service'); ?>">Add Service</a>
            
                          </li>
            
                        </ul>
            
                      </li>-->

            <!--          <li>
            
                        <a href="<?php echo base_url('vendor/notification'); ?>">
            
                          <i class="fa fa-bell"></i>
            
                          <span>Notification</span>
            
                        </a>
            
                      </li>-->
            <li class="menu_sub">

                <a href="#">

                    <i class="fa fa-tasks"></i>

                    <span>Subscription Plan</span>

                    <span class="arrow"></span>

                </a>

                <ul class="down_menu">

                    <li>

                        <a href="<?php echo base_url('vendor/subscription-plan'); ?>">View All Plans</a>
                        <!--<a href="<?php echo base_url('vendor/add-product'); ?>">Add Product</a>-->

                    </li>

                </ul>

            </li>
            <li class="menu_sub">

                <a href="#">

                    <i class="fa fa-newspaper-o"></i>

                    <span>Advertisement Management</span>

                    <span class="arrow"></span>

                </a>

                <ul class="down_menu">

                    <li>

                        <a href="<?php echo base_url('vendor/advertisement-list'); ?>">Advertisement List</a>
                        <a href="<?php echo base_url('vendor/add-advertisement'); ?>">Add Advertisement</a>

                    </li>

                </ul>

            </li>
        </ul>

    </div>


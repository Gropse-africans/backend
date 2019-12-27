

    <div class="container_full">

      <div class="side_bar scroll_auto ">

        <div class="user-panel">

          <div class="user_image">

            <img src="<?php echo base_url();?>assets/admin/images/admin/about-1.jpg" class="img-circle" alt="User Image">

          </div>

          <div class="info">

            <p>

              Welcome Admin

            </p>

            <a href="<?php echo base_url('admin/dashboard');?>">

          </div>

        </div>

        <ul id="dc_accordion" class="sidebar-menu tree">

          <li>

            <a href="<?php echo base_url('admin/dashboard');?>">

              <i class="fa fa-home"></i>

              <span>Dashboard</span>

            </a>

          </li>
          <li class="menu_sub">

            <a href="#">

              <i class="fa fa-user"></i>

              <span>User Management</span>

              <span class="arrow"></span>

            </a>

            <ul class="down_menu">

              <li>

                <a href="<?php echo base_url('admin/user-list');?>">User List</a>

              </li>

            </ul>

          </li>
          <li class="menu_sub">

            <a href="#">

              <i class="fa fa-users"></i>

              <span>Vendor Management</span>

              <span class="arrow"></span>

            </a>

            <ul class="down_menu">

              <li>

                <a href="<?php echo base_url('admin/vendor-list');?>">Vendor List</a>

              </li>

            </ul>

          </li>
<!--          <li class="menu_sub">

            <a href="#">

              <i class="fa fa-first-order"></i>

              <span>Order Management</span>

              <span class="arrow"></span>

            </a>

            <ul class="down_menu">

              <li>

                <a href="<?php echo base_url('order-list');?>">Order List</a>

              </li>

            </ul>

          </li>-->

          <li class="menu_sub">

            <a href="#">

              <i class="fa fa-shopping-cart"></i>

              <span>Product Management</span>

              <span class="arrow"></span>

            </a>

            <ul class="down_menu">

              <li>

                <a href="<?php echo base_url('admin/verify-product-list');?>">Verify Product List</a>
                <a href="<?php echo base_url('admin/unverify-product-list');?>">Un-Verify Product List</a>
                <a href="<?php echo base_url('admin/add-product');?>">Add Product</a>

              </li>

            </ul>

          </li> 
         <li class="menu_sub">

            <a href="#">

              <i class="fa fa-user-secret"></i>

              <span>Advertisment Management</span>

              <span class="arrow"></span>

            </a>

            <ul class="down_menu">

              <li>

                <a href="<?php echo base_url('admin/advertisment');?>">Advertisment List</a> 

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

                <a href="<?php echo base_url('service-list');?>">Service List</a>
                <a href="<?php echo base_url('add-service');?>">Add Service</a>

              </li>

            </ul>

          </li>-->
                    <li class="menu_sub">

            <a href="#">

              <i class="fa fa-cog"></i>

              <span>Setting</span>

              <span class="arrow"></span> 

            </a>

            <ul class="down_menu">

              <li>
                <!--<a href="<?php echo base_url('business-cat');?>">Business Category</a>-->
                <a href="<?php echo base_url('admin/category');?>">Category</a>
                <a href="<?php echo base_url('admin/sub-category');?>">Sub-Category</a> 
                <!--<a href="<?php echo base_url('subscription');?>">subscription Plan</a>--> 

              </li>

            </ul>

          </li>

<!--          <li>

            <a href="<?php echo base_url('notification');?>">

              <i class="fa fa-bell"></i>

              <span>Notification</span>

            </a>

          </li>-->


        </ul>

      </div>

      
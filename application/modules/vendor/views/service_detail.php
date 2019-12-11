      <?php include 'include/header.php';?>

      <?php include 'include/sidebar.php';?>



    <div class="container_full">



      <main class="content_wrapper">

        <!--page title start-->

        <div class="page-heading">

          <div class="container-fluid">

            <div class="row d-flex align-items-center">

              <div class="col-md-6">

                <div class="page-breadcrumb">

                  <h1>Service Detail</h1>

                </div>

              </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>
                                        
                                        <a class="parent-item addnewproduct" href="<?php echo site_url('edit-service');?>">Edit Service Detail</a>
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

                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

                    </ol>

                    <div class="carousel-inner">

                      <div class="carousel-item active">

                        <img src="<?php echo site_url();?>common/images/service/2.png" alt="slider">

                      </div>

                      <div class="carousel-item">

                        <img src="<?php echo site_url();?>common/images/service/1.png" alt="slider1">

                      </div>

                      <div class="carousel-item">

                        <img src="<?php echo site_url();?>common/images/service/3.png" alt="slider2">

                      </div>

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

                          Service ID :</th>

                        <td>#S10021</td>

                      </tr>

                      <tr>

                        <th>

                          Service Name :</th>

                        <td>Digital Marketing</td>

                      </tr>

                      <tr>

                        <th>

                          Service Discount:</th>

                        <td>10%</td>

                      </tr>

                      <tr>

                        <th>

                          Service Price:</th>

                        <td> $200 </td>

                      </tr>


                    </tbody>

                  </table>

                </div>

              </div>

             <div class="panel">

                <div class="panel-heading">

                  <h3 class="panel-title"><strong> Description </strong></h3>

                </div>

                <div class="panel-content panel-activity">

                      <div class=" entry-content">

                        <p>

                           Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ab a nostrum repudiandae dolorem ut quaerat veniam asperiores, rerum voluptatem magni dolores corporis!.

                        </p>

                      </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </main>

    </div>





      <?php include 'include/footer.php';?>


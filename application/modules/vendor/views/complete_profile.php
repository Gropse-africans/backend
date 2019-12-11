      <?php include 'include/header.php';?>

      <?php include 'include/sidebar.php';?>
    <div class="container_full">

      <main class="content_wrapper">

        <div class="page-heading">

          <div class="container-fluid">

            <div class="row d-flex align-items-center">

              <div class="col-md-6">

                <div class="page-breadcrumb">

                  <h1>Complete Your Profile </h1>

                </div>

              </div>

              <div class="col-md-6 justify-content-md-end d-md-flex">

                <div class="breadcrumb_nav">

                  <ol class="breadcrumb">

                    <li>

                      <i class="fa fa-home"></i>

                      <a class="parent-item" href="index.html">Home</a>

                      <i class="fa fa-angle-right"></i>

                    </li>

                    <li class="active">

                      Profile

                    </li>

                  </ol>

                </div>

              </div>

            </div>

          </div>

        </div>

<form id="Franchisee" method="post" class="right-text-label-form" action="#">
        <div class="container-fluid">

          <div class="row">

            <div class=" col-md-12">

              <div class="card card-shadow mb-4">

                <div class="card-header">

                  <div class="card-title">

                     Genral Information

                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Vendor Name</label>

                                      <input type="text" class="form-control" placeholder="Enter Vendor Name">

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Phone No</label>

                                      <input type="text" class="form-control" placeholder="Enter Phone No">

                                </div>

                          </div>

                    </div>

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Email Id</label>

                                      <input type="text" class="form-control" placeholder="Enter Email">

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Address</label>

                                      <input type="text" class="form-control" placeholder="Enter Phone No">

                                </div>

                          </div>

                    </div>

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">City</label>

                                        <select class="form-control">

                                                <option>Cape Town , Western Cape</option>

                                                <option>Durban , KwaZulu-Natal</option>

                                                <option>Johannesburg , Gauteng</option>

                                        </select>

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Country</label>

                                        <select class="form-control">

                                                <option>South Africa</option>

                                                <option>India</option>

                                                <option>USA</option>

                                        </select>

                                </div>

                          </div>



                    </div>

                </div>

              </div>

            </div>

          </div>

        </div>
        <div class="container-fluid">

          <div class="row">

            <div class=" col-md-12">

              <div class="card card-shadow mb-4">

                <div class="card-header">

                  <div class="card-title">

                     Compeny Information

                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Compeny Name</label>

                                      <input type="text" class="form-control" placeholder="Enter Vendor Name">

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Compeny Phone No</label>

                                      <input type="text" class="form-control" placeholder="Enter Phone No">

                                </div>

                          </div>

                    </div>

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Compeny Email Id</label>

                                      <input type="text" class="form-control" placeholder="Enter Email">

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Company Provides</label>

                                        <select class="form-control">

                                                <option>Product</option>

                                                <option>Service</option>

                                                <option>Both</option>

                                        </select>

                                </div>

                          </div>

                    </div>

                    <div class="row">

                          <div class="col-sm-12">

                               <div class="form-group">

                                    <label for="name">Compeny Address</label>

                                      <input type="text" class="form-control" placeholder="Compeny Address">

                                </div>

                          </div>



                    </div>

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">City</label>

                                        <select class="form-control">

                                                <option>Cape Town , Western Cape</option>

                                                <option>Durban , KwaZulu-Natal</option>

                                                <option>Johannesburg , Gauteng</option>

                                        </select>

                                </div>

                          </div>

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name">Country</label>

                                        <select class="form-control">

                                                <option>South Africa</option>

                                                <option>India</option>

                                                <option>USA</option>

                                        </select>

                                </div>

                          </div>



                    </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="container-fluid">

          <div class="row">

            <div class=" col-md-12">

              <div class="card card-shadow mb-4">

                <div class="card-header">

                  <div class="card-title">

                    Profile  Image

                  </div>

                </div>

                <div class="card-body">

                  <div class=" right-text-label-form" >





                    <div class="form-group row titleeventimage">

                      <div class="col-sm-4 file-upload">

                        <img id="blah1" src="<?php echo site_url();?>common/images/logo/dummy.jpg" alt="your image" />





                            <label for="upload1" class="file-upload__label">Upload Image </label>

                            <input id="upload1" class="file-upload__input" type="file" name="file-upload" onchange="readURL(this,1);">

                      </div>




                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>






        <div class="container-fluid">

          <div class="row">

            <div class=" col-md-12">

              <div class="card card-shadow mb-4">

                <div class="card-body">

                      <div class="col-sm-12 ml-auto">

                        <button type="submit" class="btn btn-primary" name="signup" value="Sign up">

                          Upload 

                        </button>

                      </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </form>





      </main>

    </div>


      <?php include 'include/footer.php';?>


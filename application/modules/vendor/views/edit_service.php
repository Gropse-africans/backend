      <?php include 'include/header.php';?>

      <?php include 'include/sidebar.php';?>
    <div class="container_full">

      <main class="content_wrapper">

        <div class="page-heading">

          <div class="container-fluid">

            <div class="row d-flex align-items-center">

              <div class="col-md-6">

                <div class="page-breadcrumb">

                  <h1>Edit Service </h1>

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

                      Edit Service

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

                     Edit Service Information

                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                          <div class="col-sm-6">

                               <div class="form-group">

                                    <label for="name"> Service Name</label>

                                      <input type="text" class="form-control" placeholder="Enter Service Name">

                                </div>

                          </div>

                          <div class="col-sm-3">

                               <div class="form-group">

                                    <label for="name">Service Category</label>

                                        <select class="form-control">

                                                <option>Select</option>

                                                <option>1</option>

                                                <option>2</option>

                                                <option>3</option>

                                                <option>4</option>

                                        </select>

                                </div>

                          </div>
                          <div class="col-sm-3">

                               <div class="form-group">

                                    <label for="name">Service Sub Category</label>

                                        <select class="form-control">

                                                <option>Select</option>

                                                <option>1</option>

                                                <option>2</option>

                                                <option>3</option>

                                                <option>4</option>

                                        </select>

                                </div>

                          </div>

                    </div>

                    <div class="row">

                          <div class="col-sm-4">

                               <div class="form-group">

                                    <label for="name">Service Price</label>

                                      <input type="text" class="form-control" placeholder="Enter Price">

                                </div>

                          </div>

                          <div class="col-sm-4">

                               <div class="form-group">

                                    <label for="name">Time Duration</label>

                                      <input type="text" class="form-control" placeholder="Enter Duration">

                                </div>

                          </div>
                          <div class="col-sm-4">

                               <div class="form-group">

                                    <label for="name">Total Discount</label>

                                      <input type="text" class="form-control" placeholder="Discount">

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

                    Edit Service Description

                  </div>

                </div>

                <div class="card-body">

                    <div class="row">

                          <div class="col-sm-12">

                              <div class="editor-wrapper">

                                <div id="editor" class="editor"></div>

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

                    Edit Service Images

                  </div>

                </div>

                <div class="card-body">

                  <div class=" right-text-label-form" >





                    <div class="form-group row titleeventimage">

                      <div class="col-sm-3 file-upload">

                        <img id="blah1" src="<?php echo site_url();?>common/images/logo/dummy.jpg" alt="your image" />





                            <label for="upload1" class="file-upload__label">Upload Image </label>

                            <input id="upload1" class="file-upload__input" type="file" name="file-upload" onchange="readURL(this,1);">

                      </div>

                      <div class="col-sm-3 file-upload">

                        <img id="blah2" src="<?php echo site_url();?>common/images/logo/dummy.jpg" alt="your image" />





                            <label for="upload2" class="file-upload__label">Upload Image </label>

                            <input id="upload2" class="file-upload__input" type="file" name="file-upload" onchange="readURL(this,2);">

                      </div>

                      <div class="col-sm-3 file-upload">

                        <img id="blah3" src="<?php echo site_url();?>common/images/logo/dummy.jpg" alt="your image" />





                            <label for="upload3" class="file-upload__label">Upload Image </label>

                            <input id="upload3" class="file-upload__input" type="file" name="file-upload" onchange="readURL(this,3);">

                      </div>

                      <div class="col-sm-3 file-upload">

                        <img id="blah4" src="<?php echo site_url();?>common/images/logo/dummy.jpg" alt="your image" />





                            <label for="upload4" class="file-upload__label">Upload Image </label>

                            <input id="upload4" class="file-upload__input" type="file" name="file-upload" onchange="readURL(this,4);">

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

                          Update 

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


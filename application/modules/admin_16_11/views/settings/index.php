<style>
    .imgResponsive{
        width: 50px;
         height: auto;
/*        height: 50px;*/
/*        border-radius: 58%;
        border: 3px solid #12551e;*/
    }
</style>
    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Price Management</h1>

                            </div>

                        </div>
                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?= base_url('admin/dashboard');?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                      Price Management

                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


   
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class=" col-md-6">
                                <div class="card card-shadow card-body mb-4">
                                     <h2>Shipping Charge & TAX Management</h2>
                                    <div class="col-md-12"><?php echo $this->session->flashdata('response'); ?></div>
                                    <form method="post"  enctype="multipart/form-data">
                                        <label for="validationCustom01" class="mt-2">Shipping Charges</label>
                                        <input type="text" name="shipping_charges" required="" class="form-control" placeholder="Shipping Charges" value="<?=$settings['shipping_charges']?>">
                                        <?= form_error('shipping_charges') ?>
                                        
                                        <label class="mt-2">TAX (%)</label>
                                        <input type="text" name="tax" required="" class="form-control" placeholder="TAX (%)" value="<?=$settings['tax']?>">
                                        <?= form_error('tax') ?>
                                        
                                        <button type="submit" name="product" value="update" class="btn btn-success ml-auto mt-4 ">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                
                                <div class="card card-shadow card-body mb-4">
                                    <h2>Service Charges</h2>
                                    <div class="col-md-12"><?php echo $this->session->flashdata('response'); ?></div>
                                    <form method="post"  enctype="multipart/form-data">
                                        <label for="validationCustom01" class="mt-2">Service Fee</label>
                                        <input type="text" name="service_fees" required="" class="form-control" placeholder="Service Fee" value="<?=$settings['service_fees']?>">
                                        <?= form_error('service_fees') ?>
                                        <button type="submit" class="btn btn-success ml-auto mt-4 " name="service" value="update" >Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

               

        </main>

    </div>
<script>
        function checkStatus(obj, id) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 0;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=6',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
        function deleteCategory(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
              var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=6',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                alert('Brand Deleted.');
                                window.location.href="<?= base_url(); ?>admin/brand";
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                } else {
                    alert("Something Wrong");
                }
            }
        }
        $(document).ready(function () {
            $('#example1').DataTable();
        });
    </script>

<div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>Advertisment List</h1>

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

                                       Advertisment List

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

                    <div class=" col-sm-12">

                        <div class="card card-shadow mb-4">

                            <div class="card-body">

                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">

                                                <thead>
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Image</th>
                                                        <th>Uploaded Date</th>
                                                        <th>Title</th>
                                                        <th>Vendor</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sr=1;
                                                    if($advertisment){
                                                        foreach ($advertisment as $value) {
                                                            ?>
                                                    <tr> 
                                                        <td><?=$sr;?></td>
                                                        <td class="product-tab-img"><a href="<?=$value['image'];?>" target="_blank"><img style="width: 30px;height: auto;" src="<?=$value['image'];?>"></a></td>
                                                        <td><?=$value['created_at'];?></td>
                                                       
                                                        <td><?=$value['name'];?></td>
                                                        <td><a href="<?= base_url('admin/vendor-detail/'.$value['vendor_id']);?>"><?=$value['vendor']['name'];?></td>
                                                        <td><?=$value['description'];?></td>
                                                        <td><div class="mytoggle">
                                                            <label class="switch">
                                                                <input type="checkbox" <?= $value['status'] == '1' ? 'checked' : '' ?> onchange="checkStatus(this,<?= $value['id'] ?>)"> <span class="slider round"></span> </label>
                                                        </div></td>
                                                         
                                                    </tr>
                                                    <?php
                                                    $sr++;
                                                        }
                                                    }
                                                    ?>
                                                    
                                                </tbody>

                                </table>

                            </div>

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
                var status = 2;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=5',
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
        $(document).ready(function () {
            $('#example1').DataTable();
        });
    </script>
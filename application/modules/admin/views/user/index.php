
<div class="container_full">

    <div class="container-fluid">

        <main class="content_wrapper">

            <div class="page-heading">

                <div class="container-fluid">

                    <div class="row d-flex align-items-center">

                        <div class="col-md-6">

                            <div class="page-breadcrumb">

                                <h1>User List</h1>

                            </div>

                        </div>

                        <div class="col-md-6 justify-content-end d-flex">

                            <div class="breadcrumb_nav">

                                <ol class="breadcrumb">

                                    <li>

                                        <i class="fa fa-home"></i>

                                        <a class="parent-item" href="<?php echo base_url('admin/dashboard');?>">Home</a>

                                        <i class="fa fa-angle-right"></i>

                                    </li>

                                    <li class="active">

                                        User List

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
                                            <th>Sr.No</th>
                                            <th>User Name</th>
                                            <th>Email Id</th>
                                            <th>Mobile No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $count = 1;
                                       if($users){
                                            foreach ($users as $user):
                                                ?>
                                                <tr>
                                                    <td><span class="txt-dark weight-500"><?= $count ?></span></td>
                                                    <td><?= ucwords($user['name']) ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?= $user['mobile'] ?></td>
                                                    <td>
                                                        <?php if($user['status']==0){?>
                                                            <span class="label label-default">Email Not Verified</span>
                                                        <?php }else{ ?>
                                                        <div class="mytoggle">
                                                            <label class="switch">
                                                                <input type="checkbox" <?= $user['status'] == '1' ? 'checked' : '' ?> onchange="checkStatus(this,<?= $user['id'] ?>)"> <span class="slider round"></span> </label>
                                                        </div>
                                                        <?php } ?>
                                                        </td>
                                                    <td>
                                                        <a href="<?php echo site_url('admin/user-detail/'.$user['id']);?>"><span class="label action-button"><i class="fa fa-eye"></i></span></a></td>
                                                </tr>
                                                <?php $count++;
                                            endforeach;
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
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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
      

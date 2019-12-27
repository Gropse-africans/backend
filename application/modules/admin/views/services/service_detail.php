
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

                                    <a class="parent-item addnewproduct" href="<?php echo base_url(); ?>admin/edit-service/<?= $service['service_id'] ?>">Edit Service Detail</a>
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
            <?= $this->session->flashdata('response'); ?>
            <div class="row">

                <div class="col-lg-6">

                    <div class="panel profile-cover">

                        <div id="carouselExampleIndicators" class="carousel slide sliderevent" data-ride="carousel">

                            <ol class="carousel-indicators">
                                <?php foreach ($service['service_images'] as $key => $img): ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $key ? '' : 'active' ?>"></li>
                                <?php endforeach; ?>
                            </ol>
                            <!-- print -->
                            <div class="carousel-inner">
                                <?php foreach ($service['service_images'] as $keys => $image): ?>
                                    <div class="carousel-item <?= $keys ? '' : 'active' ?>">

                                        <img src="<?= $image['url'] ?>" alt="slider<?= $keys ? $keys : '' ?>">

                                    </div>
                                <?php endforeach; ?>
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
                                        <th>Service ID :</th>
                                        <td class="text-right">#<?= $service['service_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Service Name :</th>
                                        <td class="text-right"><?= $service['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Service Category:</th>
                                        <td class="text-right"><?= $service['category_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Vendor:</th>
                                        <td class="text-right"><a title="view detail" href="<?= base_url() ?>admin/vendor-detail/<?= $service['vendor_id'] ?>"><?= $service['vendor_name'] ?></a></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Status:</th>
                                        <td><select class="form-control" onchange="checkStatus(this, '<?= $service['service_id']; ?>')">
                                                <option value="1" <?php
                                                if ($service['status'] == 1) {
                                                    echo 'selected';
                                                }
                                                ?>>Verify</option>
                                                <option value="0"<?php
                                                if ($service['status'] == 0) {
                                                    echo 'selected';
                                                }
                                                ?>>Un-Verify</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center"> Service Price List</th>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Plan</th>
                                        <th class="text-dark text-right">Description</th>
                                    </tr>
<?php foreach ($service['plans'] as $plan): ?>
                                        <tr>
                                            <th class="text-secondary"><?= $plan['name'] ?></th>

                                        </tr>
                                        <tr>
                                            <th class="text-dark">$<?= $plan['price'] ?></th>
                                            <td class="text-right"><?= $plan['description'] ?></td>
                                        </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Short Description </strong></h3>
                        </div>
                        <div class="panel-content panel-activity">
                            <div class=" entry-content">
                                <p><?= $service['short_description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    function checkStatus(obj, id) {
        var status = $(obj).val();
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=7',
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

</script>





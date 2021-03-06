<div class="container_full">



    <main class="content_wrapper">

        <!--page title start-->

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Product Detail</h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-end d-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <a class="parent-item addnewproduct" href="<?= base_url('admin/edit-product/' . $product['product_id']); ?>">Edit Product Detail</a>
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
                                <?php
                                if ($product) {
                                    if ($product['images']) {
                                        $sr = 0;
                                        foreach ($product['images'] as $imgs) {
                                            ?>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $sr; ?>" class="<?php if ($sr == 0) {
                                    echo 'active';
                                } ?>"></li>
                                            <?php
                                            $sr++;
                                        }
                                    }
                                }
                                ?>
                            </ol>

                            <div class="carousel-inner">
                                <?php
                                if ($product) {
                                    if ($product['images']) {
                                        $sr = 0;
                                        foreach ($product['images'] as $imgs) {
                                            ?>
                                            <div class="carousel-item <?php if ($sr == 0) {
                                    echo 'active';
                                } ?>">
                                                <img src="<?= $imgs['image'] ?>" alt="slider">
                                            </div>
            <?php
            $sr++;
        }
    }
}
?>
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

                                            Product Code :</th>

                                        <td>#<?= $product['product_id']; ?></td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Product Name :</th>

                                        <td><?= $product['name']; ?></td>

                                    </tr>
                                    <tr>

                                        <th>

                                            Category :</th>

                                        <td><?= $product['category']; ?></td>

                                    </tr>
                                    <tr>

                                        <th>

                                            Sub-Category :</th>

                                        <td><?= $product['sub_category']; ?></td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Product Quantity:</th>

                                        <td><?= $product['quantity']; ?></td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Product Price:</th>

                                        <td> $<?= $product['price']; ?></td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Product Discount:</th>

                                        <td><?= $product['discount']; ?>%</td>

                                    </tr>
                                    <tr>

                                        <th>

                                            Vendor Name:</th>

                                        <td><a href="<?= base_url('admin/vendor-detail/' . $product['vendor_id']); ?>"><?= $product['vendor_name']; ?></a></td>

                                    </tr>
                                    <tr>

                                        <th>

                                            Product Status:</th>

                                        <td><?php
if ($product['status'] == 1) {
    echo "Verified";
} else {
    echo "Un-Verified";
}
?></td>

                                    </tr>
                                    <tr>

                                        <th>

                                            Uploaded Date:</th>

                                        <td><?= date('Y-m-d H:i:s', $product['created_at']); ?></td>

                                    </tr>
                                    <tr>
                                        <th>
                                            Status</th>
                                        <td><select class="form-control" onchange="checkStatus(this, '<?= $product['product_id']; ?>')">
                                                <option value="1" <?php if ($product['status'] == 1) {
    echo 'selected';
} ?>>Verify</option>
                                                <option value="0"<?php if ($product['status'] == 0) {
    echo 'selected';
} ?>>Un-Verify</option>
                                            </select></td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>
<?php if ($product['feature']): ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong> Features </strong></h3>
                            </div>
                            <div class="panel-content panel-activity">
    <?php foreach ($product['feature'] as $feature): ?>
                                    <div class=" entry-content">
                                        <div class="row">
                                            <label class="col-sm-5"><strong><?= $feature['title'] ?> </strong>:</label>
                                            <label class="col-sm-7"><?= $feature['value'] ?></label>
                                        </div>
                                    </div>  
    <?php
    endforeach;
    if ($product['specification']):
        ?>
                                    <div class="panel-heading">
                                        <h6 class="panel-title"> Specification </h6>
                                    </div>
                                    <div class="panel-content panel-activity">
                            <?php foreach ($product['specification'] as $specification): ?>
                                            <div class=" entry-content">
                                                <div class="row">
                                                    <label class="col-sm-5"><strong><?= $specification['title'] ?> </strong>:</label>
                                                    <label class="col-sm-7"><?= $specification['value'] ?></label>
                                                </div>

                                            </div>  
        <?php endforeach; ?>
                                    </div>
    <?php endif; ?>
                            </div>
                        </div>
<?php endif; ?>
                    <div class="panel">

                        <div class="panel-heading">

                            <h3 class="panel-title"><strong> Description </strong></h3>

                        </div>

                        <div class="panel-content panel-activity">

                            <div class=" entry-content">

                                <p><?= $product['description']; ?></p>

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
                data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=4',
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
    function deleteProduct(obj, id) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            var status = '99';
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=4',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            window.location.href = "<?= base_url(); ?>admin/verify-product-list";
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
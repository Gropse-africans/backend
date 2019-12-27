
<div class="content_wrapper">
    <!--page title start-->
    <div class="page-heading">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="page-breadcrumb">
                        <h1>Product Category</h1>
                    </div>
                </div>
                <div class="col-md-6 justify-content-end d-flex">
                    <div class="breadcrumb_nav">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a class="parent-item" href="<?= base_url() ?>admin\dashboard">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">
                                Product Category
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page title end-->

    <div class="container-fluid">

        <div class="row mb-2">
            <div class=" col-md-6">
                <div class="card card-shadow card-body mb-4">
                    <form method="post">
                        <label for="validationCustom01">Category Name</label>
                        <input type="text" class="form-control mb-2" placeholder="Category Name" name="name" value="<?= set_value('name') ?>">
                        <?= form_error('name') ?>
                        <label for="validationCustom01">Category Name (Ar)</label>
                        <input type="text" class="form-control" placeholder="Category Name (Ar)" name="name_ar" value="<?= set_value('name_ar') ?>">
                        <?= form_error('name_ar') ?>
                        <button type="submit" class="btn btn-success ml-auto mt-4 ">Submit</button>
                    </form>
                </div>
            </div>
            <div class=" col-md-6">

                <div class="card card-shadow card-body mb-4 width50">

                    <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>

                                <th>Category Name</th>
                            
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=1;foreach($categories as $row):?>
                            <tr>
                                <td><?=$count?></td>

                                <td><?=$row['name'].' ('.$row['name'].') '?></td>

<!--                                <td>
                                    <button class="btn"><i class="fa fa-trash"></i></button>
                                </td>-->
                                <td>
                                    <div class="mytoggle">
                                        <label class="switch">
                                            <input type="checkbox"<?=$row['status']=='1'? "checked":""?> >
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++;endforeach;?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>


</div>
</div>
<!-- Content_right_End -->

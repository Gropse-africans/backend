<div class="container-fluid">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1><h1>Attribute Value For <?= $attribute['title'] ?></h1> </h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-end d-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url('admin/dashboard'); ?>">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Attribute Values

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
                    <?= $this->session->flashdata('response') ?>
                    <div class="card card-shadow card-body mb-4">
                        <form method="post" id="attribute_form" enctype="multipart/form-data">
                            <!--<div class="card-header">Add Attribute</div>-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Attribute Value</label>
                                        <input type="text" class="form-control mb-2" placeholder="Attribute Name" name="name" value="<?= set_value('value') ?>">  
                                        <?= form_error('name') ?>
                                    </div>
                                </div>

                                <div class="col-md-12"> 
                                    <button type="submit" name="submitAttr" class="btn btn-primary pull-right mt-2" />Submit</button> 
                                </div>
                            </div>
                    </div> 
                    </form>
                </div>
            </div>
            <?php if ($attribute['values']): ?>
                <div class="content"> 
                    <div class="card">
                        <div class="card-header sty-one"><h4>All Attribute Values</h4></div>
                        <div class="card-body card-border"> 
                            <div class="table-responsive">
                                <table id="example1" class="table table-button table-striped table-border-res">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th> 
                                            <th>Attribute Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($attribute['values'] as $value):
                                            ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $value['value'] ?></td>
                                            </tr> 
                                            <?php
                                            $count++;
                                        endforeach;
                                        ?>    
                                    </tbody> 
                                </table>
                            </div> 
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div> 
</div>
</main>
</div>
<script>
    var category =<?= json_encode($category) ?>;
    console.log(category);
    function setValues(obj) {
        var category_id = $(obj).val();
        if (category_id) {
            $('#attribute_type').empty();
            var html = '';
            $.each(category, function (index, value) {
                if (value['id'] == category_id) {
                    if (value['attribute_count'] < 2) {
                        html = "<option value='1'>Attribute | صفة، عزا</option>";
                        html += " <option value='2'>Specification | تخصيص</option>";
                        $('#attribute_type').append(html);
                    } else {
                        html = " <option value='2'>Specification | تخصيص</option>";
                        $('#attribute_type').append(html);
                    }
                }
            });
        }
    }
</script>

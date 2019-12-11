
<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Edit Advertisement </h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-md-end d-md-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="<?= base_url('vendor/dashboard'); ?>">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Add Advertisement

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="container-fluid">

            <div class="row">

                <div class=" col-md-12">
                    <form id="Franchisee" method="post" class="right-text-label-form" enctype="multipart/form-data">
                        <div class="card card-shadow mb-4">


                            <div class="card-body">
                                <?= $this->session->flashdata('response'); ?>
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="card card-shadow mb-4">

                                            <div class="card-header">

                                                <div class="card-title">

                                                    Advertisement Name

                                                </div>
                                                <span class="error text-danger" id="name"></span>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-sm-6">
                                                    <div class="form-group">

                                                        <!--<label for="name"> Advertisement Name</label>-->
                                                        <!--<span class="error text-danger" id="name"></span>-->
                                                        <input type="text" class="form-control validate" placeholder="Enter Advertisement Name" value="<?=$ad['name']?>" name="name">
                                                        <?= form_error('name') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class=" col-md-12">

                                        <div class="card card-shadow mb-4">

                                            <div class="card-header">

                                                <div class="card-title">

                                                    Advertisement Description

                                                </div>
                                                <?= form_error('description') ?>
                                                <span class="error text-danger" id="description"></span>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-12">

                                                        <div class="editor-wrapper">

                                                            <textarea id="editor" class="editor validate" name="description"><?=$ad['description']?></textarea>

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

                                                    Advertisement Image

                                                </div>
                                                <span class="error text-danger" id="file_upload"></span>
                                            </div>

                                            <div class="card-body">

                                                <div class=" right-text-label-form" >

                                                    <div class="form-group row titleeventimage">

                                                        <div class="col-sm-8 file-upload" >

                                                            <img id="blah1" style="height:200px;" src="<?=$ad['image']?$ad['image']:base_url().'assets/vendor/common/images/logo/dummy.jpg'?>" alt="your image" />

                                                            <label for="upload1" class="file-upload__label">Upload Image</label>

                                                            <input id="upload1" accept=".jpg,.png,.jpeg" class="file-upload__input validate" type="file" name="file_upload" onchange="readURL(this, 1);">

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

                                                    <button type="button" onclick="validate();" class="btn btn-primary" name="signup" value="Sign up">

                                                        Upload 

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                        </div>
                    </form>
                </div>

            </div>

        </div>
    </main>

</div>


<script type="text/javascript">

    function validate() {
        var flag = true;
        var formData = $("#Franchisee").find('.validate:input').not(':input[type=button],:input[type=file]');

        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0') {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });

        // alert(flag);
        if (flag) {
            $('#Franchisee').submit();
        } else {
            return false;
        }
    }
</script>






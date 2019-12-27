
<div class="container_full">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Advertisement Detail</h1>

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

                                    Advertisement Detail

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
                    <div class="card card-shadow mb-4">


                            <div class="card-body">
                                <?= $this->session->flashdata('response'); ?>
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="card card-shadow mb-4">

                                            <div class="card-header">

                                                <div class="card-title">

                                                    <?= $ad['name'] ?>
                                                    

                                                </div>
                                                <span class="error text-danger" id="name"></span>
                                            </div>
                                            <div class="card-body">
                                               
                                                <div class="form-group row titleeventimage">

                                                    <div class="col-sm-8 file-upload" >

                                                        <img id="blah1" style="height:200px;" src="<?=$ad['image']?$ad['image']:base_url().'assets/vendor/common/images/logo/dummy.jpg'?>" alt="your image" />

                                                    </div>

                                                </div>
                                                 <div class="col-sm-6">
                                                    <?= $ad['description'] ?>
                                                </div>
                                                <div class="col-sm-12 mt-3 text-right">
                                                   <a class="btn btn-success text-white" href="<?=base_url()?>vendor/edit-advertisement/<?=$ad['id']?>">Edit Advertisement</a>
                                                   <a class="btn btn-danger text-white" onclick="deleteProduct(<?=$ad['id']?>);">Delete Advertisement</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                </div>

            </div>

        </div>
    </main>

</div>


<script type="text/javascript">
   function deleteProduct(product){
        var check=confirm('Do you want to delete this advertisement?');
       if (product && check) {       
           $.ajax({
               url: "<?= base_url(); ?>vendor/home/ajax",
               type: 'post',
               data: 'method=deleteData&id=' + product + '&type=2',
               success: function (data) {
                   var dt = $.trim(data);
                   var jsonData = $.parseJSON(dt);
                   if (jsonData['error_code'] == "100") {
                       alert('This Advertisement Is Deleted');
                       window.location.href="<?=base_url()?>vendor/advertisement-list";
                   } else {
                       alert(jsonData['message']);
                   }
               }
           });
       } else {
           return false;
       }
    }
</script>






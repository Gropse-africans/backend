<style>
    .errorPrint{
        font-size: 12px;
        color: #125720;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="container-fluid">

    <main class="content_wrapper">

        <div class="page-heading">

            <div class="container-fluid">

                <div class="row d-flex align-items-center">

                    <div class="col-md-6">

                        <div class="page-breadcrumb">

                            <h1>Subscription Plan</h1>

                        </div>

                    </div>

                    <div class="col-md-6 justify-content-end d-flex">

                        <div class="breadcrumb_nav">

                            <ol class="breadcrumb">

                                <li>

                                    <i class="fa fa-home"></i>

                                    <a class="parent-item" href="http://gropse.com/gropse.com/design/africanssupermarket.com/admin/dashboard">Home</a>

                                    <i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">

                                    Subscription

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <form>
            <div class="container-fluid">

                <div class="row mb-2">

                    <div class=" col-md-12">
                        <div class="card card-shadow card-body mb-4 width50">
                            <table id="bs4-table" class="table  table-button table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>

                                        <th>Plan Name</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    if ($subscription_plan) {
                                        foreach ($subscription_plan as $value):
                                            ?>
                                            <tr>
                                                <td><?= $count; ?></td>

                                                <td id='name_<?= $value['id']; ?>'><?= $value['name']; ?></td>
                                                <td id='price_<?= $value['id']; ?>'><?= $value['price']; ?></td>
                                                <td id='duration_<?= $value['id']; ?>' data-duration='<?= $value['duration']; ?>'><?= $value['duration']; ?> Days</td>
                                                <td id='description_<?= $value['id']; ?>'><?= $value['description']; ?></td>

                                                <td>
                                                    <button type="button" onclick="editPlan(this, '<?= $value['id']; ?>')" class="btn"><i class="fa fa-edit"></i></button>
                                                </td>
                                                <td>
                                                    <div class="mytoggle">
                                                        <label class="switch">
                                                            <input type="checkbox" <?= $value['status'] ? 'checked' : '' ?> onchange="checkStatus(this,<?= $value['id'] ?>)">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $count++;
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class=" col-md-12 edit" style="display:none">
                        <div class="card card-shadow card-body mb-4">
                            <h2>Edit</h2><hr>
                            <label>Plan Name</label>
                            <input type="text" id="name" readonly class="form-control" placeholder="Plan Name">
                            <p class="errorPrint" id="nameError"></p>
                            <input type="hidden" id='id' class="form-control">

                            <label>Price</label>
                            <input type="number" id='price' readonly class="form-control" placeholder="Price">
                            <p class="errorPrint" id="priceError"></p>

                            <label class="mt-2">Days</label>
                            <input type="number" id='days' readonly class="form-control" placeholder="Days"> 
                            <p class="errorPrint" id="daysError"></p>

                            <label class="mt-2">Description</label>
                            <textarea class="form-control" id='description' placeholder="Description" readonly cols="3" rows="6"></textarea> 
                            <p class="errorPrint" id="descriptionError"></p>

                            <button type="button" id="savePlan" onclick="savePlanData(this);" style="display:none;" class="btn btn-success ml-auto mt-4 ">Submit</button>
                        </div>
                    </div> 

                </div> 

            </div>
        </form>
    </main>
</div>
<script>
    function editPlan(obj, id) {
        if (id) {
            $('.edit').css('display', 'block');
            $('.form-control').removeAttr('readonly');
            $('#savePlan').css('display', 'block');
            $('#id').val(id);
            $('#name').val($('#name_' + id).html());
            $('#price').val($('#price_' + id).html());
            $('#days').val($('#duration_' + id).attr('data-duration'));
            $('#description').val($('#description_' + id).html());
            $('html, body').animate({
                scrollTop: $(".edit").offset().top
            }, 1000);
        }
    }
    function savePlanData(obj) {
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".form-control").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('placeholder') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
            }
        });
        var id = $('#id').val();
        if (id) {
            var name = $('#name').val();
            var price = $('#price').val();
            var days = $('#days').val();
            var description = $('#description').val();
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=plan&name=' + name + '&price=' + price + '&days=' + days + '&description=' + description + '&id=' + id,
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "200") {
                        location.reload();
                    } else {
                        $("#alertMessage").css('display', 'block')
                    }
                }
            });
        }
    }
</script>
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
                data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=9',
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
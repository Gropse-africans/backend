<script src="<?php echo base_url('assets/vendor/common/js/jquery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/popper.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/Chart.bundle.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/utils.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/chart.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>

<script src="<?php echo base_url('assets/vendor/common/js/custom.js'); ?>"></script>
<script>
    var $loading = $('#loading').hide();


    //Attach the event handler to any element
    $(document)
            .ajaxStart(function () {
                //ajax request went so show the loading image
                $loading.show();
            })
            .ajaxStop(function () {
                //got response so hide the loading image
                $loading.hide();

            });


</script>
</body>

</html>
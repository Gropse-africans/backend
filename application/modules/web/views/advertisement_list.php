<div id="information-information" class="container">
    <ul class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i></a></li>
        <li><a>Advertisement List</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <h1 class="page-title">Advertisement</h1>
            <div class="advertisement-page">
                <div class="row">
                    <?php 
                    if ($ads_list['ads']):foreach ($ads_list['ads'] as $ad): ?>
                            <div class="col-md-4">
                                <div class="advertisement-main">
                                    <a href="#">
                                        <img src="<?= $ad['image'] ?>" alt="<?= $ad['name'] ?>" />
                                        <h4><?= $ad['vendor_name'] ?> <!--<img src="" alt="user" /> --></h4>
                                    </a>
                                </div>
                            </div>
    <?php endforeach;
else: ?>
                        <div id="content" class="col-sm-12">
                            <div class="notdatafounderror" style="padding: 100px;">
                                <img src="<?php echo base_url(); ?>assets/web/images/opps-error.png"  alt="no data found">
                                <h5>No Advertisement Found</h5>
                            </div>
                        </div>
<?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
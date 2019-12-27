<div id="information-information" class="container">
    <ul class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a>Sub Category</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <h1 class="page-title">Sub Category</h1>
            <div class="brands-page">
                <div class="row">
                    <?php if($sub_category):foreach ($sub_category as $s_category): ?>
                        <div class="slider-item col-md-3">
                            <div class="peoplesay-block sub-category">
                                <div class="test-image">
                                    <div class="left-img">
                                        <a href="<?= base_url() ?>product-list/<?= $s_category['parent_id'] ?>/<?= $s_category['id'] ?>"><img src="<?= $s_category['image'] ? $s_category['image'] : base_url() . 'assets/web/images/category/category1.png' ?>" alt="<?= $s_category['name'] ?>"></a>
                                    </div>
                                </div>
                                <div class="test-dec">
                                    <div class="title">
                                        <a title="<?= $s_category['name'] ?>" href="<?= base_url() ?>product-list/<?= $s_category['parent_id'] ?>/<?= $s_category['id'] ?>"><?= $s_category['name'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;else: ?>
                    <div id="content" class="col-sm-12 productpage">
                        <div class="notdatafounderror">
                            <img src="<?php echo base_url(); ?>assets/web/images/opps-error.png"  alt="no data found">
                            <h5>No Sub-category Found</h5>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

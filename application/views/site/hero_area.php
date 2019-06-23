<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-lg-8">

            <!-- Thông báo -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-success text-center" style="color: red; font-size: 130%;" role="alert">Thông Báo: <?php echo $message; ?></div>
            <?php endif ?>
            <!-- END -->
            

            <!-- Breaking News Widget -->
            <div class="breaking-news-area d-flex align-items-center">
                <div class="news-title">
                    <p>Hôm nay</p>
                </div>
                <div id="breakingNewsTicker" class="ticker">
                    <ul>
                        <?php if (!empty($su_kien_hom_nay->id)): ?>
                            <li><a href="<?php echo base_url('chua/sukien/') . $su_kien_hom_nay->id; ?>"><?php echo $su_kien_hom_nay->ngay_dien_ra ?>.</a></li>
                            <li><a href="<?php echo base_url('chua/sukien/') . $su_kien_hom_nay->id; ?>"><?php echo $su_kien_hom_nay->ten ?>.</a></li>
                        <?php else: ?>
                            <li><a data-href="#">Hôm nay không có sự kiện nổi bật!</a></li>
                            <li><a data-href="#">Hôm nay không có sự kiện nổi bật!</a></li>
                        <?php endif ?>
                        
                        
                    </ul>
                </div>
            </div>

            <!-- Breaking News Widget -->
            <div class="breaking-news-area d-flex align-items-center mt-15">
                <div class="news-title title2">
                    <p>Sắp diễn ra</p>
                </div>
                <div id="internationalTicker" class="ticker">
                    <ul>
                        <?php if (!empty($su_kien_gan_nhat)): ?>
                            <?php foreach ($su_kien_gan_nhat as $row): ?>
                                 
                                <li><a href="<?php echo base_url('chua/sukien/') . $row->id; ?>"><?php echo $row->ten .' '. $row->ngay_dien_ra ?></a></li>

                            <?php endforeach ?>
                        <?php else: ?>
                            <li><a data-href="#">Welcome to website.</a></li>
                            <li><a data-href="#">Welcome to website.</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Hero Add -->
        <div class="col-12 col-lg-4">
            <div class="hero-add">
                <a href="#"><img src="<?php echo public_url('site') ?>/img/bg-img/hero-add.gif" alt=""></a>
            </div>
        </div>
    </div>
</div>
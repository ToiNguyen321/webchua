<!-- ##### Hero Area Start ##### -->
<div class="hero-area">
    <?php $this->load->view('site/hero_area'); ?>
</div>
<!-- ##### Footer Add Area End ##### -->
<!-- ##### Featured Post Area Start ##### -->
<div class="featured-post-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="section-heading">
                    <h6>Top 5 chùa có lượt xem cao nhất</h6>
                </div>
                <div class="row">
                    <?php if (!empty($chua_tieu_bieu)): ?>
                        <!-- Single Featured Post -->
                        <div class="col-12 col-lg-5">
                            <div class="single-blog-post featured-post">
                                <div class="post-thumb">
                                    <a href="<?php echo base_url('chua/view/') . $chua_tieu_bieu->id; ?>"><img src="<?php echo chua_url($chua_tieu_bieu->anh); ?>"  alt="<?php echo $chua_tieu_bieu->ten ?>"></a>
                                </div>
                                <div class="post-data">
                                    <a href="<?php echo base_url('chua/tinh/') . $chua_tieu_bieu->provinceid; ?>" class="post-catagory"><?php echo $chua_tieu_bieu->type .' '. $chua_tieu_bieu->name; ?></a>
                                    <a href="<?php echo base_url('chua/view/') . $chua_tieu_bieu->id; ?>" class="post-title">
                                        <h6><?php echo $chua_tieu_bieu->ten; ?></h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">Chủ trị <a href="#"><?php echo (!empty($chua_tieu_bieu->nguoi_chu_tri)) ? $chua_tieu_bieu->nguoi_chu_tri : 'Chưa xác định' ; ?>.</a></p>
                                        <p class="post-excerp"><?php echo substr($chua_tieu_bieu->tieu_de, 0, 300); ?>...</p>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/view.png" alt=""> <span><?php echo $chua_tieu_bieu->view; ?></span></a>
                                            <a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $chua_tieu_bieu->tong_binh_luan; ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="col-12 col-lg-7">
                        <div class="row">
                            <?php if (!empty($chua_view_cao)): ?>
                                <?php foreach ($chua_view_cao as $row): ?>


                                    <!-- Single Featured Post -->
                                    <div class="col-sm-6 single-blog-post featured-post-2">
                                        <div class="post-thumb">
                                            <a href="<?php echo base_url('chua/view/') . $row->id; ?>"><img src="<?php echo chua_url($row->anh); ?>"  alt="<?php echo $row->ten ?>"></a>
                                        </div>
                                        <div class="post-data">
                                            <a href="<?php echo base_url('chua/tinh/') . $row->provinceid; ?>" class="post-catagory"><?php echo $row->type .' '.$row->name; ?></a>
                                            <div class="post-meta">
                                                 <a href="<?php echo base_url('chua/view/') . $row->id; ?>" class="post-title">
                                                    <h6><?php echo $row->ten; ?></h6>
                                                </a>
                                                <a href="<?php echo base_url('chua/view/') . $row->id; ?>" class="post-title">
                                                    <h6><?php echo substr($row->tieu_de, 0, 120); ?>...</h6>
                                                </a>
                                                <!-- Post Like & Post Comment -->
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/view.png" alt=""> <span><?php echo $row->view; ?></span></a>
                                                    <a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $row->tong_binh_luan; ?></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Featured Post Area End ##### -->

<!-- ##### Popular News Area Start ##### -->
<div class="editors-pick-post-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="section-heading">
                    <h6>Danh sách các chùa (<?php echo $total_rows; ?>)</h6>
                </div>

                <div class="row">
                    <?php if (!empty($chuas)): ?>
                        <?php foreach ($chuas as $row): ?>

                            <!-- Single Post -->
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="single-blog-post style-3">
                                    <div class="post-thumb">
                                        <a href="<?php echo base_url('chua/view/') . $row->id; ?>"><img src="<?php echo chua_url($row->anh); ?>"  alt="<?php echo $row->ten ?>"></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="<?php echo base_url('chua/tinh/') . $row->provinceid; ?>" class="post-catagory"><?php echo  $row->type .' '.$row->name; ?></a>
                                        <a href="<?php echo base_url('chua/view/') . $row->id; ?>" class="post-title">
                                            <h6><?php echo $row->ten; ?></h6>
                                        </a>
                                        <p class="post-excerp"><?php echo substr($row->tieu_de, 0, 200); ?>...</p>
                                        <div class="post-meta d-flex align-items-center">
                                            <a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/view.png" alt=""> <span><?php echo $row->view; ?></span></a>
                                            <a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $row->tong_binh_luan; ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ?>
                    <?php endif ?>

                </div>
                <nav aria-label="Page navigation example" class="Panigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Popular News Area End ##### -->

<!--##### Hero Area Start ##### -->
<div class="hero-area">
    <?php $this->load->view('site/hero_area'); ?>
</div>
<!-- ##### Footer Add Area End ##### -->
<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="section-heading">
                    <h6><?php 
                    if(!empty($title)){
                        echo $title;
                    }else{
                        echo 'Danh sách chùa!';
                    }
                    ?>
                </h6>
            </div>
            <div class="blog-posts-area">
                <div class="row">
                    <!-- Single Featured Post -->
                    <?php if (!empty($chuas)): ?>
                        <?php foreach ($chuas as $row): ?>

                            <div class="col-md-4 single-blog-post featured-post mb-30">
                                <div class="post-thumb">
                                    <a href="<?php echo base_url('chua/view/') . $row->id; ?>"><img src="<?php echo chua_url($row->anh); ?>" alt="<?php echo $row->ten ?>"></a>
                                </div>
                                <div class="post-data">
                                    <a href="<?php echo base_url('chua/tinh/') . $row->provinceid; ?>" class="post-catagory">
                                        <?php if (isset($row->dia_chi)): ?>
                                            <?php echo  $row->dia_chi; ?>
                                        <?php else: ?>
                                            <?php echo  $row->type .' '.$row->name; ?>
                                        <?php endif ?>
                                        
                                            
                                        </a>
                                    <a href="<?php echo base_url('chua/view/') . $row->id; ?>" class="post-title">
                                        <h6><?php echo $row->ten; ?></h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">Chủ trị: <a href="#"><?php echo (!empty($row->nguoi_chu_tri)) ? $row->nguoi_chu_tri : 'Chưa xác định' ; ?>.</a></p>
                                        <p class="post-excerp"><?php echo $row->tieu_de; ?>...</p>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/view.png" alt=""> <span><?php echo $row->view ?></span></a>
                                            <a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $row->tong_binh_luan; ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ?>
                    <?php else: ?>
                            <div class="alert alert-success text-center col-12" style="color: red; font-size: 130%;" role="alert">Không có chùa phù hợp</div>
                    <?php endif ?>

                </div>

                <nav aria-label="Page navigation example" class="Panigation">
                    <?php echo $this->pagination->create_links(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
    <!-- ##### Blog Area End #####



<!-- Top Header Area -->
<div class="top-header-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="top-header-content d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?php echo base_url() ?>"><img style="width: 250px;" src="<?php echo public_url('site'); ?>/img/core-img/logo.png" alt=""></a>
                    </div>

                    <!-- Login Search Area -->
                    <div class="login-search-area d-flex align-items-center">
                        <!-- Login -->
                        <div class="login d-flex">
                            <?php if (empty($nguoi_dung)): ?>
                                <a href="<?php echo base_url('taikhoan/dangnhap') ?>">Đăng nhập</a>
                                <a href="<?php echo base_url('taikhoan/dangky') ?>">Đăng ký</a>
                                <?php else: ?>
                                    <a class="xinchao" href="<?php echo base_url('taikhoan/view'); ?>">Xin chào <?php echo $nguoi_dung['ten_nguoi_dung']; ?></a>
                                    <a href="<?php echo base_url('taikhoan/dangxuat') ?>">Đăng xuất</a>
                                <?php endif ?>

                            </div>
                            <!-- Search Form -->
                            <div class="search-form">
                                <form action="<?php echo base_url('chua/search') ?>" method="post">
                                    <select name="tim_theo_loai" id="search">
                                        <option selected="true" value="1">Theo tên</option>
                                        <option value="2">Theo quận</option>
                                        <option value="3">Theo phường</option>
                                    </select>
                                    <input type="search" name="tim_kiem" id="tim_kiem" class="form-control" placeholder="Search">
                                    <button type="submit" name="btn_tim_kiem"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newspaperNav">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo public_url('site'); ?>/img/core-img/logo.png" alt=""></a>
                    </div>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li class="active"><a href="<?php echo base_url(); ?>"><strong>Trang Chủ</strong></a></li>
                                <li><a href="#">Danh sách tỉnh</a>
                                    <div class="megamenu">
                                        <ul class="single-mega ds_tinh">
                                            <?php if ($tinhs): ?>
                                                <?php foreach ($tinhs as $tinh): ?>
                                                 <li><a href="<?php echo base_url('chua/tinh/') . $tinh->provinceid; ?>"><?php echo $tinh->name ?></a></li>
                                             <?php endforeach ?>
                                         <?php endif ?> 
                                     </ul>
                                 </div>
                             </li>

                             <li><a href="#">Danh mục mở rộng</a>
                                <div class="megamenu">
                                    <?php if ($danhmucs): ?>
                                        <?php foreach ($danhmucs as $row): ?>
                                            <ul class="single-mega cn-col-5">
                                                <li class="title"><b><?php echo $row->ten ?></b></li>
                                                <?php foreach ($row->subs as $sub): ?>
                                                 <li><a href="<?php echo base_url('chua/danhmuc/') . $sub->id; ?>"><?php echo $sub->ten ?></a></li>
                                             <?php endforeach ?>    
                                         </ul>
                                     <?php endforeach ?>   
                                 <?php endif ?>

                                 <?php if (!empty($hai_binh_luan_ngau_nhien)): ?> 
                                    <div class="single-mega cn-col-5">
                                     <?php foreach ($hai_binh_luan_ngau_nhien as $row): ?>



                                        
                                            <!-- Single Featured Post -->
                                            <div class="single-blog-post small-featured-post d-flex">
                                                <div class="post-thumb">
                                                    <a data-href="#"><img src="<?php echo public_url('site'); ?>/img/bg-img/avatar.jpg" alt=""></a>
                                                </div>
                                                <div class="post-data">
                                                    <a href="<?php echo base_url('chua/view/').$row->id_chua ?>" class="post-catagory"><?php echo $row->ten_nguoi_dung; ?></a>
                                                    <div class="post-meta">
                                                        <a href="<?php echo base_url('chua/view/').$row->id_chua ?>" class="post-title">
                                                            <h6> <span> <?php echo substr($row->noi_dung, 0, 100); ?>...</span></h6>
                                                        </a>
                                                        <p class="post-date"><span>Time - <?php echo date('Y-m-d', $row->ngay_binh_luan) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        

                                        <?php endforeach ?>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </li>
                            <li><a href="#">Danh sách sự kiện</a>
                                <ul class="dropdown ds_sukien">
                                    <?php if (!empty($sukiens)): ?>
                                        <?php foreach ($sukiens as $row): ?>
                                         <li><a href="<?php echo base_url('chua/sukien/') .$row->id ?>"><?php echo $row->ten; ?></a></li>
                                     <?php endforeach ?>
                                 <?php endif ?> 
                             </ul>
                         </li>
                         <li><a href="#">Giới thiệu</a></li>
                         <li><a href="<?php echo base_url('phanhoi'); ?>">Phản hồi</a></li>
                     </ul>
                 </div>
                 <!-- Nav End -->
             </div>
         </nav>
     </div>
 </div>
</div>
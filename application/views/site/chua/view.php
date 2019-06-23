<!-- ##### Hero Area Start ##### -->
<div class="hero-area">
    <?php $this->load->view('site/hero_area'); ?>
</div>
<!-- ##### Footer Add Area End ##### -->

<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="blog-posts-area">
					<?php if (!empty($chua)): ?>
					<!-- Single Featured Post -->
					<div class="single-blog-post featured-post single-post">
						<div class="post-thumb">
							<a href="#"><img src="<?php echo chua_url($chua->anh); ?>" alt=""></a>
						</div>
						<div class="post-data">
							<a href="<?php echo base_url('chua/tinh/') . $chua->provinceid; ?>" class="post-catagory"><?php echo $chua->dia_chi; ?></a>
							<a href="#" class="post-title">
								<h6><?php echo $chua->ten; ?></h6>
							</a>
							<div class="post-meta">
								<p class="post-author">Chủ trị: <a data-href="#"><?php echo (!empty($chua->nguoi_chu_tri)) ? $chua->nguoi_chu_tri : 'Chưa xác định.' ; ?></a> - NXD: <a data-href="#"><?php echo $chua->nam_xay_dung; ?></a></p>
								<p style="font-size: 100%;"><?php echo $chua->mo_ta; ?></p>
								<div class="newspaper-post-like d-flex align-items-center justify-content-between">
									<!-- Tags -->
									<div class="newspaper-tags d-flex">
										<span>Sự kiện:</span>
										<ul class="d-flex">
											<?php if (!empty($su_kien)): ?>
												<?php foreach ($su_kien as $row): ?>
													<li><a href="<?php echo base_url('chua/sukien/') .$row->id ?>"><?php echo $row->ten ?></a></li>		
												<?php endforeach ?>
											<?php endif ?>
										</ul>
									</div>

									<!-- Post Like & Post Comment -->
									<div class="d-flex align-items-center post-like--comments">
										<a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/view.png" alt=""> <span><?php echo $chua->view; ?></span></a>
										<a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $chua->tong_binh_luan; ?></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endif ?>

					<?php if (!empty($hai_chua_co_lien_quan)): ?>
						
							
						
					
					<div class="section-heading">
						<h6>Chùa có liên quan</h6>
					</div>

					<div class="row">

						<?php foreach ($hai_chua_co_lien_quan as $row): ?>
						
						<div class="col-12 col-md-6">
							<div class="single-blog-post style-3 mb-80">
								<div class="post-thumb">
									 <a href="<?php echo base_url('chua/view/') . $row->id; ?>"><img src="<?php echo chua_url($row->anh); ?>"  alt="<?php echo $row->ten ?>"></a>
								</div>
								<div class="post-data">
									<a href="<?php echo base_url('chua/tinh/') . $row->provinceid; ?>" class="post-catagory"><?php echo  $row->type .' '.$row->name; ?></a>
                                    <a href="<?php echo base_url('chua/view/') . $row->id; ?>" class="post-title">
                                            <h6><?php echo $row->ten; ?>...</h6>
                                    </a>
                                    <p class="post-excerp"><?php echo substr($row->tieu_de, 0, 200); ?>...</p>
									<div class="post-meta d-flex align-items-center">
										<a href="#" class="post-like"><img src="<?php echo public_url('site'); ?>/img/core-img/like.png" alt=""> <span><?php echo $row->view; ?></span></a>
										<a href="#" class="post-comment"><img src="<?php echo public_url('site'); ?>/img/core-img/chat.png" alt=""> <span><?php echo $row->tong_binh_luan; ?></span></a>
									</div>
								</div>
							</div>
						</div>

						<?php endforeach ?>

					</div>

					<?php endif ?>
					<!-- END CHÙA CÓ LIÊN QUAN -->


						
					
						<div class="post-a-comment-area section-padding-80-0 mb-30" id="form-binh-luan">
							
							<?php if (!empty($nguoi_dung)): ?>
							<h4>Gửi bình luận</h4>
							<!-- Reply Form -->
							<div class="contact-form-area">
								<form action="<?php echo base_url('chua/binhluan/') . $chua->id; ?>" method="post">
									<div class="row">
										<div class="col-sm-8 col-md-9">
											<textarea style="border-radius: 30px; height: 100px;resize: none;" class="form-control" name="binh_luan" id="binh_luan" cols="3" rows="3" placeholder="Bình luận"></textarea>
											<small id="Error" class="form-text text-muted" style="color: red"><?php echo $message; ?></small>
										</div>
										<div class="col-sm-4 col-md-3 text-right">
											<button style="border-radius: 50px;" class="btn newspaper-btn mt-sm-4 mt-xs-0  w-50" name="btn_binh_luan" type="submit">Bình luận</button>
										</div>
										<div class="col-sm-8 col-md-9">
											<?php if (!empty($message)): ?>
												<div class="alert alert-success text-center" role="alert"><?php echo $message; ?></div>
											<?php endif ?>
										</div>
										
									</div>
								</form>
							</div>
							<?php else: ?>
							<a href="<?php echo base_url('taikhoan/dangnhap') ?>" class="dang-nhap-binh-luan"><h4>Đăng nhập để bình luận</h4></a>
							<?php endif ?>
						</div>

					
					<!-- Comment Area Start -->
					<div class="comment_area clearfix">
						<h5 class="title">Bình luận</h5>

						<ol>
							<?php if (!empty($binh_luan)): ?>
								<?php foreach ($binh_luan as $row): ?>
									
								
							<!-- Single Comment Area -->
							<li class="single_comment_area">
								<!-- Comment Content -->
								<div class="comment-content d-flex">
									<!-- Comment Author -->
									<div class="comment-author">
										<img src="<?php echo public_url('site'); ?>/img/bg-img/avatar.jpg" alt="author">
									</div>
									<!-- Comment Meta -->
									<div class="comment-meta">
										<a data-href="#" class="post-author"><?php echo $row->ten_nguoi_dung; ?></a>
										<a data-href="#" class="post-date">Time <?php echo date('Y-m-d h:i:s',$row->ngay_binh_luan); ?></a>
										<p><?php echo $row->noi_dung; ?></p>
									</div>
								</div>
							</li>

								<?php endforeach ?>
							<?php endif ?>

						</ol>
					</div>

					
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div id="banner">
					<!-- Latest Comments Widget -->
                        <div class="latest-comments-widget col-12 banner" >
                        	<?php if (!empty($binh_luan)): ?>
                            <h3>Bình luận mới nhất</h3>
							

<?php 
	$count_binh_luan = count($binh_luan);
	$tong_binh_luan = (count($binh_luan) == 5) ? (count($binh_luan) - 1) : count($binh_luan); 
?>

								<?php for($i = 0; $i<$tong_binh_luan ; $i++){ ?>
									<?php $row = $binh_luan[$i]; ?>
                            	<!-- Single Comments -->
	                            <div class="single-comments d-flex">
	                                <div class="comments-thumbnail mr-15">
	                                    <img src="<?php echo public_url('site'); ?>/img/bg-img/avatar.jpg" alt="">
	                                </div>
	                                <div class="comments-text">
	                                    <a href="#form-binh-luan"><?php echo $row->ten_nguoi_dung; ?> <span>-</span> <?php echo substr($row->noi_dung, 0, 60); ?>...</a>
	                                    <p><?php echo date('Y-m-d',$row->ngay_binh_luan); ?></p>
	                                </div>
	                            </div>
								<?php } ?>
							<?php else: ?>
								<h3>Chưa có bình luận nào. Bạn hãy là người bình luận đầu tiên!</h3>
							<?php endif ?>
                            
                        </div>
				</div>
			</div>
		</div>
	</div>
</div>


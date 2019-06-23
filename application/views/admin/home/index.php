<!-- Title area -->
<?php $this->load->view('admin/home/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<div class="widgets">
		<!-- Stats -->


		<!-- User -->
		<!-- <div class="oneTwo"> -->
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin') ?>/images/icons/dark/users.png" class="titleIcon" />
					<h6>Thống kê dữ liệu</h6>
				</div>

				<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
					<tbody>

						<tr>
							<td>
								<div class="left">Tổng số bài viết</div>
								<div class="right f11"><a href="<?php echo admin_url('chua') ?>">Chi tiết</a></div>
							</td>
							<td class="textC webStatsLink"><?php echo $tong_chua ?></td>
							<td>
								<div class="left">Tổng số phản hồi</div>
								<div class="right f11"><a href="<?php echo admin_url('phanhoi') ?>">Chi tiết</a></div>
							</td>
							<td class="textC webStatsLink"><?php echo $tong_phan_hoi ?></td>
						</tr>

						<tr>
							
							<td>
								<div class="left">Tổng số thành viên</div>
								<div class="right f11"><a href="<?php echo admin_url('taikhoan') ?>">Chi tiết</a></div>
							</td>

							<td class="textC webStatsLink"><?php echo $tong_thanh_vien ?></td>
							<td>
								<div class="left">Tổng lượt truy cập web site</div>
							</td>

							<td class="textC webStatsLink"><?php echo $tong_view ?></td>
						</tr>

						<!-- <tr>
							<td>
								<div class="left">Tổng số bình luận</div>
								<div class="right f11"><a href="<?php echo admin_url() ?>">Chi tiết</a></div>
							</td>

							<td class="textC webStatsLink">4</td>
						</tr>

						<tr>
							
						</tr>
						<tr>
							
						</tr> -->
					</tbody>
				</table>
			</div>
		<!-- </div> -->

		<div class="clear"></div>
		<!-- END________- -->

		<div class="widget" id='main_content'>

			<div class="title">
				<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
				<h6>Danh sách bình luận của người dùng</h6>
				<div class="num f12">Tổng số: <b><?php echo  (!empty($binh_luan)) ? count($binh_luan) : 0; ?></b></div>
			</div>

			<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
				<thead>
					<tr>
						<td>Người bình luận</td>
						<td>Tên chùa</td>
						<td>Nội dung</td>
						<td>Ngày bình luận</td>
						<td>Trạng thái</td>
						<td style="width:150px;">Hành động</td>
					</tr>
				</thead>
				<tfoot class="auto_check_pages">
					<tr>
						<td colspan="6">
							<div class='pagination'>
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</td>
					</tr>
				</tfoot>
				<tbody>
					<?php if (!empty($binh_luan)): ?>	
						<?php foreach ($binh_luan as $row): ?>


							<tr class='row_18'>

								<td><?php echo $row->ten_nguoi_dung; ?></td>  
								<td><?php echo $row->ten_chua; ?></td>
								<td>
									<?php echo $row->noi_dung; ?>
								</td>
								<td><?php echo date('Y-m-d',$row->ngay_binh_luan); ?></td>  
								<td><?php echo $row->ten_trang_thai; ?></td>  

								<td class="option">
									<?php if ($row->trang_thai != 8): ?>
										<a href="<?php echo admin_url('home/duyet'); ?>/<?php echo $row->id ?>/<?php echo $row->trang_thai ?>" title="Duyệt bình luận" class="tipS ">
											<img src="<?php echo public_url('admin'); ?>/images/icons/color/accept.png" />
										</a>

										<?php else: ?>
											<a href="<?php echo admin_url('home/spam'); ?>/<?php echo $row->id ?>" title="Đánh dấu spam" class="tipS" >
												<img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
											</a>
										<?php endif ?>


									</td>
								</tr>					


							<?php endforeach ?>
						<?php endif ?>


					</tbody>
				</table>
			</div>
		</div>
	</div>
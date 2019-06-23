<!-- Title area -->
<?php $this->load->view('admin/taikhoan/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<div class="widget" id='main_content'>

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách người dùng</h6>
			<div class="num f12">Tổng số: <b><?php echo  (!empty($nguoi_dung)) ? count($nguoi_dung) : 0; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td>ID</td>
					<td>Tên người dùng</td>
					<td>Email đăng nhập</td>
					<td>Ngày đăng ký</td>
					<td>Trạng thái</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="7">
						<div class='pagination'>
							<?php echo $this->pagination->create_links(); ?></div>
						</td>
					</tr>
				</tfoot>

				<tbody>
					<?php if (!empty($nguoi_dung)): ?>	
						<?php foreach ($nguoi_dung as $row): ?>


							<tr class='row_18'>
								<td></td>
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->ten_nguoi_dung; ?></td>  
								<td><?php echo $row->email; ?></td> 
								<td><?php echo date('Y-m-d',$row->ngay_tao); ?></td>  
								<td><?php echo $row->ten_trang_thai; ?></td>  

								<td class="option">
									<?php if($row->trang_thai == 5): ?>
									<a href="<?php echo base_url('admin'); ?>/taikhoan/duyet/<?php echo $row->id ?>" title="Duyệt" class="tipS ">
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/accept.png" />
									</a>
									<?php endif ?>

									<a href="<?php echo base_url('admin'); ?>/taikhoan/khoiphucmatkhau/<?php echo $row->id ?>" title="Khôi phục mật khẩu thành 123456" class="tipS ">
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
									</a>

									<?php if($row->trang_thai != 7): ?>
									<a href="<?php echo base_url('admin'); ?>/taikhoan/camhoatdong/<?php echo $row->id ?>" title="Cấm hoạt động" class="tipS" >
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/uninstall.png" />
									</a>
									<?php else: ?>
									<a href="<?php echo base_url('admin'); ?>/taikhoan/hoatdong/<?php echo $row->id ?>" title="Cho phép hoạt động" class="tipS" >
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/accept.png" />
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
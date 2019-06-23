<!-- Title area -->
<?php $this->load->view('admin/phanhoi/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<div class="widget" id='main_content'>

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách phản hồi của người dùng</h6>
			<div class="num f12">Tổng số: <b><?php echo  (!empty($phanhoi)) ? count($phanhoi) : 0; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td>Tên người gửi</td>
					<td>Email</td>
					<td>Tiêu đề</td>
					<td>Ngày gửi</td>
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
					<?php if (!empty($phanhoi)): ?>	
						<?php foreach ($phanhoi as $row): ?>


							<tr class='row_18' style="background-color:<?php echo $row->ma_mau; ?>"  
							>
								
								<td><?php echo $row->ten; ?></td>  
								<td><?php echo $row->email; ?></td>
								<td>
									<?php echo (strlen($row->tieu_de) > 100) ? substr($row->tieu_de, 0 , 99) . "<b> ...<b>" : $row->tieu_de; ?>
									
								</td>
								<td><?php echo date('Y-m-d',$row->ngay_gui); ?></td>  
								<td><?php echo $row->ten_trang_thai; ?></td>  

								<td class="option">
									<a href="<?php echo admin_url('phanhoi/xem'); ?>/<?php echo $row->id ?>/<?php echo $row->trang_thai ?>" title="Xem" class="tipS ">
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" />
									</a>

									<a href="<?php echo admin_url('phanhoi/traloi'); ?>/<?php echo $row->id ?>" title="Trả lời" class="tipS" >
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/pencil.png" />
									</a>
									<a href="<?php echo admin_url('phanhoi/spam'); ?>/<?php echo $row->id ?>" title="Đánh dấu spam" class="tipS" >
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png" />
									</a>
								</td>
							</tr>					

							
						<?php endforeach ?>
					<?php endif ?>
					

				</tbody>
			</table>
		</div>
	</div>
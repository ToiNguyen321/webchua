<!-- Title area -->
<?php $this->load->view('admin/binhluan/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<div class="widget" id='main_content'>

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách phản hồi của người dùng</h6>
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
							<!-- <?php echo $this->pagination->create_links(); ?> -->
						</div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php if (!empty($binh_luan)): ?>	
					<?php foreach ($binh_luan as $row): ?>


						<tr class='row_18' style="background-color:<?php echo $row->ma_mau; ?>"  
							>

							<td><?php echo $row->ten_nguoi_dung; ?></td>  
							<td><?php echo $row->ten_chua; ?></td>
							<td>
								<?php echo $row->noi_dung; ?>
							</td>
							<td><?php echo date('Y-m-d',$row->ngay_binh_luan); ?></td>  
							<td><?php echo $row->ten_trang_thai; ?></td>  

							<td class="option">
								<a href="<?php echo admin_url('binh_luan/xem'); ?>/<?php echo $row->id ?>/<?php echo $row->trang_thai ?>" title="Xem" class="tipS ">
									<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png" />
								</a>

								<a href="<?php echo admin_url('binh_luan/traloi'); ?>/<?php echo $row->id ?>" title="Trả lời" class="tipS" >
									<img src="<?php echo public_url('admin'); ?>/images/icons/color/pencil.png" />
								</a>
								<a href="<?php echo admin_url('binh_luan/spam'); ?>/<?php echo $row->id ?>" title="Đánh dấu spam" class="tipS" >
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
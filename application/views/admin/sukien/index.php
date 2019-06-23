<!-- Title area -->
<?php $this->load->view('admin/sukien/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<div class="widget" id='main_content'>

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
			<h6>Danh sách sự kiện</h6>
			<div class="num f12">Tổng số: <b><?php echo  (!empty($sum_sukien)) ? ($sum_sukien) : 0; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable taskWidget" id="checkAll">
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png" /></td>
					<td>Tên sự kiện</td>
					<td>Mô tả</td>
					<td>Ngày diễn ra</td>
					<td style="width:150px;">Hành động</td>
				</tr>
			</thead>
			
			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="5">

						<div class="pagination">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</tr>
				</tfoot>

				<tbody>
					<?php if (!empty($sukien)): ?>	
						<?php foreach ($sukien as $row): ?>


							<tr class='row_18'>
								<td><input type="checkbox" name="id[]" value="18" /></td>

								<td><?php echo $row->ten ?></td>  
								<td><?php  echo $row->mo_ta
								// $mo_ta = (strlen($row->mo_ta) > 100) ? (substr($row->mo_ta, 0, 100)) : ($row->mo_ta); 
								// echo $mo_ta;
								?></td>

								<td><?php echo $row->ngay_dien_ra; ?>.</td>  

								<td class="option">
									<a href="<?php echo base_url('admin'); ?>/sukien/edit/<?php echo $row->id ?>" title="Chỉnh sửa" class="tipS ">
										<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png" />
									</a>

									<a href="<?php echo base_url('admin'); ?>/sukien/del/<?php echo $row->id ?>" title="Xóa" class="tipS verify_action" >
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
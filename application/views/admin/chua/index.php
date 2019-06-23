<?php $this->load->view('admin/chua/head'); ?>

<div class="wrapper" id="main_product">

	<?php $this->load->view('admin/mess', $this->data); ?>

	<div class="widget">

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách chùa</h6>
			<div class="num f12">Số lượng: <b><?php if ($sum_chua): ?>
				<?php echo $sum_chua; ?>
			<?php endif ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			<!--
			<thead class="filter">
				<tr>
					<td colspan="8">
						<form class="list_filter form" action="index.php/admin/product.html" method="get">
							<table cellpadding="0" cellspacing="0" width="80%">
								<tbody>

									<tr>
										<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
										<td class="item"><input name="id" value="" id="filter_id" type="text" style="width:55px;"></td>

										<td class="label" style="width:40px;"><label for="filter_id">Tên</label></td>
										<td class="item" style="width:155px;"><input name="name" value="" id="filter_iname" type="text" style="width:155px;"></td>

										<td class="label" style="width:60px;"><label for="filter_status">Thể loại</label></td>
										<td class="item">
											<select name="catalog">
												<option value=""></option>
												//kiem tra danh muc co danh muc con hay khong
												<optgroup label="Tivi">
													<option value="18">
													Toshiba											            </option>
													<option value="17">
													Samsung											            </option>
													<option value="16">
													Panasonic											            </option>
													<option value="15">
													LG											            </option>
													<option value="14">
													JVC											            </option>
													<option value="13">
													AKAI											            </option>
												</optgroup>


											</select>
										</td>

										<td style="width:150px">
											<input type="submit" class="button blueB" value="Lọc">
											<input type="reset" class="basic" value="Reset" onclick="window.location.href = 'index.php/admin/product.html'; ">
										</td>

									</tr>
								</tbody>
							</table>
						</form>
					</td>
				</tr>
			</thead>
			-->
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin'); ?>/images/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã số</td>
					<td>Tên</td>
					<td>Tiêu đề</td>
					<td>Người chủ trì</td>
					<td style="width:75px;">Năm xây dựng</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>

<tfoot class="auto_check_pages">
	<tr>
		<td colspan="8">
			<!-- <div class="list_action itemActions">
				<a href="#submit" id="submit" class="button blueB" url="admin/product/del_all.html">
					<span style="color:white;">Xóa hết</span>
				</a>
			</div> -->

			<div class="pagination">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</td>
	</tr>
</tfoot>

<tbody class="list_item">
	<?php if (!empty($chua)): ?>
		<?php foreach ($chua as $row): ?>
			
		
	<tr class="row_9">
		<td><input type="checkbox" name="id[]" value="9"></td>

		<td class="textC"><?php echo $row->id; ?></td>

		<td>
			<div class="image_thumb">
				<img src="<?php echo base_url(); ?>/upload/chua/<?php echo $row->anh; ?>" height="50">
				<div class="clear"></div>
			</div>

			<a href="<?php echo admin_url('chua'); ?>/view/<?php echo $row->id ?>" class="tipS" title="" target="_blank">
				<b><?php echo $row->ten; ?></b>
			</a>

			<div class="f11">Xem: <?php echo $row->view; ?></div>

		</td>

		<td class="textC"><?php echo $row->tieu_de; ?></td>

		<td class="textC"><?php echo $row->nguoi_chu_tri; ?></td>


		<td class="textC"><?php echo $row->nam_xay_dung; ?></td>

		<td class="textC"><?php echo date('Y-m-d',$row->ngay_tao); ?></td>

		<td class="option textC">
			<a href="<?php echo admin_url(); ?>/chua/view/<?php echo $row->id ?>" target="_blank" class="tipS" title="Xem chi tiết sản phẩm">
				<img src="<?php echo public_url('admin'); ?>/images/icons/color/view.png">
			</a>
			<a href="<?php echo admin_url(); ?>/chua/edit/<?php echo $row->id ?>" title="Chỉnh sửa" class="tipS">
				<img src="<?php echo public_url('admin'); ?>/images/icons/color/edit.png">
			</a>

			<a href="<?php echo admin_url(); ?>/chua/del/<?php echo $row->id ?>" title="Xóa" class="tipS verify_action">
				<img src="<?php echo public_url('admin'); ?>/images/icons/color/delete.png">
			</a>
		</td>
	</tr>

		<?php endforeach ?>
	<?php endif ?>
</tbody>

</table>
</div>

</div>
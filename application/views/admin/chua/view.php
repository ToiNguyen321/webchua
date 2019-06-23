
<style type="text/css">
span.oneTwo{
	font-size: 100%;
	width: 100%;
}
</style>

<!-- Title area -->
<?php $this->load->view('admin/chua/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<fieldset>
		<div class="widget">
			<div class="title">
				<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon">
				<h6>Thông tin chùa</h6>
			</div>

			<div class="tab_container">
				<div id="tab1" class="tab_content pd0">
					<div class="formRow">
						<label class="formLeft" for="param_name">Tên: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->ten; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Tiêu đề: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->tieu_de; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Ảnh tiêu biểu: </label>
						<div class="formRight">
							<span class="oneTwo"><img src="<?php echo base_url('upload/chua/'.$chua->anh); ?>" style="width: 100px; height: 70px; margin-left: 20px;"></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Ảnh kèm theo: </label>
						<div class="formRight">
							<span class="oneTwo"><?php $anh_kem_theo = json_decode($chua->list_anh); ?>
								<?php if (!empty($anh_kem_theo)): ?>
									<?php foreach ($anh_kem_theo as $anh): ?>
										<img src="<?php echo base_url('upload/chua/'.$anh); ?>" style="width: 100px; height: 70px; margin-left: 20px; display: inline-block;">
									<?php endforeach ?>
									
								<?php endif ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Người chủ trị: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->nguoi_chu_tri; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Danh mục: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->danh_muc; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Địa chỉ: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->dia_chi; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Lượt xem: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->view;; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					

					<div class="formRow">
						<label class="formLeft" for="param_name">Sự kiện: </label>
						<div class="formRight">
							<span class="oneTwo">
							<?php if ($su_kien): ?>
							<?php foreach ($su_kien as $row): ?>
								<?php echo $row->ten . " <b style='color:red;'>|</b> "; ?>
							<?php endforeach ?>
							<?php endif ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Năm xây dựng: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->nam_xay_dung; ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow hide"></div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Ngày tạo: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo date('Y-m-d', $chua->ngay_tao); ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow hide"></div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Mô tả: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $chua->mo_ta; ?></span>
							<!-- <span class="oneTwo"><textarea disabled="true" style="width: 100%; min-height: 300px"><?php echo $chua->mo_ta; ?></textarea></span> -->
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div><!-- End tab_container-->
			<div class="clear"></div>
		</div>
	</fieldset>
</div>
</form>
</div>
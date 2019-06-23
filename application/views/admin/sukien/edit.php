<?php $this->load->view('admin/sukien/head'); ?>

<div class="wrapper">

	<!-- Form -->
	<form class="form" id="form" action="<?php echo base_url('admin'); ?>/sukien/edit/<?php echo $sukien->id; ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon">
					<h6>Cập nhật sự kiện</h6>
				</div>

				<ul class="tabs">
					<li><a href="#tab1">Thông tin chung</a></li>

				</ul>

				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="ten" id="param_ten" _autocheck="true" type="text" value="<?php echo $sukien->ten; ?>"></span>
								<span name="ten_autocheck" class="autocheck"></span>
								<div name="ten_error" class="clear error"><?php echo form_error('ten') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft" for="param_name">Ngày diễn ra:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="ngay_dien_ra" id="param_ngay_dien_ra" _autocheck="true" type="date" value="<?php echo $sukien->ngay_dien_ra; ?>"></span>
								<span name="ngay_dien_ra_autocheck" class="autocheck"></span>
								<div name="ngay_dien_ra_error" class="clear error"><?php echo form_error('ngay_dien_ra') ?></div>
							</div>
							<div class="clear"></div>
						</div>
				        <div class="formRow">
							<label class="formLeft">Nội dung:</label>
							<div class="formRight">
								<textarea name="mo_ta" id="param_mo_ta" class="editor"><?php echo $sukien->mo_ta; ?></textarea>
								<div name="mo_ta_error" class="clear error"><?php echo form_error('mo_ta') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow hide"></div>
					</div>
				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Cập nhật" class="redB">
					<input type="reset" value="Hủy bỏ" class="basic">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
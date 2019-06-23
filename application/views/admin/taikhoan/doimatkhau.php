<?php $this->load->view('admin/taikhoan/headadmin') ?>
<div class="line"></div>
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Form -->
	<form class="form" id="form" action="<?php echo admin_url('taikhoan/doimatkhau') ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
					<h6>Cập nhật mật khẩu</h6>
				</div>

				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_ten">Mật khẩu cũ:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="mat_khau_cu" value="" id="param_mat_khau_cu" _autocheck="true" type="password"></span>
								<span name="mat_khau_cu_autocheck" class="autocheck"></span>
								<div name="mat_khau_cu_error" class="clear error"><?php echo form_error('mat_khau_cu') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_ten">Mật khẩu mới:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="mat_khau_moi" value="" id="param_mat_khau_moi" _autocheck="true" type="password"></span>
								<span name="mat_khau_moi_autocheck" class="autocheck"></span>
								<div name="mat_khau_moi_error" class="clear error"><?php echo form_error('mat_khau_moi') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_ten">Nhập lại mật khẩu:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="mat_khau_moi_2" value="" id="param_mat_khau_moi_2" _autocheck="true" type="password"></span>
								<span name="mat_khau_moi_2_autocheck" class="autocheck"></span>
								<div name="mat_khau_moi_2_error" class="clear error"><?php echo form_error('mat_khau_moi_2') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow hide"></div>
					</div>

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Cập nhật" class="redB">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
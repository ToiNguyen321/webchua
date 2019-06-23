<?php $this->load->view('admin/phanhoi/head') ?>
<div class="line"></div>
<div class="wrapper">
	<!-- Form -->
	<form class="form" id="form" action="<?php echo admin_url('phanhoi/traloi/'). $phanhoi->id ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
					<h6>Trả lời phản hồi</h6>
				</div>

				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_email_nhan">Email người nhận:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="email_nhan" style="background-color: #f5f5f5;" disabled="true" value="<?php echo $phanhoi->email; ?>" id="param_email_nhan" _autocheck="true" type="text"></span>
								<span name="email_nhan_autocheck" class="autocheck"></span>
								<div name="email_nhan_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_tieu_de_gui">Tiêu đề:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="tieu_de_gui" value="<?php echo set_value('tieu_de_gui'); ?>" id="param_tieu_de_gui" _autocheck="true" type="text"></span>
								<span name="tieu_de_gui_autocheck" class="autocheck"></span>
								<div name="tieu_de_gui_error" class="clear error"><?php echo form_error('tieu_de_gui') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<label class="formLeft">Nội dung:</label>
							<div class="formRight">
								<textarea name="noi_dung" id="param_noi_dung" class="editor">Xin chào <?php echo $phanhoi->ten; ?>!<br>&emsp;-&ensp;<?php echo set_value('noi_dung'); ?>
								</textarea>
								<div name="noi_dung_error" class="clear error"><?php echo form_error('noi_dung') ?></div>
							</div>
							<div class="clear"></div>
						</div>

						<!-- <div class="formRow">
							<label class="formLeft" for="param_sale">Nội dung:<span class="req"></span>*</label>
							<div class="formRight">
								<span class="oneTwo"><textarea name="noi_dung" id="param_noi_dung" rows="4" cols="">Xin chào <?php echo $phanhoi->ten; ?>!<br>&emsp;-&ensp;<?php echo set_value('noi_dung'); ?></textarea></span>
								<span name="noi_dung_autocheck" class="autocheck"></span>
								<div name="noi_dung_error" class="clear error"><?php echo form_error('noi_dung') ?></div>
							</div>
							<div class="clear"></div>
						</div> -->
						
						<div class="formRow hide"></div>
					</div>

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Trả lời phản hồi" class="redB">
					<input type="reset" value="Hủy bỏ" class="basic">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
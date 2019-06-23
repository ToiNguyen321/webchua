<?php $this->load->view('admin/danhmuc/head') ?>
<div class="line"></div>
<div class="wrapper">

	<!-- Form -->
	<form class="form" id="form" action="<?php echo admin_url('danhmuc/add') ?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
					<h6>Thêm mới danh mục sản phẩm</h6>
				</div>

				<div class="tab_container">
					<div id="tab1" class="tab_content pd0">
						<div class="formRow">
							<label class="formLeft" for="param_ten">Tên:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input name="ten" value="<?php echo set_value('ten'); ?>" id="param_ten" _autocheck="true" type="text"></span>
								<span name="ten_autocheck" class="autocheck"></span>
								<div name="ten_error" class="clear error"><?php echo form_error('ten') ?></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label class="formLeft" for="param_parent_id">Lựa chọn danh mục cha:<span class="req">*</span></label>
							<div class="formRight">
								<select name="parent_id" _autocheck="true" id="param_parent_id" class="left">
									<option value="0">Là danh mục cha</option>
									<?php if(!empty($parent_id)){
										foreach ($parent_id as $value) {
											?>
									<option value="<?php echo $value->id ?>"><?php echo $value->ten ?></option>		
											<?php
										}
									} ?>
									
								</select>
								<span name="parent_id_autocheck" class="autocheck"></span>
								<div name="parent_id_error" class="clear error"></div>
							</div>
							<div class="clear"></div>
						</div>
					     
						<div class="formRow">
							<label class="formLeft" for="param_sort_order">Thứ tự hiển thị:<span class="req">*</span></label>
							<div class="formRight">
								<span class="oneTwo"><input class="format_number" name="sort_order" value="<?php echo set_value('sort_order'); ?>" id="param_sort_order" _autocheck="true" min="0" type="text"></span>
								<span name="sort_order_autocheck" class="autocheck"></span>
								<div name="sort_order_error" class="clear error"><?php echo form_error('sort_order') ?></div>
							</div>
							<div class="clear"></div>
						</div>    
						<div class="formRow hide"></div>
					</div>

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input type="submit" value="Thêm mới" class="redB">
					<input type="reset" value="Hủy bỏ" class="basic">
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</form>
</div>
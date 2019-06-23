
<style type="text/css">
span.oneTwo{
	font-size: 140%;
}
</style>

<!-- Title area -->
<?php $this->load->view('admin/phanhoi/head'); ?>

<!-- Message -->



<!-- Main content wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/mess', $this->data); ?>
	<!-- Static table -->
	<fieldset>
		<div class="widget">
			<div class="title">
				<img src="<?php echo public_url('admin'); ?>/images/icons/dark/add.png" class="titleIcon">
				<h6>Phản hồi của người dùng</h6>
			</div>

			<div class="tab_container">
				<div id="tab1" class="tab_content pd0">
					<div class="formRow">
						<label class="formLeft" for="param_name">Người gửi: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $phanhoi->ten; ?></span>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_name">Email: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $phanhoi->email; ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label class="formLeft" for="param_name">Tiêu đề: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $phanhoi->tieu_de; ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label class="formLeft" for="param_name">Nội dung: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $phanhoi->noi_dung; ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label class="formLeft" for="param_name">Trạng thái: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo $phanhoi->ten_trang_thai; ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<label class="formLeft" for="param_name">Ngày gửi: </label>
						<div class="formRight">
							<span class="oneTwo"><?php echo date('Y-m-d',$phanhoi->ngay_gui); ?></span>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow hide"></div>
				</div>
			</div><!-- End tab_container-->
			<div class="formSubmit">
				<a href="<?php echo admin_url('phanhoi/spam/').$phanhoi->id ?>"><button class="redB">Đánh dấu spam</button></a>
				<a href="<?php echo admin_url('phanhoi/traloi/').$phanhoi->id ?>"><button class="redB">Trả lời phản hồi</button></a>
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
</div>
</form>
</div>
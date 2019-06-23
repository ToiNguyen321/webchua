<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php $this->load->view('admin/head'); ?>
</head>
<body>
	<!-- Left side content -->
	<div id="left_content">
		<?php $this->load->view('admin/left'); ?>
	</div>

	<!-- Right side -->
	<div id="rightSide">
		<!-- Account panel top -->
		
		<div class="topNav">
			<?php $this->load->view('admin/nav'); ?>
		</div>

		<!-- Main content -->
		<?php $this->load->view($temp); ?>
		<!-- END Main content -->
		
		<div class="clear mt30"></div>

		<div id="footer">
			<?php $this->load->view('admin/footer'); ?>
		</div>
	</div>
	<div class="clear"></div>
</body>
</html>
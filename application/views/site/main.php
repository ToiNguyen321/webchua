<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('site/head'); ?>
</head>
<body>
	<header class="header-area">
		<?php $this->load->view('site/header', $this->data); ?>
	</header>
	<!-- ##### Header Area End ##### -->

    
	
	<!-- BEGIN CONTENT ---->
    	<?php $this->load->view($temp); ?>
	<!-- END CONTENT ---->


    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
    	<?php $this->load->view('site/footer'); ?>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
	<?php $this->load->view('site/js'); ?>
</body>
</html>
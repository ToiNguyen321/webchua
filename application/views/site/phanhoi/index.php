<!-- ##### Hero Area Start ##### -->
<div class="hero-area">
    <?php $this->load->view('site/hero_area'); ?>
</div>
<!-- ##### Footer Add Area End ##### -->
<!-- ##### Contact Form Area Start ##### -->
<div class="contact-area section-padding-0-80">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="contact-title">
					<h2>Gửi phản hồi</h2>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="contact-form-area">
					<form action="<?php echo base_url('phanhoi'); ?>" method="post">
						<div class="row">
							<div class="col-12 col-lg-6">

								<input type="text" class="form-control" name="ten" id="ten" value="<?php echo (!empty($nguoi_dung)) ? $nguoi_dung['ten_nguoi_dung'] : set_value('ten'); ?>" placeholder="Tên của bạn">
								<small id="Error" class="form-text text-muted"><?php echo form_error('ten') ?></small>
							</div>
							<div class="col-12 col-lg-6">
								<input type="email" class="form-control" name="email" id="email" value="<?php echo (!empty($nguoi_dung)) ? $nguoi_dung['email_dang_nhap'] : set_value('email'); ?>" placeholder="E-mail">
								<small id="Error" class="form-text text-muted"><?php echo form_error('email') ?></small>
							</div>
							<div class="col-12">
								<input type="text" class="form-control" name="tieu_de" value="<?php echo set_value('noi_dung'); ?>" id="tieu_de" placeholder="Tiêu đề phản hồi">
								<small id="Error" class="form-text text-muted"><?php echo form_error('tieu_de') ?></small>
							</div>
							<div class="col-12">
								<textarea class="form-control" name="noi_dung" id="noi_dung" cols="30" rows="10" placeholder="Nội dung phản hồi"><?php echo set_value('noi_dung'); ?></textarea>
								<small id="Error" class="form-text text-muted"><?php echo form_error('noi_dung') ?></small>
							</div>
							<div class="col-12">
							<?php if (!empty($message)): ?>
								<div class="alert alert-success text-center" role="alert"><?php echo $message; ?></div>
							<?php endif ?>
							</div>
							<div class="col-12 text-center">
								<button class="btn newspaper-btn mt-30 w-100" type="submit">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<!-- Single Contact Information -->
				<div class="single-contact-information mb-30">
					<h6>Address:</h6>
					<p>Hà Nội</p>
				</div>
				<!-- Single Contact Information -->
				<div class="single-contact-information mb-30">
					<h6>Phone:</h6>
					<p>+84 984 673 423</p>
				</div>
				<!-- Single Contact Information -->
				<div class="single-contact-information mb-30">
					<h6>Email:</h6>
					<p>hotro.webchua@gmail.com</p>
				</div>
			</div>
		</div>

		<!-- Google Maps -->
		<!-- <div class="map-area">
			<div id="googleMap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.305964585979!2d105.87397011481987!3d20.980368994804685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ae9fdfd1380b%3A0xdd056838cda81649!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBLaW5oIFThur8gLSBL4bu5IFRodeG6rXQgQ8O0bmcgTmdoaeG7h3A!5e0!3m2!1svi!2s!4v1553095653954" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
		</div> -->

	</div>
</div>
    <!-- ##### Contact Form Area End ##### -->
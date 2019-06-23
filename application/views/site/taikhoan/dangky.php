<div class="form-dang-nhap">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-xl-6 offset-xl-3">
					<div class="alert alert-danger text-center title-login" role="alert">Đăng Ký Tài Khoản Website</div>
					<form  action="<?php echo base_url('taikhoan/dangky') ?>" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên người dùng</label>
							<input type="text" class="form-control" value="<?php echo set_value('ten_nguoi_dung'); ?>" name="ten_nguoi_dung" id="ten_nguoi_dung" aria-describedby="Error" placeholder="Tên người dùng">
							<small id="Error" class="form-text text-muted"><?php echo form_error('ten_nguoi_dung') ?></small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email đăng nhập <span style="color: red;">*</span></label>
							<input type="email" class="form-control" value="<?php echo set_value('email'); ?>" name="email" id="email" aria-describedby="Error" placeholder="Email đăng nhập">
							<small id="Error" class="form-text text-muted"><?php echo form_error('email') ?></small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Mật khẩu</label>
							<input type="password" class="form-control" name="mat_khau" id="mat_khau" placeholder="Mật khẩu">
							<small id="Error" class="form-text text-muted"><?php echo form_error('mat_khau') ?></small>
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Nhập lại mật khẩu</label>
							<input type="password" class="form-control" name="mat_khau_lai" id="mat_khau_lai" placeholder="Nhập lại mật khẩu">
							<small id="Error" class="form-text text-muted"><?php echo form_error('mat_khau_lai') ?></small>
						</div>
						<div class="form-group">
							<?php if (!empty($message)): ?>
								<div class="alert alert-success text-center" role="alert"><?php echo $message; ?></div>
							<?php endif ?>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn newspaper-btn text-center mt-3 w-100">Đăng ký</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
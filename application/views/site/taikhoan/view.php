<div class="form-dang-nhap">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-xl-6 offset-xl-3">
					<div class="alert alert-danger text-center title-login" role="alert">Thông Tin Tài Khoản Website</div>
					<form  action="<?php echo base_url('taikhoan/view') ?>" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên người dùng</label>
							<input type="text" disabled="true" class="form-control" value="<?php echo $nguoi_dung['ten_nguoi_dung']; ?>" name="ten_nguoi_dung" id="ten_nguoi_dung" aria-describedby="Error" placeholder="Tên người dùng">
							<small id="Error" class="form-text text-muted"><?php echo form_error('ten_nguoi_dung') ?></small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email đăng nhập</label>
							<input type="email" disabled="true" class="form-control" value="<?php echo $nguoi_dung['email_dang_nhap']; ?>" name="email" id="email" aria-describedby="Error" placeholder="Email đăng nhập">
							<small id="Error" class="form-text text-muted"><?php echo form_error('email') ?></small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Mật khẩu mới</label>
							<input type="password" class="form-control" name="mat_khau_moi" id="mat_khau_moi" placeholder="Mật khẩu mới">
							<small id="Error" class="form-text text-muted"><?php echo form_error('mat_khau_moi') ?></small>
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Nhập lại mật khẩu mới</label>
							<input type="password" class="form-control" name="mat_khau_moi_lai" id="mat_khau_moi_lai" placeholder="Nhập lại mật khẩu mới">
							<small id="Error" class="form-text text-muted"><?php echo form_error('mat_khau_moi_lai') ?></small>
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Mật khẩu cũ</label>
							<input type="password" class="form-control" name="mat_khau_cu" id="mat_khau_cu" placeholder="Mật khẩu cũ">
							<small id="Error" class="form-text text-muted"><?php echo form_error('mat_khau_cu') ?></small>
						</div>

						<div class="form-group">
							<?php if (!empty($message)): ?>
								<div class="alert alert-success text-center" role="alert"><?php echo $message; ?></div>
							<?php endif ?>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn newspaper-btn text-center mt-3 w-100">Cập nhật thông tin</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
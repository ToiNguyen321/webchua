<div class="form-dang-nhap">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-xl-6 offset-xl-3">
					<div class="alert alert-danger text-center title-login" role="alert">Đăng Nhập Website</div>
					<form  action="<?php echo base_url('taikhoan/dangnhap') ?>" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Email đăng nhập</label>
							<input type="text" class="form-control" value="<?php echo set_value('email'); ?>" name="email" id="email" aria-describedby="emailHelp" placeholder="Email đăng nhập">
							
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Mật khẩu</label>
							<input type="password" class="form-control" name="mat_khau" id="mat_khau" placeholder="Mật khẩu">
						</div>

						<div class="form-group">
							<?php if (!empty($message)): ?>
								<div class="alert alert-success text-center" role="alert"><?php echo $message; ?></div>
							<?php endif ?>
						</div>

						<div class="form-group text-right">
							<a href="#">Quên mật khẩu?</a>
							<button type="submit" class="btn newspaper-btn mt-30 w-100">Đăng nhập</button>	
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
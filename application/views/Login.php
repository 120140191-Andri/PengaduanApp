<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Aplikasi Pengaduan Fasilitas Lab</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="<?= base_url('assets/js/Login.js') ?>"></script>
</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">
	<div class="global-container">
		<div class="card login-form">
			<div class="card-body">
				<p class="text-center pt-3 pb-3">
				<img src="<?= base_url('assets/foto/logo-polinela.png') ?>" alt="" width="120" height="120" srcset="">
				</p>
				<h3 class="card-title text-center font-weight-bold">Silahkan Login</h3>
				<div class="card-text">
					<form action="<?= base_url('/Login/cek_login') ?>" method="post">
						<div class="form-group">
							<label for="exampleInputEmail1">Alamat Email</label>
							<input type="email" class="form-control form-control-sm" name="email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control form-control-sm" name="password">
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-login-custom" value="Login">Login</button>
					</form>
					<div class="notif mt-3 pb-2 text-center">
						<?php echo $this->session->flashdata('pesan'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>

</html>


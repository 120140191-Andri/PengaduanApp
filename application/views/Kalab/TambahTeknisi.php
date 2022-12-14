<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kalab - Tambah Teknisi</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">

	<?php include_once "menu.php";?>

	<!-- Page Content  -->
	<div id="content">

		<div class="container-fluid">

			<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>

			</button>
			<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<i class="fas fa-align-justify"></i>
			</button>
		</div>
		<div class="container-fluid pt-4">
			<h2>Tambah Data Teknisi</h2>
			<form class="form-group" action="<?= base_url('Kalab/sys_tambah_teknisi') ?>" method="post">
				<input type="text" name="nama" placeholder="Nama" class="form-control col-12 col-md-6 mb-3">
				<input type="email" name="email" placeholder="Email" class="form-control col-12 col-md-6 mb-3">
				<label>*Password Default adalah: 1234, beritahu Pengguna segera ganti password setelah mendapatkan akun</label>
				<br>
				<input type="submit" value="Tambah Data" class="btn btn-primary btn-login-custom">
			</form>

			<div class="notif">
				<?php echo $this->session->flashdata('pesan'); ?>
			</div>
		</div>
	</div>
	<!-- Page Content -->
	</div>



</body>

</html>

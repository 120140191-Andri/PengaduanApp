<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kalab - Manage Lab</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="<?= base_url('assets/js/Manage_Lab.js') ?>"></script>
</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">
	<input id="id_lab" type="hidden" value="<?= $id_lab ?>">
	<input id="nama_lab" type="hidden" value="<?= $nama_lab ?>">

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
			<h2>Manajemen Perangkat Lab</h2>
			<br>
			<input type="text" id="nama" class="form-control col-6" placeholder="tambah perangkat....">
			<div class="btn btn-primary btn-login-custom" id="tambah">Tambah Perangkat</div>
		

			<div id="posX"></div>
			<div id="posY"></div>

			<div class="kontainer-atur"></div>
		</div>
	</div>
	<!-- Page Content -->
	</div>


</body>

</html>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teknisi - Tambah Laporan</title>
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
			<h2>Tambah Data Laporan Perangkat</h2>
			<form class="form-group" action="<?= base_url('Teknisi/sys_tambah_laporan') ?>" method="post"
				enctype="multipart/form-data">
				<input type="hidden" name="id_prop" value="<?= $id_prop ?>">
				<input type="hidden" name="id_user" value="<?= $id_user ?>">

				<div class="row">
					<div class="col-12 col-md-6 pb-4">
						<h6>Nama Perangkat : </h6>
						<input disabled type="text" name="nama_prop" placeholder="Nama" class="form-control"
							value="<?= $prop_n[0]->nama_prop ?>">
					</div>
					<div class="col-12 col-md-6 pb-4">
						<h6>Nama Teknisi :</h6>
						<input disabled type="text" name="nama_teknisi" class="form-control" placeholder="Nama"
							value="<?= $user_n[0]->nama ?>">
					</div>
					<div class="col-12 col-md-6 pb-4">
						<h6>Nama Pelapor : </h6>
						<input type="text" name="nama_pelapor" placeholder="Nama Pelapor" class="form-control">
					</div>
					<div class="col-12 col-md-6 pb-4">
						<h6>Npm : </h6>
						<input type="number" name="npm" placeholder="NPM" class="form-control">
					</div>
					<div class="col-12 col-md-6 pb-4">
						<h6>Masalah Pada Perangkat : </h6>
						<textarea name="masalah" cols="30" rows="10" placeholder="Masalah"
							class="form-control"></textarea>
					</div>
					<div class="col-12 col-md-6 pb-4">
						<label>Foto Bukti *optional</label><br>
						<input type="file" name="foto">
					</div>
				</div>
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

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RT - List TTD Laporan</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
	<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>

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
			<h2>Manajemen Data Tanda Tangan - Laporan</h2>
			<form class="form-group" action="<?= base_url('Rt/TTD_Laporan') ?>" method="post">
				<div class="row">
					<div class="col-6">
						<select name="filter" class="form-control">
							<?php if($fil == 'all'){ ?>
							<option>Semua</option>
							<option>dikirim</option>
							<option>dibalas</option>
							<?php } elseif($fil == 'dibalas') { ?>
							<option>dibalas</option>
							<option>Semua</option>
							<option>dikirim</option>
							<?php } elseif($fil == 'dikirim') { ?>
							<option>dikirim</option>
							<option>dibalas</option>
							<option>Semua</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<input type="submit" value="Filter Status" class="btn btn-primary btn-login-custom">
			</form>
			<br><br>
			<hr class=" mt-0 pb-4">

			<h5 class="pb-2">Periode Tanggal Laporan</h5>

			<table border="0" class="form-group">
				<tbody>
					<tr>
						<td>Mulai Tanggal :</td>
						<td><input type="text" id="min" name="min" class="form-control"></td>
					</tr>
					<tr>
						<td><br></td>
					</tr>
					<tr>
						<td>Sampai Tanggal :&nbsp;</td>
						<td><input type="text" id="max" name="max" class="form-control"></td>
					</tr>
				</tbody>
			</table>

			<a class="btn btn-primary btn-login-custom" href="<?= base_url('Rt/Tambah_TTD') ?>">Tambah</a>
		
			<hr>

			<table class="table table-striped display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Lab</th>
						<th>Pesan</th>
						<th>File dari RT</th>
						<th>File Dari Kepala Lab</th>
						<th>Status</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody id="show_data">
					<?php 
			$i = 0;
			foreach ($laporan as $row){ 
			$i++;
			?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row->nama_lab; ?></td>
						<td><?php echo $row->pesan; ?></td>
						<td><a class="btn btn-success mt-1 mb-1" href="<?= base_url('assets/dokumen/'.$row->file_rt) ?>">Download</a></td>
						<td>
							<?php if($row->status == 'dibalas'){ ?>
							<a class="btn btn-success mt-1 mb-1" href="<?= base_url('assets/dokumen/'.$row->file_kaleb) ?>">Download</a>
							<?php }else{ ?>
							<p class="pt-2 waiting-text">menunggu balasan</p>
							<?php } ?>
						</td>
						<td><?php echo $row->status; ?></td>
						<td><?php echo date('Y-m-d', strtotime($row->tgl_laporan)); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Page Content -->
	</div>
</body>

</html>

<script>
	var minDate, maxDate;

	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function (settings, data, dataIndex) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date(data[6]);

			if (
				(min === null && max === null) ||
				(min === null && date <= max) ||
				(min <= date && max === null) ||
				(min <= date && date <= max)
			) {
				return true;
			}
			return false;
		}
	);

	$(document).ready(function () {
		// Create date inputs
		minDate = new DateTime($('#min'), {
			format: 'MMMM Do YYYY'
		});
		maxDate = new DateTime($('#max'), {
			format: 'MMMM Do YYYY'
		});

		// DataTables initialisation
		var table = $('#example').DataTable();

		// Refilter the table
		$('#min, #max').on('change', function () {
			table.draw();
		});
	});

</script>

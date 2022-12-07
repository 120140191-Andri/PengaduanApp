<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kalab - List TTD Laporan</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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

	<ul>
		<li><a href="<?= base_url('Rt/') ?>">Dashboard</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
	</ul>

	<form action="<?= base_url('Kalab/TTD_Laporan') ?>" method="post">
		<select name="filter">
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
		<input type="submit" value="Filter Status">
	</form>
	<br><br>
	<hr>

	<table border="0" cellspacing="5" cellpadding="5">
		<tbody>
			<tr>
				<td>Mulai Tanggal:</td>
				<td><input type="text" id="min" name="min"></td>
			</tr>
			<tr>
				<td>Sampai Tanggal:</td>
				<td><input type="text" id="max" name="max"></td>
			</tr>
		</tbody>
	</table>

	<table class="table table-striped display" id="example">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Lab</th>
				<th>Pesan</th>
				<th>File dari RT</th>
				<th>File Dari saya</th>
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
				<td><a href="<?= base_url('assets/dokumen/'.$row->file_rt) ?>">Download</a></td>
				<td>
					<?php if($row->status == 'dibalas'){ ?>
						<a href="<?= base_url('assets/dokumen/'.$row->file_kaleb) ?>">Download</a>
					<?php }else{ ?>
						<a href="<?= base_url('Kalab/balas_TTD/'.$row->id_ttd) ?>">Kirim Balasan</a>
					<?php } ?>
				</td>
				<td><?php echo $row->status; ?></td>
				<td><?php echo date('Y-m-d', strtotime($row->tgl_laporan)); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>

</html>

<script>
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
	 function( settings, data, dataIndex ) {
		 var min = minDate.val();
		 var max = maxDate.val();
		 var date = new Date( data[6] );
  
		 if (
			 ( min === null && max === null ) ||
			 ( min === null && date <= max ) ||
			 ( min <= date   && max === null ) ||
			 ( min <= date   && date <= max )
		 ) {
			 return true;
		 }
		 return false;
	 }
 );
  
 $(document).ready(function() {
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
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RT - List Laporan</title>
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
		<li><a href="<?= base_url('Kalab/') ?>">Dashboard</a></li>
		<li><a href="<?= base_url('Kalab/Manage_lab') ?>">Manage Lab</a></li>
		<li><a href="<?= base_url('Kalab/List_Teknisi') ?>">List Teknisi</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
	</ul>

	<form action="<?= base_url('Kalab/List_Laporan') ?>" method="post">
		<select name="filter">
			<?php if($fil == 'all'){ ?>
			<option>Semua</option>
			<option>Selesai</option>
			<option>Diproses</option>
			<?php } elseif($fil == 'proses') { ?>
			<option>Diproses</option>
			<option>Semua</option>
			<option>Selesai</option>
			<?php } elseif($fil == 'end') { ?>
			<option>Selesai</option>
			<option>Diproses</option>
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
				<th>Nama Properti</th>
				<th>Nama Teknisi</th>
				<th>Nama Pelapor</th>
				<th>NPM Pelapor</th>
				<th>Masalah</th>
				<th>Tanggal</th>
				<th>Foto Bukti</th>
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
				<td><?php echo $row->nama_prop; ?></td>
				<td><?php echo $row->nama; ?></td>
				<td><?php echo $row->nama_pelapor; ?></td>
				<td><?php echo $row->npm; ?></td>
				<td><?php echo $row->masalah; ?></td>
				<td><?php echo date('Y-m-d', strtotime($row->tgl_laporan)); ?></td>
				<td><img src="<?= base_url('assets/foto/'. $row->foto_bukti) ?>" alt="" srcset=""></td>
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
	 var table = $('#example').DataTable({
		dom: 'Bfrtip',
        buttons: [
			{
                extend: 'print',
                exportOptions: {
                    stripHtml : false,
                    columns: [0, 1, 2, 3, 4, 5, 6] 
                    //specify which column you want to print
 
                }
        	}
        ]
	 });
  
	 // Refilter the table
	 $('#min, #max').on('change', function () {
		 table.draw();
	 });
 });
</script>
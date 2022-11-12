<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery UI Draggable - Default functionality</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/gaya.css') ?>">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">

	<ul>
		<li><a href="">s</a></li>
		<li><a href="<?= base_url('Rt/List_lab') ?>">List Lab</a></li>
		<li><a href="<?= base_url('Rt/List_Rt') ?>">List RT</a></li>
		<li><a href="<?= base_url('Rt/List_Kalab') ?>">List Ketua Lab</a></li>
		<li><a href="<?= base_url('Rt/List_Teknisi') ?>">List Teknisi</a></li>
	</ul>

    <a href="<?= base_url('Rt/Tambah_Lab') ?>">Tambah Lab</a>

	<table class="table table-striped" id="mydata">
		<thead>
			<tr>
				<th>Nama Lab</th>
				<th>Kepala Lab</th>
			</tr>
		</thead>
		<tbody id="show_data">
			<?php foreach ($lab as $row){ ?>
			<tr>
				<td><?php echo $row->nama_lab; ?></td>
				<td><?php echo $row->nama != null ? $row->nama : 'Belum Ditentukan'; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>

</html>

<script>
$(document).ready(function(){
    $('#mydata').dataTable();
});
</script>
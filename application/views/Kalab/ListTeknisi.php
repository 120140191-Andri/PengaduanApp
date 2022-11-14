<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kalab - List Teknisi</title>
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
	
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">

	<ul>
        <li><a href="<?= base_url('Kalab/') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('Kalab/Manage_lab') ?>">Manage Lab</a></li>
        <li><a href="<?= base_url('Kalab/List_Teknisi') ?>">List Teknisi</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
	</ul>

    <a href="<?= base_url('Kalab/Tambah_Teknisi') ?>">Tambah Teknisi</a>
	<br><br><hr>

	<table class="table table-striped display" id="mydata">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="show_data">
			<?php foreach ($teknisi as $row){ ?>
			<tr>
				<td><?php echo $row->nama; ?></td>
				<td><?php echo $row->email; ?></td>
				<td>
					<a href="<?= base_url('Kalab/Ubah_Teknisi/'.$row->id) ?>">Ubah</a>
					|
					<a href="<?= base_url('Kalab/sys_hapus_teknisi/'.$row->id) ?>">Hapus</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>

</html>

<script>
$(document).ready(function(){
    $('#mydata').dataTable(
	{
		// dom: 'Bfrtip',
        // buttons: [
        //     'print',
        // ]
	}
	);
});
</script>
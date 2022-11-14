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
		<li><a href="<?= base_url('Rt/') ?>">Dashboard</a></li>
		<li><a href="<?= base_url('Rt/List_lab') ?>">List Lab</a></li>
		<li><a href="<?= base_url('Rt/List_Kalab') ?>">List Ketua Lab</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
	</ul>

    <form action="<?= base_url('Rt/sys_ubah_lab') ?>" method="post">
        <input type="text" name="nama_lab" placeholder="nama lab" value="<?= $lab_n[0]->nama_lab ?>">
		<input type="hidden" name="id_lab" value="<?= $id ?>">
		<select name="kalab">
			<?php if($lab_n[0]->id_user != 0){ ?>
				<option value="<?= $lab_n[0]->id_user ?>"><?= $lab_n[0]->nama ?></option>
			<?php } ?>
            <?php foreach($kalab as $l){ ?>
                <option value="<?php echo $l->id; ?>"><?php echo $l->nama; ?></option>
            <?php } ?>
        </select> 
        <input type="submit" value="Ubah">
    </form>

</body>

</html>
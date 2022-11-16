<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teknisi - Tambah Laporan</title>
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
		<li><a href="<?= base_url('Teknisi/') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('Teknisi/Manage_lab') ?>">Manage Lab</a></li>
		<li><a href="<?= base_url('Teknisi/Ganti_Password') ?>">Ganti Password</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
    </ul>

    <form action="<?= base_url('Teknisi/sys_tambah_laporan') ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id_prop" value="<?= $id_prop ?>">
		<input type="hidden" name="id_user" value="<?= $id_user ?>">

		<input disabled type="text" name="nama_prop" placeholder="Nama" value="<?= $prop_n[0]->nama_prop ?>">
		<br><br>
		<input disabled type="text" name="nama_teknisi" placeholder="Nama" value="<?= $user_n[0]->nama ?>">
		<hr>

        <input type="text" name="nama_pelapor" placeholder="Nama Pelapor">
		
		<br>
		<br>
		<br>

        <input type="number" name="npm" placeholder="NPM">
		
		<br>
		<br>
		<br>
		
		<textarea name="masalah" cols="30" rows="10" placeholder="Masalah"></textarea>
		
		<br>
		<br>
		<br>

		<label>Foto Bukti *optional</label><br><br>
		<input type="file" name="foto">

		<br>
		<br>
		<br>

        <input type="submit" value="Tambah">
    </form>

    <div class="notif">
        <?php echo $this->session->flashdata('pesan'); ?>
    </div>

</body>

</html>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kalab - Tambah Teknisi</title>
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
        <li><a href="<?= base_url('Kalab/') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('Kalab/Manage_lab') ?>">Manage Lab</a></li>
        <li><a href="<?= base_url('Kalab/List_Teknisi') ?>">List Teknisi</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
	</ul>

    <form action="<?= base_url('Kalab/sys_tambah_teknisi') ?>" method="post">
        <input type="text" name="nama" placeholder="Nama">
        <input type="email" name="email" placeholder="Email">
        <label>*Password Default adalah: 1234, beritahu Pengguna segera ganti password setelah mendapatkan akun</label>
        <input type="submit" value="Tambah">
    </form>

    <div class="notif">
        <?php echo $this->session->flashdata('pesan'); ?>
    </div>

</body>

</html>
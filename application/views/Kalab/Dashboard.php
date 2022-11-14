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
</head>

<body>
	<input id="baseurl" type="hidden" value="<?= base_url() ?>">
	
    <ul>
		<li><a href="<?= base_url('Kalab/') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('Kalab/Manage_lab') ?>">Manage Lab</a></li>
        <li><a href="<?= base_url('Kalab/List_Teknisi') ?>">List Teknisi</a></li>
		<li><a href="<?= base_url('Login/logout') ?>">Logout</a></li>
    </ul>

</body>

</html>
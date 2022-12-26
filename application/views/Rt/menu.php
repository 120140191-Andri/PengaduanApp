
	

	<!-- Scrollbar Custom CSS -->
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
		integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
		integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
	</script>


	<div class="wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>Dashboard Menu</h3>
			</div>

			<ul class="list-unstyled components">
				<li><a href="<?= base_url('Rt/') ?>"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
				<li><a href="<?= base_url('Rt/List_lab') ?>"><i class="fas fa-clipboard-list mr-2"></i>List Lab</a></li>
				<li><a href="<?= base_url('Rt/List_Kalab') ?>"><i class="fas fa-clipboard-list mr-2"></i>List Ketua Lab</a></li>
				<li><a href="<?= base_url('Rt/List_Laporan') ?>"><i class="fas fa-folder-open mr-2"></i>List Laporan <span class="badge badge-success"><?= $notif ?></span> </a></li>
				<!-- <li><a href="<base_url('Rt/TTD_Laporan') ?>"><i class="fas fa-file-medical-alt mr-2"></i>Tanda Tangan Laporan</a></li> -->
				<li><a href="<?= base_url('Rt/Ganti_Password') ?>"><i class="fas fa-key mr-2"></i>Ganti Password</a></li>
				<li><a href="<?= base_url('Login/logout') ?>"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
			</ul>
		</nav>

		

	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
		integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
	</script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
		integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
	</script>
	<!-- jQuery Custom Scroller CDN -->
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$("#sidebar").mCustomScrollbar({
				theme: "minimal"
			});

			$('#sidebarCollapse').on('click', function () {
				$('#sidebar, #content').toggleClass('active');
				$('.collapse.in').toggleClass('in');
				$('a[aria-expanded=true]').attr('aria-expanded', 'false');
			});
		});

	</script>
</body>

</html>

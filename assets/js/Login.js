$(function () {
	let baseurl = $('#baseurl').val();

	$('#loginBtn').on('click', function () {

		let email = $('#email').val();
        let pass = $('#pass').val();

		if (email != '') {
			if (pass != '') {

				$.ajax({
					url: baseurl + '/Login/cek_login',
					method: 'post',
					data: {
						email: email,
                        pass: pass,
					},
					success: function (data) {
						if (data == 'ada') {
							toastr.warning('Nama Properti Sudah ada!');
						} else {
							toastr.success('Berhasil!', 'Properti dibuat');
						}
					},
					error: function (request, status, error) {
						toastr.error(error, status);
					}
				});
                
			} else {
				toastr.warning('Masukan Password Anda!');
			}
		} else {
			toastr.warning('Masukan Email Anda!');
		}
	});
});
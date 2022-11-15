$(function () {
	let baseurl = $('#baseurl').val();
	let id_lab = $('#id_lab').val();

	$.ajax({
		url: baseurl + '/Kalab/ambil_properti',
		method: 'post',
		data: {
			id_lab: id_lab,
		},
		success: function (data) {
			let dats = JSON.parse(data);
			for (var i = 0; i < dats.length; ++i) {
				
				let nama_prop = dats[i]['nama_prop'];

				if(dats[i]['status'] == 'aman'){
					$('.kontainer-atur').append($("<div id='" + nama_prop + "' class='prop_aman ui-widget-content'><p>" + nama_prop + "</p></div>"));
				}else{
					$('.kontainer-atur').append($("<div id='" + nama_prop + "' class='prop_problem ui-widget-content'><p>" + nama_prop + "</p></div>"));
				}

				$("#" + nama_prop).offset({
					top: dats[i]['yPos'],
					left: dats[i]['xPos'],
				})
 
				$("#" + nama_prop).draggable({
					addClasses: true,
					appendTo: "body",
					stop: function () {
						var offset = $(this).offset();
						var xPos = offset.left;
						var yPos = offset.top;
						$('#posX').text('x: ' + xPos);
						$('#posY').text('y: ' + yPos);
						$.ajax({
							url: baseurl + '/Kalab/ubah_properti',
							method: 'post',
							data: {
								nama_prop: nama_prop,
								xPos: offset.left,
								yPos: offset.top,
							},
							success: function (data) {
								toastr.success('Berhasil!', 'Properti dipindah');
							},
							error: function (request, status, error) {
								toastr.warning('Priksa koneksi!');
								toastr.error(error, status);
							}
						});
					}
				});

			}
		},
		error: function (request, status, error) {
			toastr.warning('Priksa koneksi!');
			toastr.error(error, status);
		}
	});

	$('#tambah').on('click', function () {

		let nama_prop = $('#nama').val().split(' ').join('-');
		let id_lab = $('#id_lab').val();
		if (nama_prop != '') {
			if ($('#' + nama_prop).length == 0) {

				$('.kontainer-atur').append($("<div id='" + nama_prop + "' class='prop_aman ui-widget-content'><p>" + nama_prop + "</p></div>"));

				$("#" + nama_prop).draggable({
					addClasses: true,
					appendTo: "body",
					stop: function () {
						var offset = $(this).offset();
						var xPos = offset.left;
						var yPos = offset.top;
						$('#posX').text('x: ' + xPos);
						$('#posY').text('y: ' + yPos);
						$.ajax({
							url: baseurl + '/Kalab/ubah_properti',
							method: 'post',
							data: {
								nama_prop: nama_prop,
								xPos: offset.left,
								yPos: offset.top,
							},
							success: function (data) {
								
							},
							error: function (request, status, error) {
								toastr.warning('Priksa koneksi!');
								toastr.error(error, status);
							}
						});
					}
				});

				let posisi = $('#' + nama_prop).offset();

				$.ajax({
					url: baseurl + '/Kalab/tambah_properti',
					method: 'post',
					data: {
						nama_prop: nama_prop,
						xPos: posisi.left,
						yPos: posisi.top,
						id_lab: id_lab,
					},
					success: function (data) {
						if (data == 'ada') {
							$('#' + nama_prop).remove();
							toastr.warning('Nama Properti Sudah ada!');
						} else {
							toastr.success('Berhasil!', 'Properti dibuat');
						}
					},
					error: function (request, status, error) {
						$('#' + nama_prop).remove();
						toastr.error(error, status);
					}
				});
			} else {
				toastr.warning('Nama Properti sudah ada!');
			}
		} else {
			toastr.warning('Nama Properti Wajib Diisi!');
		}
	});
});
$(function () {
	let baseurl = $('#baseurl').val();
	let id_lab = $('#id_lab').val();

	$.ajax({
		url: baseurl + '/Teknisi/ambil_properti',
		method: 'post',
		data: {
			id_lab: id_lab,
		},
		success: function (data) {
			let dats = JSON.parse(data);
			for (var i = 0; i < dats.length; ++i) {
				
				let nama_prop = dats[i]['nama_prop'];
				let id_prop = dats[i]['id'];

				if(dats[i]['status'] == 'aman'){
					$('.kontainer-atur').append($("<div id='" + nama_prop + "' class='box-tek prop_aman ui-widget-content'><p>" + nama_prop + "</p> <div class='box-lapor'> <a href='"+ baseurl + '/Teknisi/laporkan_properti/' + id_prop +"'><i class='fa-solid fa-bullhorn'></i></a></div> </div>"));
				}else{
					$('.kontainer-atur').append($("<div id='" + nama_prop + "' class='box-tek prop_problem ui-widget-content'><p>" + nama_prop + "</p> <div class='box-lapor'><span>Diproses</span>&nbsp;&nbsp;<a href='"+ baseurl + '/Teknisi/ubah_laporkan_properti/' + id_prop +"'><i class='fa-solid fa-pen-to-square'></i></a></div> </div>"));
				}

				$("#" + nama_prop).offset({
					top: dats[i]['yPos'],
					left: dats[i]['xPos'],
				});

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
							url: baseurl + '/Teknisi/ubah_properti',
							method: 'post',
							data: {
								nama_prop: nama_prop,
								xPos: offset.left,
								yPos: offset.top,
							},
							success: function (data) {
								toastr.success('Berhasil!', 'Properti dipindah');
								setTimeout( () => window.location = baseurl + 'Teknisi/Manage_lab', 400 );
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
							url: baseurl + '/Teknisi/ubah_properti',
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
					url: baseurl + '/Teknisi/tambah_properti',
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
							setTimeout( () => window.location = baseurl + 'Teknisi/Manage_lab', 400 );
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
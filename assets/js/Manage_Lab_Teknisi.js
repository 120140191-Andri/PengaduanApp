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
				})

			}
		},
		error: function (request, status, error) {
			toastr.warning('Priksa koneksi!');
			toastr.error(error, status);
		}
	});

});
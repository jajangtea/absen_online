$(document).ready(function() {
	tampil_input_absen();
	tampil_data_absen();
	load_data_mahasiswa();
	$(document).on("click", "#btn-simpan_eks", function(e) {
		if (cek_data_absen() == true) {
			$("#exampleModal #exampleModalLabel").text("Informasi");
			$("#exampleModal .modal-body").text(
				"Data tidak bisa disimpan karena sudah pernah diinput."
			);
			$("#exampleModal").modal("show");
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "kehadiran/simpan_absen",
				dataType: "JSON",
				data: $("#form-absen form").serialize(), // Ambil semua data yang ada didalam tag form
				success: function(data) {
					tampil_data_absen();
					console.log("oke");
					$("#exampleModal #exampleModalLabel").text("Informasi");
					$("#exampleModal .modal-body").text("Data berhasil disimpan");
					$("#exampleModal").modal("show");
				}
			});
		}
		return false;
	});

	function tampil_data_absen() {
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/tampil_kehadiran",
			async: true,
			dataType: "json",
			success: function(data) {
				var html = "";
				var i, j, k, tgl, rangkuman;
				for (i = 0; i < data.length; i++) {
					if (data[i].keterangan === null || data[i].keterangan == "") {
						j = " - ";
					} else {
						j = data[i].keterangan.toUpperCase();
					}

					if (data[i].rangkuman === null || data[i].rangkuman == "") {
						rangkuman = '<i class="simple-icon-dislike fa-3x text-danger"></i>';
					} else {
						rangkuman = '<i class="simple-icon-like fa-3x text-info"></i>';
					}

					if (data[i].tgl_absen === null) {
						tgl = "--:--";
					} else {
						tgl = data[i].tgl_absen;
					}
					console.log(absen_mhs(data[i].absen));
					if (absen_mhs(data[i].absen) == "ALFA") {
						k = absen_mhs(data[i].absen);
						badge = "badge-danger";
					} else {
						k = absen_mhs(data[i].absen);
						badge = "badge-success";
					}

					html +=
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						'<a class="list-item-heading mb-0 truncate w-50 w-xs-100" href="#">' +
						'<small><span class="mb-2 badge badge-pill ' +
						badge +
						'">' +
						(i + 1) +
						"</span></small>" +
						data[i].nama_mhs +
						'<span class="mb-1 text-muted text-small w-15 w-xs-100">' +
						data[i].nim +
						"</span></a>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill ' +
						badge +
						' btn-block">' +
						k +
						" ; " +
						j +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-20 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill ' +
						badge +
						' btn-block">' +
						tgl +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-10 h-20"  href="#">' +
						'<span class="mb-1 badge badge-pill badge-default btn-block">' +
						rangkuman +
						"</span>" +
						"</a>" +
						'<div class="list-item-heading mb-0 truncate w-10 w-xs-100">' +
						'<a href="javascript:;" class="mb-1 badge badge-pill badge-info btn-block item_edit" data="' +
						data[i].id +
						'"><strong>EDIT</strong></a>' +
						" " +
						"</div>" +
						"</div>" +
						"</div>" +
						"</div>";
				}
				$("#show_data").html(html);
			}
		});
	}

	function tampil_input_absen() {
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/tampil_input_absen",
			async: true,
			dataType: "json",
			success: function(data) {
				console.log(data.input_data.length);
				var html = "";
				var i;
				for (i = 0; i < data.input_data.length; i++) {
					html +=
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						'<input type="hidden" name="nim_mhs[]" value="' +
						data.input_data[i].nim +
						'"/>' +
						'<input type="hidden" name="nama_mhs[]" value="' +
						data.input_data[i].nama_mhs +
						'" />' +
						'<input type="hidden" name="rangkuman[]" />' +
						'<input type="hidden" name="hidden_id[]" value="' +
						data.idkehadiran +
						'" />' +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<small> <span class="mb-2 badge badge-pill badge-danger">' +
						(i + 1) +
						"</span></small>" +
						"" +
						data.input_data[i].nama_mhs +
						'<span class="mb-0 text-muted text-small w-15 w-xs-100">' +
						data.input_data[i].nim +
						"</span>" +
						"</a>" +
						'<div class="list-item-heading mb-40 truncate w-15 w-xs-100">' +
						'<select class="form-control mb-2" name="absen[]">' +
						'<option value="H">Hadir</option>' +
						'<option value="S">Sakit</option>' +
						'<option value="I">Izin</option>' +
						'<option value="A">Alfa</option>' +
						"</select>" +
						"</div>" +
						'<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
						'<input type="text" name="keterangan[]" class="form-control mb-2" placeholder="Keterangan (Kosongkan jika tidak diperlukan.)">' +
						"</div>" +
						"</div>" +
						"</div>" +
						"</div>";
				}
				$("#show_input").html(html);
			}
		});
	}

	function cek_data_absen() {
		var status = false;
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/cek_absen",
			async: true,
			dataType: "json",
			async: false,
			success: function(data) {
				if (data.status_absen == 1) {
					status = data.status_absen;
					status = true;
				}
			}
		});
		return status;
	}

	function cek_data_absen_mahasiswa() {
		var status = false;
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/cek_absen_mahasiswa",
			async: true,
			dataType: "json",
			async: false,
			success: function(data) {
				if (data.status_absen >= 1) {
					status = data.status_absen;
					status = true;
				}
			}
		});
		return status;
	}

	$("#btn-simpan").on("click", function() {
		if (cek_data_absen() == true && cek_data_absen_mahasiswa() == true) {
			$("#exampleModal #exampleModalLabel").text("Informasi");
			$("#exampleModal .modal-body").text(
				"Absen tidak dapat dilakukan lebih dari sekali, jika anda mahasiswa silahkan hubungi dosen bersangkutan untuk mengubah absen."
			);
			$("#exampleModal").modal("show");
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "kehadiran/simpan_absen",
				dataType: "JSON",
				data: $("#form-absen form").serialize(), // Ambil semua data yang ada didalam tag form
				success: function(data) {
					tampil_data_absen();
					load_data_mahasiswa();
					tampil_input_absen();
					$("#show_input_hide").hide();
					$("#exampleModal #exampleModalLabel").text("Informasi");
					$("#exampleModal .modal-body").text("Data berhasil disimpan");
					$("#exampleModal").modal("show");
				}
			});
		}
		return false;
	});

	//GET UPDATE
	$("#show_data").on("click", ".item_edit", function() {
		var id = $(this).attr("data");
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/edit",
			dataType: "JSON",
			data: { id: id },
			success: function(data) {
				$("#ModalaEdit #exampleModalLabel").text("Informasi");
				$.each(data, function(nim, nama, absen, keterangan, rangkuman) {
					$("#ModalaEdit").modal("show");
					$('[name="nim_edit"]').val(data.nim);
					$('[name="nama_edit"]').val(data.nama);
					$('[name="absen_edit"]').val(data.absen);
					$('[name="keterangan_edit"]').val(data.keterangan);
					$('[name="rangkuman_edit"]').val(data.rangkuman);
					$('[name="hidden_edit"]').val(data.id);
				});
			}
		});
		return false;
	});

	$("#show_data_mahasiswa").on("click", ".item_edit", function() {
		var id = $(this).attr("data");
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/edit",
			dataType: "JSON",
			data: { id: id },
			success: function(data) {
				$("#ModalaEdit #exampleModalLabel").text("Informasi");
				$.each(data, function(nim, nama, absen, keterangan, rangkuman) {
					$("#ModalaEdit").modal("show");
					$('[name="nim_edit"]').val(data.nim);
					$('[name="nama_edit"]').val(data.nama);
					$('[name="absen_edit"]').val(data.absen);
					$('[name="keterangan_edit"]').val(data.keterangan);
					$('[name="rangkuman_edit"]').val(data.rangkuman);
					$('[name="hidden_edit"]').val(data.id);
				});
			}
		});
		return false;
	});

	$("#btn_update").on("click", function() {
		var id = $("#hidden_id").val();
		var absen = $("#absen").val();
		var keterangan = $("#keterangan").val();
		var rangkuman = $("#rangkuman").val();
		$.ajax({
			type: "POST",
			url: base_url + "kehadiran/update?id=" + id,
			dataType: "JSON",
			data: {
				absen: absen,
				keterangan: keterangan,
				rangkuman: rangkuman,
				id: id
			},
			success: function(data) {
				tampil_data_absen();
				$("#ModalaEdit").modal("hide");
			}
		});
		return false;
	});

	function absen_mhs(x) {
		if (x == "I") {
			return "IZIN";
		} else if (x == "S") {
			return "SAKIT";
		} else if (x == "A") {
			return "ALFA";
		} else if (x == "H") {
			return "HADIR";
		}
	}

	function load_data(query) {
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/cari",
			async: true,
			dataType: "json",
			data: { query: query },
			success: function(data) {
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-warning btn-block">' +
						data[i].nama_mhs +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-danger btn-block">' +
						data[i].nim +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-success btn-block">' +
						absen_mhs(data[i].absen) +
						";" +
						data[i].keterangan.toUpperCase() +
						"</span>" +
						"</a>" +
						'<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
						'<a href="javascript:;" class="btn btn-secondary btn-sm btn-block mb-1 item_edit" data="' +
						data[i].id +
						'">EDIT</a>' +
						" " +
						"</div>" +
						"</div>" +
						"</div>" +
						"</div>";
				}
				$("#show_data").html(html);
			}
		});
	}

	function load_data_mahasiswa() {
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/cari_mahasiswa",
			async: true,
			dataType: "json",
			success: function(data) {
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-warning btn-block">' +
						data[i].nama_mhs +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-danger btn-block">' +
						data[i].nim +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						'<span class="mb-1 badge badge-pill badge-success btn-block">' +
						absen_mhs(data[i].absen) +
						";" +
						data[i].keterangan.toUpperCase() +
						"</span>" +
						"</a>" +
						'<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
						'<a href="javascript:;" class="mb-1 badge badge-pill badge-info btn-block item_edit" data="' +
						data[i].id +
						'">EDIT</a>' +
						" " +
						"</div>" +
						"</div>" +
						"</div>" +
						"</div>";
				}
				$("#show_data_mahasiswa").html(html);
			}
		});
	}

	function load_eks(query) {
		$.ajax({
			type: "GET",
			url: base_url + "kehadiran/cari_ektension",
			async: true,
			dataType: "json",
			data: { query: query },
			success: function(data) {
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						'<div class="col-md-12 mb-4">' +
						"<form>" +
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						'<input type="hidden" name="nim_mhs[]" value="<?= $data->nim; ?>" />' +
						'<input type="hidden" name="nama_mhs[]" value="<?= $data->nama_mhs; ?>" />' +
						'<input type="hidden" name="hidden_id[]" value=' +
						data[i].nim +
						"/>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						"" +
						data[i].nama_mhs +
						'<span class="mb-0 text-muted text-small w-15 w-xs-100">' +
						data[i].nim +
						"</span>" +
						"</a>" +
						'<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
						"" +
						data[i].nmatkul +
						"" +
						"</a>" +
						'<div class="list-item-heading mb-40 truncate w-15 w-xs-100">' +
						'<select class="form-control mb-2" name="absen[]">' +
						'<option value="H">Hadir</option>' +
						'<option value="S">Sakit</option>' +
						' <option value="I">Izin</option>' +
						'<option value="A">Alfa</option>' +
						"</select>" +
						"</div>" +
						'<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
						'<input type="text" name="keterangan[]" class="form-control mb-2" placeholder="Keterangan (Kosongkan jika tidak diperlukan.)">' +
						"</div>" +
						"</div>" +
						"</div>" +
						"</div>" +
						'<div class="card d-flex flex-row mb-3">' +
						'<div class="d-flex flex-grow-1 min-width-zero">' +
						'<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +
						' <button type="button" id="btn-simpan_eks" class="btn btn-success"> SIMPAN</button>' +
						"</div>" +
						"</div>" +
						"</div>" +
						"</form>" +
						"</div>";
				}
				$("#show_eks").html(html);
			}
		});
	}

	$("#search_text").keyup(function() {
		var search = $(this).val();
		if (search != "") {
			load_data(search);
		} else {
			tampil_data_absen();
		}
	});

	$("#search_mhs").keyup(function() {
		var search = $(this).val();
		if (search != "") {
			load_eks(search);
		}
	});

	$("#btnahead").click(function() {
		var str = $("#query").val();
		var strprodi = $("#prodi :selected").val();
		var strkelas = $("#kelas :selected").val();

		load_data_kelas(strprodi, strkelas, str);
	});

	function load_data_kelas(strprodi, strkelas, str) {
		$.ajax({
			type: "GET",
			url: base_url + "kelas/cari_mhs",
			async: true,
			dataType: "json",
			data: { query: query },
			success: function(data) {
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr>" +
						'<td style="text-align: center;">' +
						data[i].nim +
						"</td>" +
						'<td style="text-align: left;">' +
						data[i].nama_mhs +
						"</td>" +
						'<td style="text-align: left;">' +
						data[i].nmatkul +
						"</td>" +
						'<td style="text-align: center;">' +
						data[i].aturan +
						"</td>" +
						'<td style="text-align: center;">' +
						data[i].pilihan +
						"</td>" +
						"</tr>";
				}
				$("#show_kelas_mhs").html(html);
			}
		});
	}
});

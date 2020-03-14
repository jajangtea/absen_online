$(document).ready(function() {
    tampil_data_absen();

    function tampil_data_absen() {
        $.ajax({
            type: 'GET',
            url: base_url + 'kehadiran/tampil_kehadiran',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<div class="card d-flex flex-row mb-3">' +
                        '<div class="d-flex flex-grow-1 min-width-zero">' +
                        '<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +

                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-warning btn-block">' + data[i].nama_mhs + '</span>' +
                        '</a>' +

                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-danger btn-block">' + data[i].nim + '</span>' +
                        '</a>' +


                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-success btn-block">' + absen_mhs(data[i].absen) + ';' + data[i].keterangan.toUpperCase() + '</span>' +
                        '</a>' +

                        '<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
                        '<a href="javascript:;" class="btn btn-secondary btn-sm mb-1 btn-block item_edit" data="' + data[i].id + '"><strong>EDIT</strong></a>' + ' ' +
                        '</div>' +

                        '</div>' +
                        '</div>' +
                        '</div>';

                }
                $('#show_data').html(html);
            }

        });
    }

    function cek_data_absen() {
        var status = false;
        $.ajax({
            type: 'GET',
            url: base_url + 'kehadiran/cek_absen',
            async: true,
            dataType: 'json',
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

    $('#btn-simpan').on('click', function() {
        console.log(cek_data_absen());
        if (cek_data_absen() == true) {
            $('#exampleModal #exampleModalLabel').text("Informasi");
            $('#exampleModal .modal-body').text('Data tidak bisa disimpan karena sudah pernah diinput.');
            $('#exampleModal').modal('show');
        } else {
            $.ajax({
                type: "POST",
                url: base_url + 'kehadiran/simpan_absen',
                dataType: "JSON",
                data: $("#form-absen form").serialize(), // Ambil semua data yang ada didalam tag form
                success: function(data) {
                    tampil_data_absen();
                    $('#exampleModal #exampleModalLabel').text("Informasi");
                    $('#exampleModal .modal-body').text("Data berhasil disimpan");
                    $('#exampleModal').modal('show');

                }
            });
        }
        return false;
    });

    //GET UPDATE
    $('#show_data').on('click', '.item_edit', function() {
        var id = $(this).attr('data');
        $.ajax({
            type: "GET",
            url: base_url + 'kehadiran/edit',
            dataType: "JSON",
            data: { id: id },
            success: function(data) {
                $('#ModalaEdit #exampleModalLabel').text("Informasi");
                $.each(data, function(nim, nama, absen, keterangan) {
                    $('#ModalaEdit').modal('show');
                    $('[name="nim_edit"]').val(data.nim);
                    $('[name="nama_edit"]').val(data.nama);
                    $('[name="absen_edit"]').val(data.absen);
                    $('[name="keterangan_edit"]').val(data.keterangan);
                    $('[name="hidden_edit"]').val(data.id);
                });
            }
        });
        return false;
    });

    $('#btn_update').on('click', function() {
        var id = $('#hidden_id').val();
        var absen = $('#absen').val();
        var keterangan = $('#keterangan').val();
        $.ajax({
            type: "POST",
            url: base_url + 'kehadiran/update?id=' + id,
            dataType: "JSON",
            data: { absen: absen, keterangan: keterangan, id: id },
            success: function(data) {
                $('#ModalaEdit').modal('hide');
                tampil_data_absen();
            }
        });
        return false;
    });

    function absen_mhs(x) {
        if (x == 'I') {
            return 'IZIN';
        } else if (x == 'S') {
            return 'SAKIT'
        } else if (x == 'A') {
            return 'ALFA';
        } else if (x == 'H') {
            return 'HADIR';
        }
    }

    function load_data(query) {
        $.ajax({
            type: 'GET',
            url: base_url + 'kehadiran/cari',
            async: true,
            dataType: 'json',
            data: { query: query },
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<div class="card d-flex flex-row mb-3">' +
                        '<div class="d-flex flex-grow-1 min-width-zero">' +
                        '<div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">' +

                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-warning btn-block">' + data[i].nama_mhs + '</span>' +
                        '</a>' +

                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-danger btn-block">' + data[i].nim + '</span>' +
                        '</a>' +


                        '<a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">' +
                        '<span class="mb-1 badge badge-pill badge-success btn-block">' + absen_mhs(data[i].absen) + ';' + data[i].keterangan.toUpperCase() + '</span>' +
                        '</a>' +

                        '<div class="list-item-heading mb-0 truncate w-40 w-xs-100">' +
                        '<a href="javascript:;" class="btn btn-secondary btn-sm btn-block mb-1 item_edit" data="' + data[i].id + '">EDIT</a>' + ' ' +
                        '</div>' +

                        '</div>' +
                        '</div>' +
                        '</div>';
                }
                $('#show_data').html(html);
            }

        });
    }

    $('#search_text').keyup(function() {
        var search = $(this).val();
        if (search != '') {
            load_data(search);
        } else {
            tampil_data_absen();
        }
    });


})
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
                var j = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].nama_mhs + '<span class="mb-0 text-muted text-small w-15 w-xs-100">' + data[i].nim + '</span></td>' +
                        '<td style="text-align: center;"><span class="mb-2 badge badge-pill badge-danger">' + absen_mhs(data[i].absen) + ';' + data[i].keterangan.toUpperCase() + '</span></td>' +
                        '<td style="text-align:center;">' +
                        '<a href="javascript:;" class="btn btn-success btn-xs item_edit" data="' + data[i].id + '">EDIT</a>' + ' ' +
                        '</td>' +
                        '</tr>';
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
            $('#exampleModalLabel').text("Informasi");
            $('.modal-body').text('Data tidak bisa disimpan karena sudah pernah diinput.');
            $('#exampleModal').modal('show');
        } else {
            $.ajax({
                type: "POST",
                url: base_url + 'kehadiran/simpan_absen',
                dataType: "JSON",
                data: $("#form-absen form").serialize(), // Ambil semua data yang ada didalam tag form
                success: function(data) {
                    $('#exampleModalLabel').text("Informasi");
                    $('.modal-body').text("Data berhasil disimpan");
                    $('#exampleModal').modal('show');
                }
            });

            tampil_data_absen();
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
        if (x = 'I') {
            return 'IZIN';
        } else if (x = 'S') {
            return 'SAKIT'
        } else if (x = 'A') {
            return 'ALFA';
        } else if (x = 'H') {
            return 'HADIR';
        }
    }

})
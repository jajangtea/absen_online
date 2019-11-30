<div class="col-lg-12">
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="simple-icon-user"></i> Dosen</h4>
                    <h2>
                        <?php echo $this->session->userdata('nama') ?>
                    </h2>
                    <footer>
                        <p class="text-muted text-small mb-0 font-weight-light"><?= date('d-M-Y') ?> - Semester : <?php echo PresensiModel::get_nama_semester($this->session->userdata('semester')) ?></p>
                    </footer>
                </div>
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="simple-icon-event"></i> Info Kelas</h4>
                    <h2>
                        <?= $this->session->userdata('nmatkul') ?>                        
                        <!--<small><span class="badge badge-pill badge-danger"> <?php //$data_jam_ngajar->jam_masuk;           ?> - <?php //$data_jam_ngajar->jam_keluar;           ?></span></small>-->

                    </h2>
                    <footer>
                        <p class="text-muted text-small mb-0 font-weight-light"><?= PresensiModel::get_prodi($this->session->userdata('kjur')); ?> - <?= PresensiModel::get_kelas($this->session->userdata('kls')) ?> - (<?= PresensiModel::get_nama_kelompok($this->session->userdata('nama_kelompok')) ?>)</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 mb-2">
                        <form action="<?php echo site_url() . 'presensi/tampil_kelompok' ?>" method="post">
                            <div class="btn-group  mb-2">
                                <button type="submit" class="btn btn-primary">Pilih Kelompok :  <?= PresensiModel::get_nama_kelompok($this->session->userdata('nama_kelompok')) ?></button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" id="nama_kelompok" name="nama_kelompok">
                                    <?php
                                    foreach ($data_nama_kelas as $row) {
                                        echo "<a class='dropdown-item' href='" . site_url() . "presensi/tampil_kelompok/" . $row['nama_kelas'] . "'>" . PresensiModel::get_nama_kelompok($row['nama_kelas']) . "</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pertemuan</h4>
                    <span class="mb-2 badge badge-pill badge-info">TEKAN TOMBOL GO UNTUK MELAKUKAN ABSEN</span>
                    <div class="col-lg-12 col-md-12 mb-4">
                        <form action="<?php echo site_url() . 'kehadiran' ?>" method="POST">
                            <input type="hidden" id="hidden1" value="" name="hidden1" />
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>PERTEMUAN</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($data_kehadiran_master->num_rows() > 0): ?>
                                        <?php foreach ($data_kehadiran_master->result() as $data): ?>
                                            <tr>
                                                <td>Pertemuan Ke-<?= $data->pertemuan ?></td>
                                                <td>
                                                    <?= ($data->status) == '' ? '<span class="mb-2 badge badge-pill badge-danger">Belum Absen</span>' : '<span class="mb-2 badge badge-pill badge-primary">' . $data->status . '</span>' ?></span>

                                                </td>
                                                <td><input type="submit" class="btn btn-primary" value="GO"></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table = document.getElementById("table");
    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function () {
            document.getElementById("hidden1").value = this.cells[0].innerHTML;
        };
    }
</script>

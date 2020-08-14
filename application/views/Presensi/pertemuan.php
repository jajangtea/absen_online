<div class="col-lg-12">
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="simple-icon-user"></i> Mahasiswa</h4>
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
                    <h4 class="card-title"><i class="simple-icon-event"></i> Info Matakuliah</h4>
                    <h2>
                        <?= $nmatkul ?>
                    </h2>
                    <footer>
                        <p class="text-muted text-small mb-0 font-weight-light"><?= $nmdosen ?> </p>
                    </footer>
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
                        <form action="<?php echo site_url() . 'kehadiran/do_absen' ?>" method="POST">
                            <input type="hidden" id="hidden1" value="" name="hidden1" />
                            <input type="hidden" id="hidden_id" value="" name="hidden_id" />
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">PERTEMUAN</th>
                                            <th style="text-align: center;">STATUS</th>
                                            <th style="text-align: center;">TGL.ABSEN</th>
                                            <th style="text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data_kehadiran_pertemuan->num_rows() > 0) : ?>
                                            <?php foreach ($data_kehadiran_pertemuan->result() as $data) : ?>
                                                <tr>
                                                    <td style="display:none;"><?= $data->id ?></td>
                                                    <td style="text-align: center;">Ke-<?= $data->pertemuan ?></td>
                                                    <td style="text-align: center;">
                                                        <?= ($data->status) == '' ? '<span class="mb-2 badge badge-pill badge-danger">Belum</span>' : '<span class="mb-2 badge badge-pill badge-success">' . $data->status . '</span>' ?></span>
                                                    </td>
                                                    <td style="text-align: center;"><?= PresensiModel::get_day($data->tanggal) . ' ' . $data->tanggal ?></td>
                                                    <td style="text-align: center;"><input type="submit" class="btn btn-primary btn-xs mb-1" value="GO"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" style="text-align: center;"> <span class="mb-2 badge badge-pill badge-danger">DOSEN BELUM MEMBUKA AKSES ABSEN.</span></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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
        table.rows[i].onclick = function() {
            document.getElementById("hidden_id").value = this.cells[0].innerHTML;
            document.getElementById("hidden1").value = this.cells[1].innerHTML;
        };
    }
</script>
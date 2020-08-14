<div class="col-lg-12">
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="simple-icon-user"></i> IDENTITAS</h4>
                    <h2>
                        <?php echo $this->session->userdata('nama') ?>
                    </h2>
                    <footer>
                        <p class="text-muted text-small mb-0 font-weight-light"> <?= $this->session->userdata('tempat_lahir') ?> - <?= $this->session->userdata('tanggal_lahir') ?></p>
                    </footer>
                </div>
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="simple-icon-event"></i> PROGRAM STUDI</h4>
                    <h2>
                        <?= $this->session->userdata('nama_ps') ?> <span class="text-muted text-small mb-0 font-weight-light"> <?= $this->session->userdata('konsentrasi') ?></span>
                    </h2>

                    <footer>
                        <p class="text-muted text-small mb-0 font-weight-light"> SEMESTER : <?php echo PresensiModel::get_nama_semester($idsmt) ?> - TA : <?= $tahun_akademik ?></p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <form action="<?php echo site_url() . 'presensi/pertemuan' ?>" method="POST">
                        <input type="hidden" id="hidden_id" value="" name="hidden_id" />
                        <input type="hidden" id="hidden_nmatkul" value="" name="hidden_nmatkul" />
                        <input type="hidden" id="hidden_nmdosen" value="" name="hidden_nmdosen" />
                        <div class="table-responsive">
                            <table id="table" class="data-tables-pagination responsive nowrap">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">NO</th>
                                        <th style="display:none;">ID PENYELENGGARAAN</th>
                                        <th style="text-align: center;">KODE</th>
                                        <th style="text-align: center;">MATAKULIAH</th>
                                        <th style="text-align: center;">DOSEN</th>
                                        <th style="text-align: center;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($tampil_data->num_rows() > 0) : ?>
                                        <?php foreach ($tampil_data->result() as $pengguna) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++ ?></td>
                                                <td style="display:none;"><?= $pengguna->idpenyelenggaraan; ?></td>
                                                <td style="text-align: center;"><?= strtoupper(substr($pengguna->kmatkul, -6)); ?></td>
                                                <td><?= strtoupper($pengguna->nmatkul); ?></td>
                                                <td><?= strtoupper($pengguna->nama_dosen); ?></td>
                                                <td style="text-align: center;">
                                                    <input type="submit" class="btn btn-primary btn-xs mb-1" value="GO">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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

<script>
    var table = document.getElementById("table");
    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function() {
            document.getElementById("hidden_id").value = this.cells[1].innerHTML;
            document.getElementById("hidden_nmatkul").value = this.cells[3].innerHTML;
            document.getElementById("hidden_nmdosen").value = this.cells[4].innerHTML;
        };
    }
</script>
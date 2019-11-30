<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title"><i class="simple-icon-screen-tablet"></i> Data Matakuliah</h2>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="simple-icon-user"></i> Dosen</h4>
                            <h2>
                                <?php echo $this->session->userdata('nama') ?>
                            </h2>
                            <footer>
                                <p class="text-muted text-small mb-0 font-weight-light"><?= date('d-M-Y') ?></p>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="simple-icon-event"></i> Info Akademik</h4>
                            <h2>
                                T.A <?php echo $this->session->userdata('tahun_akademik') ?>
                            </h2>
                            <footer>
                                <p class="text-muted text-small mb-0 font-weight-light">SEMESTER : <?php echo strtoupper(PresensiModel::get_nama_semester($this->session->userdata('semester'))) ?></p>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 list" data-check-all="checkAll">
            <?php if ($sql_jadwal_dosen->num_rows() > 0): ?>
                <?php $index = 1; ?>
                <?php foreach ($sql_jadwal_dosen->result() as $data): ?>
                    <div class="card d-flex flex-row mb-3">
                        <a class="d-flex" href="<?php echo base_url() . 'presensi/tampil_absen/' . $data->idpenyelenggaraan . '/' . $data->idkelas ?>">
                            <input type=image src="<?php echo base_url() . 'assets/dore/img/fat-rascal-thumb.jpg' ?>"
                                   class="list-thumbnail responsive border-0 card-img-left" />
                        </a>    
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                                    <?php $this->session->set_userdata('kode', $data->kode); ?>
                                    <?= $data->nmatkul; ?>
                                </a>
                                <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                                    <?= PresensiModel::get_prodi($data->kjur); ?>
                                </a>
                                <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                                    <?php
                                    $this->session->set_userdata('jam_masuk', $data->jam_masuk);
                                    $this->session->set_userdata('jam_keluar', $data->jam_keluar);
                                    ?>
                                    <span class="badge badge-pill badge-success"> <?= PresensiModel::get_nama_hari($data->hari); ?></span>
                                    <span class="badge badge-pill badge-danger"><?= PresensiModel::get_kelas($data->idkelas) ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </form>
        </div>
    </div>

</div>
<script>
    var table = document.getElementById("table");
    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function () {
            document.getElementById("hidden_idpenyelenggaraan").value = this.cells[7].innerHTML;
        };
    }
</script>

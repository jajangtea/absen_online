<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card d-flex flex-row mb-3">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <h2>
                            <?php echo $this->session->userdata('pertemuanke') ?>
                        </h2>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form action="<?php echo site_url() . 'presensi/simpan_absen' ?>" method="post">
                <?php if ($data_kehadiran_master->num_rows() > 0): ?>
                    <?php $index = 1; ?>
                    <?php foreach ($data_kehadiran_master->result() as $data): ?>
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <input type="hidden" name="nim_mhs[]" value="<?= $data->nim; ?>"/>
                                    <input type="hidden" name="nama_mhs[]" value="<?= $data->nama_mhs; ?>"/>
                                    <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="Pages.Product.Detail.html">
                                        <small> <span class="mb-2 badge badge-pill badge-danger"><?= $index++; ?></span></small> <?= $data->nama_mhs; ?>  <span class="mb-0 text-muted text-small w-15 w-xs-100"><?= $data->nim; ?></span>
                                    </a>
                                    <div class="list-item-heading mb-40 truncate w-15 w-xs-100">
                                        <select class="form-control mb-2" name='absen[]' >
                                            <option value="H">Hadir</option>
                                            <option value="S">Sakit</option>
                                            <option value="I">Izin</option>
                                            <option value="A">Alfa</option>
                                        </select>
                                    </div>
                                    <div class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                        <input type="text" name="keterangan_mhs[]" class="form-control mb-2" placeholder="Keterangan (Kosongkan jika tidak diperlukan.)" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="Pages.Product.Detail.html">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <span class="mb-2 badge badge-pill badge-info">Data tidak ditemukan.</span>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
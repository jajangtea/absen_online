<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card d-flex flex-row mb-3">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <h2>
                            Pertemuan <?php echo $this->session->userdata('pertemuanke') ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4" id="form-absen">
            <!-- <form action="<? //php echo site_url() . 'kehadiran/simpan_absen' 
                                ?>" method="post"> -->
            <form>
                <?php if ($data_kehadiran_master->num_rows() > 0) : ?>
                    <?php $index = 1; ?>
                    <?php foreach ($data_kehadiran_master->result() as $data) : ?>
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <input type="hidden" name="nim_mhs[]" value="<?= $data->nim; ?>" />
                                    <input type="hidden" name="nama_mhs[]" value="<?= $data->nama_mhs; ?>" />
                                    <input type="hidden" name="hidden_id[]" value="<?= $this->session->userdata('hidden_id') ?>" />
                                    <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                                        <small> <span class="mb-2 badge badge-pill badge-danger"><?= $index++; ?></span></small>
                                        <?= $data->nama_mhs; ?> <span class="mb-0 text-muted text-small w-15 w-xs-100"><?= $data->nim; ?></span>
                                    </a>

                                    <div class="list-item-heading mb-40 truncate w-15 w-xs-100">
                                        <select class="form-control mb-2" name='absen[]'>
                                            <option value="H">Hadir</option>
                                            <option value="S">Sakit</option>
                                            <option value="I">Izin</option>
                                            <option value="A">Alfa</option>
                                        </select>
                                    </div>
                                    <div class="list-item-heading mb-0 truncate w-40 w-xs-100">
                                        <input type="text" name="keterangan[]" class="form-control mb-2" placeholder="Keterangan (Kosongkan jika tidak diperlukan.)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <button type="button" id="btn-simpan" class="btn btn-success"> SIMPAN</button>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <span class="mb-2 badge badge-pill badge-info">Data tidak ditemukan.</span>
                <?php endif; ?>


            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1>Data Kehadiran Pertemuan <?php echo $this->session->userdata('pertemuanke') ?> </h1>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse dont-collapse-sm" id="displayOptions">

                            <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input class="form-control" placeholder="Search Table" id="searchDatatable">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NAMA</th>
                                    <th style="text-align: center;">KETERANGAN</th>
                                    <th style="text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="show_data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="ModalaEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    <span id="modal-title"></span>
                </h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim_edit" placeholder="NIM" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Nama</label>
                        <input type="text" class="form-control" id="nama_mhs" name="nama_edit" placeholder="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Kehadiran</label>
                        <select class="form-control mb-2" id="absen" name="absen_edit">
                            <option value="H">Hadir</option>
                            <option value="S">Sakit</option>
                            <option value="I">Izin</option>
                            <option value="A">Alfa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Keterangan</label>
                        <input name="keterangan_edit" id="keterangan" class="form-control" type="textarea" rows="4" placeholder="Keterangan" required>
                    </div>
                    <input type="hidden" name="hidden_edit" id="hidden_id" class="hidden_id-value">
                </div>
                <div class="modal-footer">
                    <button class="btn"  data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->


<!-- Modal -->
<div class="modal fade" id="modalSimpan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <!-- Beri id "modal-title" untuk tag span pada judul modal -->
                    <span id="modalLabelSimpan"></span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-simpan">
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
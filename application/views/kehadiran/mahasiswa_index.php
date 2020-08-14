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
        <div class="col-lg-12">
            <div id="show_eks"></div>
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
                        <div class="card mb-4">
                            <div class="card-body ">
                                <h5 class="mb-4">Rangkuman Materi</h5>
                                <textarea class="form-control" rows="4" name="rangkuman[]"></textarea>
                                <!-- <div class="html-editor" id="quillEditor" name="rangkuman[]"></div> -->
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


    <!-- mmmmmmmmmmmmmmmmmm -->

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
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="show_data_mahasiswa"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade modal-right" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="rightModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <!-- Beri id "modal-title" untuk tag span pada judul modal -->
                    <span id="exampleModalLabel"></span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="addToDatatableForm" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nim" name="nim_edit" placeholder="NIM" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_mhs" name="nama_edit" placeholder="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Kehadiran</label>
                        <select class="form-control mb-2" id="absen" name="absen_edit" onmousedown="(function(e){ e.preventDefault(); })(event, this)">
                            <option value="H">Hadir</option>
                            <option value="S">Sakit</option>
                            <option value="I">Izin</option>
                            <option value="A">Alfa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="keterangan_edit" id="keterangan" class="form-control" placeholder="Keterangan (kosongkan jika tidak diperlukan.)" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12">Rangkuman Materi</label>
                        <textarea class="form-control" rows="5" name="rangkuman_edit" id="rangkuman" placeholder="Rangkuman"></textarea>
                    </div>
                    <input type="hidden" name="hidden_edit" id="hidden_id" class="hidden_id-value">
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-primary btn-multiple-state" id="btn_update">
                        <div class="spinner d-inline-block">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                        <span class="icon success" data-toggle="tooltip" data-placement="top" title="Everything went right!">
                            <i class="simple-icon-check"></i>
                        </span>
                        <span class="icon fail" data-toggle="tooltip" data-placement="top" title="Something went wrong!">
                            <i class="simple-icon-exclamation"></i>
                        </span>
                        <span class="label">Done</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <!-- Beri id "modal-title" untuk tag span pada judul modal -->
                    <span id="exampleModalLabel"></span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
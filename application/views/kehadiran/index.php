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
            
            <form>
                <?php if ($data_kehadiran_master->num_rows() > 0) : ?>
                    <div id="show_input"></div>
                    <div id="show_input_hide">
                    <div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <button type="button" id="btn-simpan" class="btn btn-success"> SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php else : ?>
                    <span class="mb-2 badge badge-pill badge-danger d-inline-block">SEMUA MAHASISWA SUDAH MELAKUKAN ABSEN.</span>
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
                                    <input class="form-control" placeholder="Search Table" id="search_text" name="search_text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="show_data"></div>
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
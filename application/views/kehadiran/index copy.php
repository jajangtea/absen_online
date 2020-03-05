<div id="pesan-sukses" class="alert alert-success" style="margin: 10px 20px;"></div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card d-flex flex-row mb-3">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div
                        class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <h2>
                            Pertemuan <?php echo $this->session->userdata('pertemuanke') ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <form action="<?php echo site_url() . 'kehadiran/simpan_absen' ?>" method="post">
                <?php if ($data_kehadiran_master->num_rows() > 0): ?>
                <?php $index = 1; ?>
                <?php foreach ($data_kehadiran_master->result() as $data): ?>
                <div class="card d-flex flex-row mb-3">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div
                            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <input type="hidden" name="nim_mhs[]" value="<?=$data->nim; ?>" />
                            <input type="hidden" name="nama_mhs[]" value="<?=$data->nama_mhs; ?>" />
                            <input type="hidden" name="hidden_id[]"
                                value="<?=$this->session->userdata('hidden_id') ?>" />
                            <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                                <small> <span class="mb-2 badge badge-pill badge-danger"><?=$index++; ?></span></small>
                                <?=$data->nama_mhs; ?> <span
                                    class="mb-0 text-muted text-small w-15 w-xs-100"><?=$data->nim; ?></span>
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
                                <input type="text" name="keterangan[]" class="form-control mb-2"
                                    placeholder="Keterangan (Kosongkan jika tidak diperlukan.)">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="card d-flex flex-row mb-3">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div
                            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="">
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

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1>Data Kehadiran Pertemuan <?php echo $this->session->userdata('pertemuanke') ?> </h1>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                            role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse dont-collapse-sm" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input class="form-control" placeholder="Search Table" id="searchDatatable">
                                </div>
                            </div>
                            <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                                <span class="text-muted text-small">Displaying 1-10 of 40 items </span>
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    10
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">5</a>
                                    <a class="dropdown-item active" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <table id="datatableRows" class="data-table responsive" data-order="[[ 1, &quot;desc&quot; ]]">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>KETERANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php if ($data_kehadiran->num_rows() > 0): ?>
                            <?php $index = 1; ?>
                            <?php foreach ($data_kehadiran->result() as $data_hadir): ?>
                            <input type="hidden" class="nim-value" value="<?php echo $data_hadir->nim; ?>">
                            <tr>
                                <td>
                                    <p class="list-item-heading"><?=$data_hadir->nama_mhs; ?></p>
                                </td>
                                <td>
                                    <p class="text-muted"><?=$data_hadir->nim; ?></p>
                                </td>
                                <td>
                                    <p class="text-muted" id="z_absen"><span
                                            class="mb-2 badge badge-pill badge-success"><?=KehadiranModel::get_kehadiran($data_hadir->absen) . " ; " . $data_hadir->keterangan; ?></span>
                                    </p>
                                </td>
                                <td>
                                    <input type="hidden" id="nim-value" value="<?php echo $data_hadir->nim; ?>">
                                    <input type="hidden" id="nama_mhs-value" value="<?php echo $data_hadir->nama_mhs; ?>">
                                    <input type="hidden" id="absen-value"  value="<?php echo $data_hadir->absen; ?>">
                                    <input type="hidden" id="keterangan-value" value="<?php echo $data_hadir->keterangan; ?>">
                                    <button type="button" class="btn btn-primary btn-sm btn-block mb-1" id="btn-edit" data-toggle="modal" data-target="#form-modal"  data-id='<?php echo $data_hadir->nim; ?>'>EDIT</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="form-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        <!-- Beri id "modal-title" untuk tag span pada judul modal -->
                        <span id="modal-title"></span>
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- Beri id "pesan-error" untuk menampung pesan error -->
                    <div id="pesan-error" class="alert alert-danger"></div>

                    <form>
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" id="nim" name="input_nis" placeholder="NIS">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama_mhs" name="input_nama" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control mb-2" id="absen" name="input_absen">
                                <option value="H">Hadir</option>
                                <option value="S">Sakit</option>
                                <option value="I">Izin</option>
                                <option value="A">Alfa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="input_keterangan" placeholder="Keterangan">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- Beri id "loading-simpan" untuk loading ketika klik tombol simpan -->
                    <div id="loading-simpan" class="pull-left">
                        <b>Sedang menyimpan...</b>
                    </div>

                    <!-- Beri id "loading-ubah" untuk loading ketika klik tombol ubah -->
                    <div id="loading-ubah" class="pull-left">
                        <b>Sedang mengubah...</b>
                    </div>

                    <!-- Beri id "btn-simpan" untuk tombol simpan nya -->
                    <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>

                    <!-- Beri id "btn-ubah" untuk tombol simpan nya -->
                    <button type="button" class="btn btn-primary" id="btn-ubah">Ubah</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
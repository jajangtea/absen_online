
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <?php if ($this->session->flashdata('tambah')): ?>
                            <?php if ($this->session->flashdata('tambah') == true): ?>
                                <div class="alert alert-success">Berhasil menambahkan pengguna baru</div>
                            <?php elseif ($this->session->flashdata('tambah') == false): ?>
                                <div class="alert alert-danger">Gagal menambahkan pengguna baru</div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('hapus')): ?>
                            <?php if ($this->session->flashdata('hapus') == true): ?>
                                <div class="alert alert-success">Berhasil menghapus pengguna</div>
                            <?php elseif ($this->session->flashdata('hapus') == false): ?>
                                <div class="alert alert-danger">Gagal menghapus pengguna </div>
                            <?php endif; ?>
                        <?php endif; ?>
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
                    <div class="separator"></div>
                </div>
                  <div class="row">
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <table id="datatableRows" class="data-table responsive nowrap"
                        data-order="[[ 1, &quot;desc&quot; ]]">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">USERNAME</th>
                                    <th style="text-align: center;">NAMA</th>
                                    <th style="text-align: center;">ROLE</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($semua_data->num_rows() > 0): ?>
                                <?php foreach ($semua_data->result() as $pengguna): ?>
                                <tr>
                                        <td style="text-align: center;"><?=strtoupper($pengguna->username); ?></td>
                                        <td><?=strtoupper($pengguna->nama); ?></td>
                                        <td style="text-align: center;"><?=$pengguna->role; ?></td>
                                        <td style="text-align: center;">
                                        <a href="<?=base_url('index.php/pengguna/edit/' . $pengguna->id); ?>" class="btn btn-success">Edit</a>
                                        <a href="<?=base_url('index.php/pengguna/hapus/' . $pengguna->id); ?>" class="btn btn-danger">Hapus</a>
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
</div>

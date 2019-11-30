
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-header-light icon-button" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-refresh"></i>
                    </button>
                </div>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:7;text-align:center">No</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>Tgl.Lahir</th>
                                    <th>Umur</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($semua_data->num_rows() > 0): ?>
                                <?php $index = 1; ?>
                                <?php foreach ($semua_data->result() as $pengguna): ?>
                                <tr>
                                        <td style="text-align: center;"><?=$index++; ?></td>
                                        <td style="text-align: center;"><?=$pengguna->nama; ?></td>
                                        <td style="text-align: center;"><?=$pengguna->jenis_kelamin; ?></td>
                                        <td style="text-align: center;"><?=$pengguna->tanggal_lahir; ?></td>
                                        <td style="text-align: center;"><?=$pengguna->umur; ?></td>
                                        <td style="text-align: center;">
                                        <a href="<?=base_url('index.php/pengguna/edit/' . $pengguna->id); ?>" class="btn btn-default">Edit</a>
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

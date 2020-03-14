<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Pilih Jadwal</h5>
                    <form action="<?php echo site_url() . 'jadwal/cari' ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputState">Hari</label>
                                <select name="hari" class="form-control">
                                    <option value="1" selected>SENIN</option>
                                    <option value="2">SELASA</option>
                                    <option value="3">RABU</option>
                                    <option value="4">KAMIS</option>
                                    <option value="5">JUMAT</option>
                                    <option value="6">SABTU</option>
                                    <option value="7">MINGGU</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputState">Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="1" selected>GANJIL</option>
                                    <option value="2">GENAP</option>
                                    <option value="3">PENDEK</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputState">Program Studi</label>
                                <select class="form-control" name="prodi"">
                                    <?php
                                    foreach ($prodi  as $data_prodi) {
                                        echo '<option value="' . $data_prodi['kjur'] . '">' . $data_prodi['nama_prodi'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class=" form-group col-md-3">
                                    <label for="inputZip">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <?php
                                        foreach ($kelas  as $data_kelas) {
                                            echo '<option value="' . $data_kelas['idkelas'] . '">' . $data_kelas['nkelas'] . '</option>';
                                        }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <button type=" submit" class="btn btn-primary d-block mt-3">Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">

            <div class="row">
                <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <div class="table-responsive">
                        <table class="data-tables-pagination responsive nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
                            <thead>
                                <tr>
                                    <th>MATAKULIAH</th>
                                    <th style="text-align: center;">MASUK</th>
                                    <th style="text-align: center;">KELUAR</th>
                                    <th style="text-align: center;">JURUSAN</th>
                                    <th style="text-align: center;">KELAS</th>
                                    <th style="text-align: center;">RUANG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;?>
                                <?php foreach ($jadwal as $jadwal_mkul) : ?>
                                    <?php $no = 1;
                                    $str = $jadwal_mkul->kmatkul;
                                    $id = explode("_", $str);
                                    $kode = $id[1];
                                    ?>
                                    <tr>
                                        <td><?= $kode . ' ' .strtoupper($jadwal_mkul->nmatkul); ?></td>
                                        <td style="text-align: center;"><?=  strtoupper($jadwal_mkul->jam_masuk); ?></td>
                                        <td style="text-align: center;"><?= $jadwal_mkul->jam_keluar; ?></td>
                                        <td style="text-align: center;"><?= $jadwal_mkul->nama_ps; ?></td>
                                        <td style="text-align: center;"><?= JadwalModel::kelas_huruf($jadwal_mkul->nama_kelas); ?></td>
                                        <td style="text-align: center;"><?= $jadwal_mkul->namaruang; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
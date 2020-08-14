<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Pilih Jadwal</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Pilih Jadwal</h5>
                    <form action="<?php echo site_url() . 'kelas/cari' ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState">PRODI</label>
                                <select name="prodi" class="form-control">
                                    <option value="12" selected>TEKNIK INFORMATIKA</option>
                                    <option value="32">SISTEM INFORMASI</option>
                                    <option value="42">SISTEM INFORMASI KOENSETRASI AKUNTANSI</option>
                                </select>
                            </div>

                            <!-- <div class="form-group col-md-3">
                                <label for="inputState">Program Studi</label>
                                <select class="form-control" name="prodi"">
                                    <?php
                                    // foreach ($prodi  as $data_prodi) {
                                    //     echo '<option value="' . $data_prodi['kjur'] . '">' . $data_prodi['nama_prodi'] . '</option>';
                                    //}
                                    ?>
                                </select>
                            </div> -->
                            <div class=" form-group col-md-6">
                                <label for="inputZip">Kelas</label>
                                <select class="form-control" name="kelas">
                                    <?php
                                    foreach ($kelas as  $data_kelas) {
                                        echo '<option value="' . $data_kelas['idkelas'] . '">' . $data_kelas['nkelas'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-block mt-3">Tampilkan</button>
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
                                    <th>No</th>
                                    <th style="text-align: center;">NIM</th>
                                    <th style="text-align: center;">NAMA</th>
                                    <th style="text-align: center;">MATAKULIAH</th>
                                    <th style="text-align: center;">ATURAN</th>
                                    <th style="text-align: center;">PILIHAN MHS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($sql_kelas as $jadwal_mkul) : ?>

                                    <tr>
                                        <td style="text-align: center;"><?= $no++ ?></td>
                                        <td style="text-align: center;"><?= strtoupper($jadwal_mkul->nim); ?></td>
                                        <td style="text-align: left;"><?= $jadwal_mkul->nama_mhs; ?></td>
                                        <td style="text-align: left;"><?= $jadwal_mkul->nmatkul; ?></td>
                                        <td style="text-align: center;"><?= $jadwal_mkul->aturan; ?></td>
                                        <td style="text-align: center;"><?= $jadwal_mkul->pilihan; ?></td>
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
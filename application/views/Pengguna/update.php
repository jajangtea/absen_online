<div class="col-lg-12">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('pesan_register')) : ?>
                        <div class="alert alert-success rounded" role="alert">
                            <?php echo $this->session->flashdata('pesan_register') ?>
                        </div>
                    <?php endif ?>
                    <h4 class="card-title">Registrasi Dosen</h4>
                    <form action="<?php echo site_url() . 'user/signup' ?>" method="post">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="" value="<?= $pengguna->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" aria-describedby="helpId" placeholder="" value="<?= $pengguna->nama ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control" name="role" id="role" value="<?= $pengguna->role ?>">
                            <option <?php 
                                        if ( $pengguna->role ='Dosen' )
                                                echo "selected"; ?> value="1">
                                            <?= $dosen['nama_dosen'] ?> </option>
                                <option value="1">Dosen</option>
                                <option value="2">admin</option>
                            </select>

                            <div class="form-group">
                                <label for="">Dosen</label>
                                <select class="form-control" name="iddosen" id="">
                                    <?php
                                    foreach ($data_dosen  as $dosen) { ?>
                                        <option <?php 
                                        if ( $pengguna->iddosen ==$dosen['iddosen'] )
                                                echo "selected"; ?> value="<?php echo $dosen['iddosen'] ?>">
                                            <?= $dosen['nama_dosen'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
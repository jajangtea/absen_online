<header>
    <div class="title">
        <h3>Edit Pengguna</h3>
    </div>
    <div class="action">
        <button type="submit" form="edit-pengguna" class="btn btn-default">Simpan</button>
    </div>
</header>
<form action="<?php echo base_url('index.php/pengguna/ubah') ?>" method="post" id="edit-pengguna">
<div class="form-group">
  <label for="nama">Nama</label>
  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama"  value="<?=$pengguna->nama; ?>" aria-describedby="nama">
</div>

<div class="form-group">
  <label for="umur">Umur</label>
  <input type="text" name="umur" id="umur" class="form-control" placeholder="Masukan Umur" value="<?=$pengguna->umur; ?>"  aria-describedby="umur">
</div>

<div class="form-group">
  <label for="tanggal_lahir">Tanggal Lahir</label>
  <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukan Tanggal Lahir"value="<?=$pengguna->tanggal_lahir; ?>"  aria-describedby="tgl_lahir">
</div>

<div class="form-group">
  <label for="tanggal_lahir">Tanggal Lahir</label>
  <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Masukan Nama" value="<?=$pengguna->jenis_kelamin; ?>" aria-describedby="nama">
</div>
</form>
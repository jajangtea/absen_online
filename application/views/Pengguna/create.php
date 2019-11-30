<div class="header">
    <div class="title">
        <h1>Tambah Pengguna</h1>
    </div>
    
</div>
<?php echo validation_errors(); ?>
<form action="<?php echo base_url('index.php/pengguna/simpan') ?>" method="post" id="tambah-pengguna">
<div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama">
     </div>
     <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <label><input type="radio" name="jenis_kelamin" value="Lelaki"> Lelaki</label>
          <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
     </div>
     <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir">
     </div>
     <div class="form-group">
          <label for="umur">Umur</label>
          <input type="number" name="umur" id="umur">
     </div>
     <div class="action">
        <button type="submit" class="btn btn-danger">Save</button>
    </div>
</form>

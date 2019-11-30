<table class="table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($semua_buku->result() as $buku):?>
        <tr>
            <td><?= $buku->judul ?></td>
            <td><?= $buku->pengarang ?></td>
            <td><?= $buku->penerbit ?></td>
            <td><?= $buku->keterangan ?></td>
            <td> <a href="<?php echo base_url('index.php/buku/view/'.$buku->kode_buku)  ?>">Edit
            <a href="<?php echo base_url('index.php/buku/delete/'.$buku->kode_buku)  ?>">Hapus</td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
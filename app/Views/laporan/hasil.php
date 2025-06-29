<?= view('layouts/header') ?>

<h4>Laporan Transaksi dari <?= esc($tgl_awal) ?> sampai <?= esc($tgl_akhir) ?></h4>

<a href="<?= base_url('laporan/exportPdf?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir) ?>" class="btn btn-danger mb-3" target="_blank">
    Export PDF
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Jenis</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $t): ?>
        <tr>
            <td><?= esc($t['tanggal']) ?></td>
            <td><?= esc($t['nama_barang']) ?></td>
            <td><?= ucfirst(esc($t['jenis'])) ?></td>
            <td><?= esc($t['jumlah']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= view('layouts/footer') ?>

<?= view('layouts/header') ?>

<h4>Laporan Transaksi</h4>

<form action="<?= base_url('laporan/hasil') ?>" method="post" class="row mb-4">
    <div class="col-md-4">
        <label>Dari Tanggal</label>
        <input type="date" name="tgl_awal" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label>Sampai Tanggal</label>
        <input type="date" name="tgl_akhir" class="form-control" required>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100">Tampilkan</button>
    </div>
</form>

<?= view('layouts/footer') ?>

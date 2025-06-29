<?= view('layouts/header') ?>

<h4 class="mb-4">Transaksi Barang Masuk</h4>

<!-- Notifikasi Sukses -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Notifikasi Error -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                <li><?= esc($e) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Form Tambah Transaksi -->
<form method="post" action="<?= base_url('transaksi/masuk') ?>" class="mb-4">
    <div class="row">
        <div class="col-md-4 mb-2">
            <label for="id_barang">Barang</label>
            <select name="id_barang" id="id_barang" class="form-control" required>
                <option value="">Pilih Barang</option>
                <?php foreach($barang as $b): ?>
                    <option value="<?= esc($b['id']) ?>" <?= old('id_barang') == $b['id'] ? 'selected' : '' ?>>
                        <?= esc($b['nama_barang']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= old('jumlah') ?>" required>
        </div>
        <div class="col-md-3 mb-2">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= old('tanggal') ?>" required>
        </div>
        <div class="col-md-3 mb-2 d-grid">
            <label>&nbsp;</label>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<!-- Form Pencarian -->
<form method="get" action="<?= base_url('transaksi/masuk') ?>" class="row mb-4">
    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control" placeholder="Cari nama barang..." value="<?= esc($keyword ?? '') ?>">
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-secondary">Cari</button>
    </div>
</form>

<!-- Tabel Transaksi -->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($transaksi)): ?>
            <?php foreach($transaksi as $t): ?>
            <tr>
                <td><?= esc($t['tanggal']) ?></td>
                <td><?= esc($t['nama_barang']) ?></td>
                <td><?= esc($t['jumlah']) ?></td>
            </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Tidak ada data transaksi.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= view('layouts/footer') ?>

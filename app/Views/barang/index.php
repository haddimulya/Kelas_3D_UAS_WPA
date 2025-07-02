<?= view('layouts/header') ?>

<style>
.table img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
}
</style>

<h4 class="mb-4">Data Barang</h4>

<!-- ✅ Flash message -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- 🔍 Form Pencarian & Filter -->
<form method="get" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="keyword" value="<?= esc($keyword) ?>" class="form-control" placeholder="Cari nama barang...">
    </div>
    <div class="col-md-4">
        <select name="filter" class="form-select">
            <option value="">-- Semua Stok --</option>
            <option value="rendah" <?= $filter == 'rendah' ? 'selected' : '' ?>>Stok Rendah (&lt; 10)</option>
            <option value="tinggi" <?= $filter == 'tinggi' ? 'selected' : '' ?>>Stok Tinggi (&ge; 10)</option>
        </select>
    </div>
    <div class="col-md-4 d-flex">
        <button class="btn btn-primary me-2">Filter</button>
        <a href="<?= base_url('barang') ?>" class="btn btn-secondary">Reset</a>
    </div>
</form>

<a href="<?= base_url('barang/tambah') ?>" class="btn btn-success mb-3">+ Tambah Barang</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($barang)): ?>
        <tr>
            <td colspan="6" class="text-center">Data barang tidak ditemukan.</td>
        </tr>
        <?php else: ?>
            <?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>
            <?php foreach($barang as $b): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php if ($b['foto']): ?>
                        <img src="<?= base_url('uploads/' . $b['foto']) ?>" alt="foto">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= esc($b['nama_barang']) ?></td>
                <td><?= esc($b['deskripsi']) ?></td>
                <td><?= esc($b['stok']) ?></td>
                <td>
                    <a href="<?= base_url('barang/edit/' . $b['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('barang/hapus/' . $b['id']) ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<!-- 📄 Pagination -->
<div class="d-flex justify-content-center">
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>

<?= view('layouts/footer') ?>

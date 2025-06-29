<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">📚 Daftar Buku</h3>
  <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary btn-sm">⬅️ Dashboard</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
      <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun</th>
        <th>Stok</th>
        <?php if (session()->get('role') == 'admin'): ?>
          <th>Aksi</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($books as $buku): ?>
        <tr>
          <td><?= esc($buku['title']) ?></td>
          <td><?= esc($buku['author']) ?></td>
          <td><?= esc($buku['year']) ?></td>
          <td>
            <?= $buku['stock'] > 0 ? $buku['stock'] : '<span class="text-danger">Habis</span>' ?>
          </td>
          <?php if (session()->get('role') == 'admin'): ?>
            <td>
              <a href="<?= base_url('buku/edit/' . $buku['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="<?= base_url('buku/hapus/' . $buku['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php if (session()->get('role') == 'admin'): ?>
  <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary mt-3">➕ Tambah Buku</a>
<?php endif; ?>

<?= $this->endSection() ?>

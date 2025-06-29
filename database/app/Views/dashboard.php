<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">👋 Halo, <?= esc($user['name']) ?>!</h3>
<p class="text-muted mb-4">Anda login sebagai <strong><?= esc($user['role']) ?></strong></p>

<div class="row mb-4">
  <div class="col-md-4">
    <div class="card text-bg-primary shadow-sm">
      <div class="card-body">
        <h5 class="card-title">📚 Jumlah Jenis Buku</h5>
        <h2><?= $total_jenis_buku ?></h2>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-bg-success shadow-sm">
      <div class="card-body">
        <h5 class="card-title">🔢 Total Stok Buku</h5>
        <h2><?= $total_buku ?></h2>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-bg-warning shadow-sm">
      <div class="card-body">
        <h5 class="card-title">📥 Total Peminjaman</h5>
        <h2><?= $total_peminjaman ?></h2>
      </div>
    </div>
  </div>
</div>

<?php if ($user['role'] == 'admin'): ?>
  <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-outline-secondary">📋 Lihat Data Peminjaman</a>
<?php else: ?>
  <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-primary">📥 Pinjam Buku Sekarang</a>
<?php endif; ?>

<?= $this->endSection() ?>

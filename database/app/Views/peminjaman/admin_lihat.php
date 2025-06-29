<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">📋 Data Peminjaman Buku (Admin)</h4>

<a href="<?= base_url('dashboard') ?>" class="btn btn-secondary mb-3">⬅️ Kembali ke Dashboard</a>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form method="get" class="row g-3 mb-3">
  <div class="col-md-3">
    <label class="form-label">Tanggal Mulai</label>
    <input type="date" name="start" class="form-control" value="<?= esc($_GET['start'] ?? '') ?>">
  </div>
  <div class="col-md-3">
    <label class="form-label">Tanggal Akhir</label>
    <input type="date" name="end" class="form-control" value="<?= esc($_GET['end'] ?? '') ?>">
  </div>
  <div class="col-md-4">
    <label class="form-label">Cari Nama/Judul</label>
    <input type="text" name="q" class="form-control" placeholder="Cari..." value="<?= esc($_GET['q'] ?? '') ?>">
  </div>
  <div class="col-md-2 d-flex align-items-end">
    <button class="btn btn-primary w-100">🔍 Tampilkan</button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Nama Peminjam</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($peminjaman)): ?>
        <tr><td colspan="4" class="text-center">Belum ada data peminjaman.</td></tr>
      <?php else: ?>
        <?php foreach ($peminjaman as $p): ?>
          <tr class="<?= is_null($p['tanggal_kembali']) ? 'table-warning' : '' ?>">
            <td><?= esc($p['user_name']) ?></td>
            <td><?= esc($p['title']) ?></td>
            <td><?= esc($p['tanggal_pinjam']) ?></td>
            <td>
              <?= is_null($p['tanggal_kembali']) ? '<span class="text-danger">Belum kembali</span>' : esc($p['tanggal_kembali']) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php
  $totalPages = ceil($pager['total'] / $pager['perPage']);
  $currentPage = $pager['current'];
  $q = $pager['q'] ?? '';
  $start = $pager['start'] ?? '';
  $end = $pager['end'] ?? '';
  ?>

  <nav>
    <ul class="pagination justify-content-center">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>&start=<?= $start ?>&end=<?= $end ?>&q=<?= $q ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
  
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">📖 Riwayat Peminjaman Buku</h4>

<a href="<?= base_url('dashboard') ?>" class="btn btn-secondary mb-3">⬅️ Kembali ke Dashboard</a>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($riwayat)): ?>
        <tr><td colspan="4" class="text-center">Belum ada peminjaman.</td></tr>
      <?php else: ?>
        <?php foreach ($riwayat as $r): ?>
          <tr>
            <td><?= esc($r['title']) ?></td>
            <td><?= esc($r['tanggal_pinjam']) ?></td>
            <td><?= esc($r['tanggal_kembali'] ?? '-') ?></td>
            <td>
              <?php if (is_null($r['tanggal_kembali'])): ?>
                <a href="<?= base_url('peminjaman/kembalikan/' . $r['id']) ?>" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin mengembalikan?')">Kembalikan</a>
              <?php else: ?>
                <span class="text-muted">✔️ Selesai</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>

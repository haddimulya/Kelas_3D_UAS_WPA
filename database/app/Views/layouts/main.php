<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Aplikasi Peminjaman Buku' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 220px;
      background-color: #343a40;
      color: white;
      padding-top: 20px;
    }
    .sidebar a {
      color: #ccc;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
      color: #fff;
    }
    .main-content {
      margin-left: 230px;
      padding: 20px;
    }
  </style>
</head>
<body>

  <?php if (session()->get('logged_in')): ?>
    <div class="sidebar">
      <h5 class="text-center text-white">📚 Peminjaman</h5>
      <hr class="text-white">
      <a href="<?= base_url('dashboard') ?>">🏠 Dashboard</a>
      <a href="<?= base_url('buku') ?>">📖 Daftar Buku</a>
      <?php if (session()->get('role') == 'admin'): ?>
        <a href="<?= base_url('buku/tambah') ?>">➕ Tambah Buku</a>
        <a href="<?= base_url('admin/peminjaman') ?>">📋 Data Peminjaman</a>
        <a href="<?= base_url('admin/users') ?>">👥 Manajemen User</a>
      <?php else: ?>
        <a href="<?= base_url('peminjaman') ?>">📥 Pinjam Buku</a>
        <a href="<?= base_url('peminjaman/riwayat') ?>">📜 Riwayat Pinjam</a>
      <?php endif; ?>
      <a href="<?= base_url('logout') ?>" class="text-danger">🚪 Logout</a>
    </div>
  <?php endif; ?>

  <div class="<?= session()->get('logged_in') ? 'main-content' : 'container py-4' ?>">
    <?= $this->renderSection('content') ?>
  </div>

</body>
</html>

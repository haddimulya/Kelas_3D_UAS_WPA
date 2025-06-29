<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding: 15px;
            position: fixed;
            width: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column justify-content-between">
    <div>
        <h4 class="mb-4">📦 InOutStok</h4>
        <a href="<?= base_url('dashboard') ?>">🏠 Dashboard</a>
        <a href="<?= base_url('barang') ?>">📁 Data Barang</a>
        <a href="<?= base_url('transaksi/masuk') ?>">📥 Barang Masuk</a>
        <a href="<?= base_url('transaksi/keluar') ?>">📤 Barang Keluar</a>
        <a href="<?= base_url('laporan') ?>">📄 Laporan</a>
    </div>

    <div class="mt-4 pt-3 border-top">
        <button class="btn btn-sm btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal">
            🔒 Logout
        </button>
    </div>
</div>

<div class="content">

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari aplikasi?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Ya, Logout</a>
      </div>
    </div>
  </div>
</div>


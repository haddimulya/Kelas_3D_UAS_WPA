<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
  <div class="card-body">
    <h4 class="mb-4">➕ Tambah Buku</h4>

    <form action="<?= base_url('buku/simpan') ?>" method="post">
      <div class="mb-3">
        <label class="form-label">Judul Buku</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="author" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="year" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stok Buku</label>
        <input type="number" name="stock" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

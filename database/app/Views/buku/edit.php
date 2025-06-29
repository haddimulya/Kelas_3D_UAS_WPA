<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
  <div class="card-body">
    <h4 class="mb-4">✏️ Edit Buku</h4>

    <form action="<?= base_url('buku/update/' . $buku['id']) ?>" method="post">
      <div class="mb-3">
        <label class="form-label">Judul Buku</label>
        <input type="text" name="title" class="form-control" value="<?= esc($buku['title']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="author" class="form-control" value="<?= esc($buku['author']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="year" class="form-control" value="<?= esc($buku['year']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Stok Buku</label>
        <input type="number" name="stock" class="form-control" value="<?= esc($buku['stock']) ?>" required>
      </div>

      <button type="submit" class="btn btn-warning">Update</button>
      <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

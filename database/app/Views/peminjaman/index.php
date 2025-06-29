<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
  <div class="card-body">
    <h4 class="mb-4">📥 Peminjaman Buku</h4>

    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary mb-3">⬅️ Kembali ke Dashboard</a>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('peminjaman/simpan') ?>" method="post">
      <div class="mb-3">
        <label class="form-label">Pilih Buku</label>
        <select name="book_id" class="form-select" required>
          <option value="">-- Pilih Buku --</option>
          <?php foreach ($books as $buku): ?>
            <option value="<?= $buku['id'] ?>">
              <?= esc($buku['title']) ?> (Stok: <?= $buku['stock'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Pinjam Buku</button>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="mb-3 text-center">🔐 Login</h4>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
          Tidak punya akun? Baca Dibawah ini!</a>
        </p>

        <div class="alert alert-info mt-4">
          <strong>🔑 Info Login Sementara:</strong><br>
          <ul class="mb-0">
            <li><strong>Admin:</strong> Email <code>admin@mail.com</code> Password <code>adminbukupinjam</code></li>
            <li><strong>User:</strong> Email <code>user@mail.com</code> Password <code>user123456</code></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

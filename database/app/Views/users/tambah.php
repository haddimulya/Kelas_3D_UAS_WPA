<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">➕ Tambah User</h4>
<form action="<?= base_url('admin/users/simpan') ?>" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-select" required>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>
  </div>
  <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>

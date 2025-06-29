<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">✏️ Edit User</h4>
<form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password (biarkan kosong jika tidak diubah)</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-select" required>
      <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
      <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
    </select>
  </div>
  <button class="btn btn-success">Update</button>
</form>

<?= $this->endSection() ?>

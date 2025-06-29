<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">👥 Manajemen User</h4>
<a href="<?= base_url('admin/users/tambah') ?>" class="btn btn-primary mb-3">➕ Tambah User</a>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Email</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= esc($user['name']) ?></td>
        <td><?= esc($user['email']) ?></td>
        <td><?= esc($user['role']) ?></td>
        <td>
          <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="<?= base_url('admin/users/hapus/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?= $this->endSection() ?>

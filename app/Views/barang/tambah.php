<?= view('layouts/header') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<h4 class="mb-4">Tambah Barang</h4>

<form method="post" action="<?= base_url('barang/tambah') ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Foto (opsional)</label>
        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFoto(event)">
        <div class="mt-2">
            <img id="preview" src="#" alt="Preview Foto" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; display: none;">
        </div>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('barang') ?>" class="btn btn-secondary">Kembali</a>
</form>

<script>
    function previewFoto(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>

<?= view('layouts/footer') ?>

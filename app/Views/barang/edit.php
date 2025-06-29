<?= view('layouts/header') ?>

<form method="post" action="<?= base_url('barang/update/' . $barang['id']) ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"><?= $barang['deskripsi'] ?></textarea>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= $barang['stok'] ?>" required>
    </div>
    <div class="mb-3">
        <label>Ganti Foto (jika perlu)</label>
        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewFoto(event)">
        
        <!-- Preview Foto Lama -->
        <?php if ($barang['foto']): ?>
            <div class="mt-2">
                <small>Foto Saat Ini:</small><br>
                <img src="<?= base_url('uploads/' . $barang['foto']) ?>" 
                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px;">
            </div>
        <?php endif; ?>

        <!-- Preview Foto Baru -->
        <div class="mt-3">
            <small>Preview Foto Baru:</small><br>
            <img id="preview" src="" 
                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; display: none;">
        </div>
    </div>

    <button class="btn btn-primary">Update</button>
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
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>

<?= view('layouts/footer') ?>

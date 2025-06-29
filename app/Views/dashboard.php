<?= view('layouts/header') ?>
<h4>Dashboard</h4>
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h5>Total Barang</h5>
                <h3><?= $totalBarang ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h5>Total Stok</h5>
                <h3><?= $totalStok ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-info shadow-sm">
            <div class="card-body">
                <h5>Masuk Bulan Ini</h5>
                <h3><?= $masukBulanIni ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger shadow-sm">
            <div class="card-body">
                <h5>Keluar Bulan Ini</h5>
                <h3><?= $keluarBulanIni ?></h3>
            </div>
        </div>
    </div>
</div>
<?= view('layouts/footer') ?>

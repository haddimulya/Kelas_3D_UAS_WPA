<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 6px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .periode {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Laporan Transaksi</h2>
    <div class="periode">(<?= esc($tgl_awal) ?> sampai <?= esc($tgl_akhir) ?>)</div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($transaksi as $t): ?>
            <tr>
                <td><?= esc($t['tanggal']) ?></td>
                <td><?= esc($t['nama_barang']) ?></td>
                <td><?= ucfirst(esc($t['jenis'])) ?></td>
                <td><?= esc($t['jumlah']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>
</html>

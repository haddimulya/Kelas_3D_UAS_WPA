<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; padding: 6px; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">Laporan Data Peminjaman Buku</h3>
    <p style="text-align:center;">Periode: <?= date('d/m/Y', strtotime($start)) ?> - <?= date('d/m/Y', strtotime($end)) ?></p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peminjaman as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($p['user_name']) ?></td>
                <td><?= esc($p['title']) ?></td>
                <td><?= esc($p['tanggal_pinjam']) ?></td>
                <td><?= esc($p['tanggal_kembali'] ?? '-') ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>

<?php

namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $transaksiModel = new TransaksiModel();

        $totalBarang = $barangModel->countAll();
        $totalStok = $barangModel->selectSum('stok')->first()['stok'];

        $bulanIni = date('Y-m');
        $masukBulanIni = $transaksiModel
            ->where('jenis', 'masuk')
            ->like('tanggal', $bulanIni)
            ->countAllResults();

        $keluarBulanIni = $transaksiModel
            ->where('jenis', 'keluar')
            ->like('tanggal', $bulanIni)
            ->countAllResults();

        return view('dashboard', [
            'totalBarang' => $totalBarang,
            'totalStok' => $totalStok,
            'masukBulanIni' => $masukBulanIni,
            'keluarBulanIni' => $keluarBulanIni,
        ]);
    }
}

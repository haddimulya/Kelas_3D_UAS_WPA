<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan/index');
    }

    public function hasil()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $model = new TransaksiModel();
        $data['transaksi'] = $model
            ->select('transaksi.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi.id_barang')
            ->where('tanggal >=', $tgl_awal)
            ->where('tanggal <=', $tgl_akhir)
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        return view('laporan/hasil', $data);
    }

    public function exportPdf()
    {
        $tgl_awal = $this->request->getGet('tgl_awal');
        $tgl_akhir = $this->request->getGet('tgl_akhir');

        $model = new TransaksiModel();
        $data['transaksi'] = $model
            ->select('transaksi.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi.id_barang')
            ->where('tanggal >=', $tgl_awal)
            ->where('tanggal <=', $tgl_akhir)
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        $html = view('laporan/pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan-Transaksi.pdf', ['Attachment' => false]);
        exit;
    }
}

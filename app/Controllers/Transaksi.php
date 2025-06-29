<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\BarangModel;

class Transaksi extends BaseController
{
    protected $transaksi;
    protected $barang;

    public function __construct()
    {
        $this->transaksi = new TransaksiModel();
        $this->barang = new BarangModel();
    }

    public function masuk()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->transaksi
            ->where('jenis', 'masuk')
            ->getWithBarang(); // getWithBarang() harus bisa dipakai chaining

        if ($keyword) {
            $query->like('barang.nama_barang', $keyword);
        }

        $data['barang'] = $this->barang->findAll();
        $data['transaksi'] = $query->orderBy('tanggal', 'desc')->findAll();
        $data['keyword'] = $keyword;

        return view('transaksi/masuk', $data);
    }

    public function keluar()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->transaksi
            ->where('jenis', 'keluar')
            ->getWithBarang();

        if ($keyword) {
            $query->like('barang.nama_barang', $keyword);
        }

        $data['barang'] = $this->barang->findAll();
        $data['transaksi'] = $query->orderBy('tanggal', 'desc')->findAll();
        $data['keyword'] = $keyword;

        return view('transaksi/keluar', $data);
    }

    public function storeMasuk()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'id_barang' => 'required',
            'jumlah'    => 'required|numeric|greater_than[0]',
            'tanggal'   => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('transaksi/masuk'))
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $id_barang = $this->request->getPost('id_barang');
        $jumlah    = (int)$this->request->getPost('jumlah');
        $tanggal   = $this->request->getPost('tanggal');

        $this->transaksi->save([
            'id_barang' => $id_barang,
            'jenis'     => 'masuk',
            'jumlah'    => $jumlah,
            'tanggal'   => $tanggal,
        ]);

        // Update stok
        $barang = $this->barang->find($id_barang);
        $this->barang->update($id_barang, [
            'stok' => $barang['stok'] + $jumlah
        ]);

        return redirect()->to(base_url('transaksi/masuk'))->with('success', 'Transaksi barang masuk berhasil disimpan.');
    }

    public function storeKeluar()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'id_barang' => 'required',
            'jumlah'    => 'required|numeric|greater_than[0]',
            'tanggal'   => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('transaksi/keluar'))
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $id_barang = $this->request->getPost('id_barang');
        $jumlah    = (int)$this->request->getPost('jumlah');
        $tanggal   = $this->request->getPost('tanggal');

        $barang = $this->barang->find($id_barang);

        // Cek stok cukup
        if ($barang['stok'] < $jumlah) {
            return redirect()->to(base_url('transaksi/keluar'))
                ->withInput()
                ->with('error', 'Stok barang tidak mencukupi untuk transaksi ini.');
        }

        // Simpan transaksi keluar
        $this->transaksi->save([
            'id_barang' => $id_barang,
            'jenis'     => 'keluar',
            'jumlah'    => $jumlah,
            'tanggal'   => $tanggal,
        ]);

        // Kurangi stok
        $this->barang->update($id_barang, [
            'stok' => $barang['stok'] - $jumlah
        ]);

        return redirect()->to(base_url('transaksi/keluar'))->with('success', 'Transaksi barang keluar berhasil disimpan.');
    }
}

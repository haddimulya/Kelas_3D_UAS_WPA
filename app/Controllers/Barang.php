<?php

namespace App\Controllers;
use App\Models\BarangModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Barang extends BaseController
{
    protected $helpers = ['form', 'url', 'pager']; // ← pastikan ada 'pager'
    protected $barang;

    public function __construct()
    {
        $this->barang = new BarangModel();
    }

    // ✅ Halaman utama dengan search, filter, dan pagination
    public function index()
    {
        $model = $this->barang;

        $keyword = $this->request->getGet('keyword');
        $filterStok = $this->request->getGet('filter');

        $builder = $model;

        if ($keyword) {
            $builder = $builder->like('nama_barang', $keyword);
        }

        if ($filterStok == 'rendah') {
            $builder = $builder->where('stok <', 10);
        } elseif ($filterStok == 'tinggi') {
            $builder = $builder->where('stok >=', 10);
        }

        $data['barang']  = $builder->orderBy('id', 'DESC')->paginate(5);
        $data['pager']   = $builder->pager; // ✅ fix
        $data['keyword'] = $keyword;
        $data['filter']  = $filterStok;

        return view('barang/index', $data);
    }

    // ✅ Form tambah
    public function create()
    {
        return view('barang/tambah');
    }

    // ✅ Simpan data baru
    public function store()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'nama_barang' => 'required',
            'stok'        => 'required|integer',
        ])) {
            dd($validation->getErrors()); // tampilkan pesan validasi
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = '';

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();

            try {
                $foto->move('uploads/', $namaFoto);
            } catch (\Throwable $e) {
                dd('Gagal upload: ' . $e->getMessage());
            }
        }

        try {
            $this->barang->save([
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'stok'        => $this->request->getPost('stok'),
                'foto'        => $namaFoto
            ]);
        } catch (\Throwable $e) {
            dd('Gagal simpan ke database: ' . $e->getMessage());
        }

        return redirect()->to(base_url('barang'))->with('success', 'Barang berhasil ditambahkan.');
    }

    // ✅ Form edit
    public function edit($id)
    {
        $barang = $this->barang->find($id);
        if (!$barang) {
            throw PageNotFoundException::forPageNotFound("Barang dengan ID $id tidak ditemukan.");
        }

        $data['barang'] = $barang;
        return view('barang/edit', $data);
    }

    // ✅ Update data
    public function update($id)
    {
        // Validasi sederhana
        if (!$this->validate([
            'nama_barang' => 'required',
            'stok'        => 'required|integer',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $barang = $this->barang->find($id);
        if (!$barang) {
            throw PageNotFoundException::forPageNotFound("Barang dengan ID $id tidak ditemukan.");
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = $barang['foto'];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            if ($namaFoto && file_exists('uploads/' . $namaFoto)) {
                unlink('uploads/' . $namaFoto);
            }

            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/', $namaFoto);
        }

        $this->barang->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'stok'        => $this->request->getPost('stok'),
            'foto'        => $namaFoto
        ]);

        return redirect()->to(base_url('barang'))->with('success', 'Barang berhasil diperbarui.');
    }

    // ✅ Hapus data
    public function delete($id)
    {
        $barang = $this->barang->find($id);
        if (!$barang) {
            return redirect()->to(base_url('barang'))->with('error', 'Data tidak ditemukan.');
        }

        // Hapus foto jika ada
        if ($barang['foto'] && file_exists('uploads/' . $barang['foto'])) {
            unlink('uploads/' . $barang['foto']);
        }

        $this->barang->delete($id);
        return redirect()->to(base_url('barang'))->with('success', 'Barang berhasil dihapus.');
    }
}

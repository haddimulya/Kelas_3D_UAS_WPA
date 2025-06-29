<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $bukuModel = new BukuModel();
        $data['books'] = $bukuModel->findAll();

        return view('buku/index', $data);
    }

    public function tambah()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        return view('buku/tambah');
    }

    public function simpan()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $bukuModel = new \App\Models\BukuModel();

        $data = [
            'title'  => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'year'   => $this->request->getPost('year'),
            'stock'  => $this->request->getPost('stock')
        ];

        $bukuModel->insert($data);

        return redirect()->to('/buku')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $bukuModel = new \App\Models\BukuModel();
        $data['buku'] = $bukuModel->find($id);

        return view('buku/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $bukuModel = new \App\Models\BukuModel();

        $data = [
            'title'  => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'year'   => $this->request->getPost('year'),
            'stock'  => $this->request->getPost('stock')
        ];

        $bukuModel->update($id, $data);
        return redirect()->to('/buku')->with('success', 'Buku berhasil diperbarui');
    }

    public function hapus($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $bukuModel = new \App\Models\BukuModel();
        $bukuModel->delete($id);

        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus');
    }
}

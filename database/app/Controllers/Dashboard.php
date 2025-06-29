<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $bukuModel = new \App\Models\BukuModel();
        $pinjamModel = new \App\Models\PeminjamanModel();

        $data['user'] = $userModel->find(session()->get('user_id'));
        $data['total_jenis_buku'] = $bukuModel->countAll();
        $data['total_buku'] = $bukuModel->selectSum('stock')->first()['stock'];
        $data['total_peminjaman'] = $pinjamModel->countAll();

        return view('dashboard', $data);
    }
}

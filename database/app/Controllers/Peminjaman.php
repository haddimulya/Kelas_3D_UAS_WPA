<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use Dompdf\Dompdf;

class Peminjaman extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'user') {
            return redirect()->to('/dashboard');
        }

        $bukuModel = new BukuModel();
        $data['books'] = $bukuModel->where('stock >', 0)->findAll();

        return view('peminjaman/index', $data);
    }

    public function simpan()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'user') {
            return redirect()->to('/dashboard');
        }

        $bookId = $this->request->getPost('book_id');
        $userId = session()->get('user_id');

        $pinjamModel = new \App\Models\PeminjamanModel();
        $bukuModel = new \App\Models\BukuModel();

        // 🔒 Cek apakah user sudah meminjam buku ini dan belum dikembalikan
        $cek = $pinjamModel->where('user_id', $userId)
                        ->where('book_id', $bookId)
                        ->where('tanggal_kembali', null)
                        ->first();

        if ($cek) {
            return redirect()->to('/peminjaman')->with('error', 'Kamu sudah meminjam buku ini dan belum mengembalikannya.');
        }

        // 🔒 Cek stok buku
        $buku = $bukuModel->find($bookId);
        if ($buku['stock'] <= 0) {
            return redirect()->to('/peminjaman')->with('error', 'Stok buku ini sudah habis.');
        }

        // Simpan peminjaman
        $pinjamModel->insert([
            'user_id' => $userId,
            'book_id' => $bookId,
            'tanggal_pinjam' => date('Y-m-d')
        ]);

        // Kurangi stok
        $bukuModel->update($bookId, ['stock' => $buku['stock'] - 1]);

        return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dipinjam');
    }

    public function riwayat()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'user') {
            return redirect()->to('/dashboard');
        }

        $userId = session()->get('user_id');

        $db = \Config\Database::connect();
        $builder = $db->table('loans');
        $builder->select('loans.*, books.title');
        $builder->join('books', 'books.id = loans.book_id');
        $builder->where('loans.user_id', $userId);
        $query = $builder->get();

        $data['riwayat'] = $query->getResultArray();

        return view('peminjaman/riwayat', $data);
    }

    public function semua()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');
        $search = $this->request->getGet('q');

        $db = \Config\Database::connect();
        $builder = $db->table('loans');
        $builder->select('loans.*, books.title, users.name as user_name');
        $builder->join('books', 'books.id = loans.book_id');
        $builder->join('users', 'users.id = loans.user_id');

        if ($start && $end) {
            $builder->where('tanggal_pinjam >=', $start);
            $builder->where('tanggal_pinjam <=', $end);
        }

        if ($search) {
            $builder->groupStart()
                    ->like('books.title', $search)
                    ->orLike('users.name', $search)
                    ->groupEnd();
        }

        $builder->orderBy('loans.tanggal_pinjam', 'DESC');

        $data['peminjaman'] = $builder->get(10, ($this->request->getGet('page') ?? 1) * 10 - 10)->getResultArray();

        // pagination manual count
        $count = $builder->countAllResults(false);
        $data['pager'] = [
            'total' => $count,
            'perPage' => 10,
            'current' => $this->request->getGet('page') ?? 1,
            'start' => $start,
            'end' => $end,
            'q' => $search
        ];

        return view('peminjaman/admin_lihat', $data);
    }

    public function kembalikan($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'user') {
            return redirect()->to('/dashboard');
        }

        $pinjamModel = new \App\Models\PeminjamanModel();
        $bukuModel   = new \App\Models\BukuModel();

        // Cek data peminjaman
        $pinjam = $pinjamModel->find($id);

        // Hindari user mengembalikan milik orang lain
        if ($pinjam['user_id'] != session()->get('user_id')) {
            return redirect()->to('/peminjaman/riwayat');
        }

        // Update tanggal kembali
        $pinjamModel->update($id, ['tanggal_kembali' => date('Y-m-d')]);

        // Tambah stok buku
        $buku = $bukuModel->find($pinjam['book_id']);
        $bukuModel->update($buku['id'], ['stock' => $buku['stock'] + 1]);

        return redirect()->to('/peminjaman/riwayat')->with('success', 'Buku berhasil dikembalikan');
    }

    public function exportPdf()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard');
        }

        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        if (!$start || !$end) {
            return redirect()->to('/admin/peminjaman')->with('error', 'Tanggal tidak boleh kosong.');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('loans');
        $builder->select('loans.*, books.title, users.name as user_name');
        $builder->join('books', 'books.id = loans.book_id');
        $builder->join('users', 'users.id = loans.user_id');
        $builder->where('tanggal_pinjam >=', $start);
        $builder->where('tanggal_pinjam <=', $end);
        $data['peminjaman'] = $builder->get()->getResultArray();
        $data['start'] = $start;
        $data['end'] = $end;

        $html = view('peminjaman/pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_peminjaman_' . $start . '_sd_' . $end . '.pdf', ['Attachment' => false]);
    }
}

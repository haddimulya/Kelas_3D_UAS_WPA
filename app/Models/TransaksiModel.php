<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_barang', 'jenis', 'jumlah', 'tanggal'];

    // Method getWithBarang() sebagai query builder yang bisa chaining
    public function getWithBarang()
    {
        return $this->select('transaksi.*, barang.nama_barang')
                    ->join('barang', 'barang.id = transaksi.id_barang');
    }
}

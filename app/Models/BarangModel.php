<?php

namespace App\Models;
use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_barang', 'deskripsi', 'stok', 'foto'];

    // Tambahan untuk keamanan dan fleksibilitas
    protected $useTimestamps = true; // Jika tabelmu punya kolom created_at, updated_at
    protected $returnType    = 'array';

    // Pagination & searching support
    protected $useSoftDeletes = false;
}

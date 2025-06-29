<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table      = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'book_id', 'tanggal_pinjam', 'tanggal_kembali'];
}

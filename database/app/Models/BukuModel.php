<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'author', 'year', 'stock'];
}

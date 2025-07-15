<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    // Nama tabel di database
    protected $table            = 'kategori';
    
    // Primary key dari tabel
    protected $primaryKey       = 'id';
    
    // Mengaktifkan fitur auto-increment
    protected $useAutoIncrement = true;
    
    // Tipe data yang dikembalikan (object atau array)
    protected $returnType       = 'array';
    
    // Mengaktifkan "soft deletes" (data tidak benar-benar dihapus)
    protected $useSoftDeletes   = false;
    
    // Kolom yang diizinkan untuk diisi melalui form (mass assignment)
    protected $allowedFields    = ['nama_kategori'];

    // Mengaktifkan pencatatan waktu otomatis (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

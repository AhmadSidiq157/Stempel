<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    
    // Semua kolom yang bisa diisi dari form
    protected $allowedFields    = ['nama_produk', 'deskripsi', 'harga', 'gambar', 'kategori_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil semua data produk beserta nama kategorinya.
     * Menggunakan Query Builder untuk melakukan JOIN.
     *
     * @return array
     */
    public function getProdukWithKategori()
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = produk.kategori_id')
                    ->orderBy('produk.id', 'DESC')
                    ->findAll();
    }
}

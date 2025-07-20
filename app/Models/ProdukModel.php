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
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'kategori_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * PERUBAHAN DI SINI: Fungsi ini sekarang bisa menerima ID kategori
     * untuk memfilter hasil.
     */
    public function getProdukWithKategori($kategoriId = null)
    {
        $builder = $this->select('produk.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = produk.kategori_id', 'left');

        // Jika ada ID kategori yang diberikan, tambahkan kondisi WHERE
        if (!empty($kategoriId)) {
            $builder->where('produk.kategori_id', $kategoriId);
        }

        return $builder->orderBy('produk.created_at', 'DESC')->findAll();
    }
}

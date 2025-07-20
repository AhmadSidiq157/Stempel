<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    
    protected $protectFields    = false; 

    protected $allowedFields    = [
        'produk_id',
        'nama_pelanggan',
        'no_hp',
        'alamat',
        'jumlah',
        'total_harga',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /**
     * Mengambil semua pesanan dengan data produk terkait.
     */
    public function getPesananWithProduk()
    {
        return $this->select('pesanan.*, produk.nama_produk, produk.gambar')
            ->join('produk', 'produk.id = pesanan.produk_id', 'left')
            ->orderBy('pesanan.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Mengambil detail satu pesanan dengan info produk.
     */
    public function getDetailPesanan($id)
    {
        return $this->select('pesanan.*, produk.nama_produk, produk.gambar, produk.harga as harga_satuan')
            ->join('produk', 'produk.id = pesanan.produk_id', 'left')
            ->where('pesanan.id', $id)
            ->first();
    }
}

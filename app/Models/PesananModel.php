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

    protected $allowedFields    = [
        'nama_pemesan', 
        'no_telepon', 
        'alamat', 
        'produk_id', 
        'jumlah', 
        'total_harga', 
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil semua data pesanan beserta nama produk.
     *
     * @return array
     */
    public function getPesananWithProduk()
    {
        return $this->select('pesanan.*, produk.nama_produk')
                    ->join('produk', 'produk.id = pesanan.produk_id')
                    ->orderBy('pesanan.id', 'DESC')
                    ->findAll();
    }

    /**
     * Mengambil data pesanan berdasarkan ID, termasuk nama produk.
     *
     * @param int $id
     * @return array|null
     */
    public function getPesananWithProdukById($id)
    {
        return $this->select('pesanan.*, produk.nama_produk')
                    ->join('produk', 'produk.id = pesanan.produk_id')
                    ->where('pesanan.id', $id)
                    ->first();
    }
}

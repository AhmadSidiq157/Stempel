<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\PesananModel;
use App\Models\ProdukModel;

class DashboardController extends BaseController
{
    /**
     * Menampilkan halaman dashboard dengan data ringkasan.
     */
    public function index()
    {
        // Inisialisasi semua model yang dibutuhkan
        $kategoriModel = new KategoriModel();
        $produkModel   = new ProdukModel();
        $pesananModel  = new PesananModel();

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title'          => 'Dashboard Admin',
            'total_kategori' => $kategoriModel->countAllResults(),
            'total_produk'   => $produkModel->countAllResults(),
            'total_pesanan'  => $pesananModel->countAllResults(),
        ];

        // Memuat view dashboard dan mengirimkan data
        return view('admin/dashboard', $data);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PesananModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $pesananModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->produkModel = new ProdukModel();
        $this->pesananModel = new PesananModel();

        // Memuat helper
        helper(['form', 'url', 'text']);
    }

    public function index()
    {
        $data = [
            'title'  => 'Selamat Datang di Toko Stempel Kami',
            'produk' => $this->produkModel->getProdukWithKategori(),
            // Jika ingin tampilkan juga pesanan:
            // 'pesanan' => $this->pesananModel->getPesananWithProduk()
        ];
        
        return view('home_view', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel; // Pastikan ini ada di atas

class Home extends BaseController
{
    // Tidak perlu deklarasi properti di sini, kita akan buat instance langsung di method

    public function index()
    {
        // Buat instance dari model yang dibutuhkan
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        // Ambil ID kategori dari URL jika ada (misal: /?kategori=1)
        $kategoriId = $this->request->getGet('kategori');

        // Ambil semua kategori untuk ditampilkan sebagai tombol filter
        $semuaKategori = $kategoriModel->findAll();

        // Ambil produk, sudah difilter berdasarkan kategoriId jika ada
        $produk = $produkModel->getProdukWithKategori($kategoriId);
        
        // Siapkan data untuk dikirim ke view
        $data = [
            'title'          => 'Selamat Datang di Toko Stempel Kami',
            'produk'         => $produk,
            'kategori'       => $semuaKategori, // Kirim daftar kategori ke view
            'kategori_aktif' => $kategoriId,    // Kirim ID kategori yang sedang aktif
        ];

        return view('home_view', $data);
    }
}

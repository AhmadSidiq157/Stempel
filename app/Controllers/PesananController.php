<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PesananModel;

class PesananController extends BaseController
{
    protected $produkModel;
    protected $pesananModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->pesananModel = new PesananModel();
        helper(['form', 'url']);
    }

    public function index($produk_id = null)
    {
        $produk = $this->produkModel->find($produk_id);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Produk tidak ditemukan.');
        }

        $data = [
            'title'  => 'Form Pemesanan: ' . $produk['nama_produk'],
            'produk' => $produk,
        ];

        return view('pesan_view', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama_pelanggan' => 'required|min_length[3]',
            'no_hp'          => 'required|numeric|min_length[8]',
            'alamat'         => 'required|min_length[8]',
            'jumlah'         => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $hargaProduk = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $totalHarga = (float) $hargaProduk * (int) $jumlah;

        
        $dataToSave = [
            'produk_id'      => $this->request->getPost('produk_id'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'alamat'         => $this->request->getPost('alamat'),
            'jumlah'         => $jumlah,
            'total_harga'    => $totalHarga,
            'status'         => 'Baru', 
        ];

        $this->pesananModel->save($dataToSave);

        return redirect()->to('/')->with('success', 'Pesanan Anda berhasil dibuat! Kami akan segera menghubungi Anda.');
    }
}

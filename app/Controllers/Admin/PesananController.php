<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\ProdukModel;

class PesananController extends BaseController
{
    protected $pesananModel;
    protected $produkModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->produkModel  = new ProdukModel();
    }

    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $data = [
            'title'   => 'Manajemen Pesanan',
            'pesanan' => $this->pesananModel->getPesananWithProduk(),
        ];
        return view('admin/pesanan/index', $data);
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     */
    public function create()
    {
        $data = [
            'title'  => 'Buat Pesanan Manual',
            'produk' => $this->produkModel->findAll(),
        ];
        return view('admin/pesanan/create', $data);
    }

    /**
     * Menyimpan data pesanan baru dari form.
     */
    public function store()
    {
        // Aturan validasi
        $rules = [
            'nama_pemesan' => 'required',
            'no_telepon'   => 'required',
            'alamat'       => 'required',
            'produk_id'    => 'required|integer',
            'jumlah'       => 'required|integer|greater_than[0]',
            'total_harga'  => 'required|numeric',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data
        $this->pesananModel->save([
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'no_telepon'   => $this->request->getPost('no_telepon'),
            'alamat'       => $this->request->getPost('alamat'),
            'produk_id'    => $this->request->getPost('produk_id'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'total_harga'  => $this->request->getPost('total_harga'),
            'status'       => 'pending',
        ]);

        return redirect()->to('/admin/pesanan')->with('success', 'Pesanan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pesanan.
     */
    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Pesanan',
            'pesanan'  => $this->pesananModel->getPesananWithProdukById($id),
            'statuses' => ['pending', 'diproses', 'selesai', 'dibatalkan'],
        ];

        if (empty($data['pesanan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan dengan ID ' . $id . ' tidak ditemukan.');
        }

        return view('admin/pesanan/edit', $data);
    }

    /**
     * Memperbarui data pesanan di database.
     */
    public function update($id)
    {
        // Aturan validasi (hanya untuk status)
        $rules = [
            'status' => 'required|in_list[pending,diproses,selesai,dibatalkan]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pesananModel->update($id, [
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/pesanan')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus data pesanan dari database.
     */
    public function delete($id)
    {
        $this->pesananModel->delete($id);
        return redirect()->to('/admin/pesanan')->with('success', 'Data pesanan berhasil dihapus.');
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $data = [
            'title'    => 'Manajemen Kategori',
            'kategori' => $this->kategoriModel->orderBy('id', 'DESC')->findAll(),
        ];
        return view('admin/kategori/index', $data);
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori Baru',
        ];
        return view('admin/kategori/create', $data);
    }

    /**
     * Menyimpan data kategori baru ke database.
     */
    public function store()
    {
        // Aturan validasi
        $rules = [
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);

        return redirect()->to('/admin/kategori')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Kategori',
            'kategori' => $this->kategoriModel->find($id),
        ];

        // Jika data tidak ditemukan, tampilkan error 404
        if (empty($data['kategori'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }

        return view('admin/kategori/edit', $data);
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update($id)
    {
        // Aturan validasi (is_unique dengan pengecualian ID saat ini)
        $rules = [
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori,id,' . $id . ']',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data
        $this->kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);

        return redirect()->to('/admin/kategori')->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Menghapus data kategori dari database.
     */
    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/admin/kategori')->with('success', 'Data kategori berhasil dihapus.');
    }
}

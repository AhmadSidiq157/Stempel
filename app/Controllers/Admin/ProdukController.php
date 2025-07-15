<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class ProdukController extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel   = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    /**
     * Menampilkan daftar semua produk.
     */
    public function index()
    {
        $data = [
            'title'  => 'Manajemen Produk',
            'produk' => $this->produkModel->getProdukWithKategori(),
        ];
        return view('admin/produk/index', $data);
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $data = [
            'title'    => 'Tambah Produk Baru',
            'kategori' => $this->kategoriModel->findAll(),
        ];
        return view('admin/produk/create', $data);
    }

    /**
     * Menyimpan data produk baru ke database.
     */
    public function store()
    {
        // Aturan validasi
        $rules = [
            'nama_produk' => 'required',
            'kategori_id' => 'required|integer',
            'harga'       => 'required|numeric',
            'gambar'      => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proses unggah gambar
        $gambar     = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move(WRITEPATH . 'uploads/produk', $namaGambar);

        // Simpan data
        $this->produkModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'gambar'      => $namaGambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Produk',
            'produk'   => $this->produkModel->find($id),
            'kategori' => $this->kategoriModel->findAll(),
        ];

        if (empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk dengan ID ' . $id . ' tidak ditemukan.');
        }

        return view('admin/produk/edit', $data);
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update($id)
    {
        // Aturan validasi
        $rules = [
            'nama_produk' => 'required',
            'kategori_id' => 'required|integer',
            'harga'       => 'required|numeric',
        ];

        // Validasi gambar hanya jika ada file baru yang diunggah
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && ! $gambar->hasMoved()) {
            $rules['gambar'] = 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToUpdate = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'kategori_id' => $this->request->getPost('kategori_id'),
        ];

        // Jika ada gambar baru, proses unggah dan hapus yang lama
        if ($gambar->isValid() && ! $gambar->hasMoved()) {
            $produkLama = $this->produkModel->find($id);
            if ($produkLama && file_exists(WRITEPATH . 'uploads/produk/' . $produkLama['gambar'])) {
                unlink(WRITEPATH . 'uploads/produk/' . $produkLama['gambar']);
            }

            $namaGambarBaru = $gambar->getRandomName();
            $gambar->move(WRITEPATH . 'uploads/produk', $namaGambarBaru);
            $dataToUpdate['gambar'] = $namaGambarBaru;
        }

        $this->produkModel->update($id, $dataToUpdate);

        return redirect()->to('/admin/produk')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus data produk dari database.
     */
    public function delete($id)
    {
        // Cari data produk untuk mendapatkan nama file gambar
        $produk = $this->produkModel->find($id);
        if ($produk) {
            // Hapus file gambar dari server
            $pathGambar = WRITEPATH . 'uploads/produk/' . $produk['gambar'];
            if (file_exists($pathGambar)) {
                unlink($pathGambar);
            }
            // Hapus data dari database
            $this->produkModel->delete($id);
            return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus.');
        }

        return redirect()->to('/admin/produk')->with('error', 'Gagal menghapus, produk tidak ditemukan.');
    }
}

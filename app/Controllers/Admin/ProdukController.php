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

    public function index()
    {
        $data = [
            'title'  => 'Manajemen Produk',
            'produk' => $this->produkModel->getProdukWithKategori(),
        ];
        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $data = [
            'title'    => 'Tambah Produk Baru',
            'kategori' => $this->kategoriModel->findAll(),
        ];
        return view('admin/produk/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_produk' => 'required',
            'kategori_id' => 'required|integer',
            'harga'       => 'required|numeric',
            'gambar'      => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar     = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move(FCPATH . 'uploads/produk', $namaGambar); // ← Disimpan ke public/uploads/produk

        $this->produkModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'gambar'      => $namaGambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Produk',
            'produk'   => $this->produkModel->find($id),
            'kategori' => $this->kategoriModel->findAll(),
        ];

        if (empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan.");
        }

        return view('admin/produk/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_produk' => 'required',
            'kategori_id' => 'required|integer',
            'harga'       => 'required|numeric',
        ];

        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && ! $gambar->hasMoved()) {
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

        // Proses upload gambar baru (jika ada)
        if ($gambar && $gambar->isValid() && ! $gambar->hasMoved()) {
            $produkLama = $this->produkModel->find($id);
            if ($produkLama && !empty($produkLama['gambar'])) {
                $oldPath = FCPATH . 'uploads/produk/' . $produkLama['gambar'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $namaGambarBaru = $gambar->getRandomName();
            $gambar->move(FCPATH . 'uploads/produk', $namaGambarBaru);
            $dataToUpdate['gambar'] = $namaGambarBaru;
        }

        $this->produkModel->update($id, $dataToUpdate);

        return redirect()->to('/admin/produk')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk) {
            $pathGambar = FCPATH . 'uploads/produk/' . $produk['gambar'];
            if (file_exists($pathGambar)) {
                unlink($pathGambar);
            }

            $this->produkModel->delete($id);
            return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus.');
        }

        return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan.');
    }
}

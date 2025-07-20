<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class PesananController extends BaseController
{
    protected $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        helper(['text', 'number']);
    }

    /**
     * Menampilkan daftar semua pesanan yang masuk.
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
     * Menampilkan detail satu pesanan.
     */
    public function detail($id)
    {
        $pesanan = $this->pesananModel->getDetailPesanan($id);

        if (empty($pesanan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Detail Pesanan #' . $pesanan['id'],
            'pesanan' => $pesanan,
        ];
        return view('admin/pesanan/detail', $data);
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        if (empty($status)) {
            return redirect()->back()->with('error', 'Status tidak boleh kosong.');
        }

        $this->pesananModel->update($id, ['status' => $status]);

        return redirect()->to('admin/pesanan/detail/' . $id)->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan.
     */
    public function delete($id)
    {
        if ($this->pesananModel->delete($id)) {
            return redirect()->to('admin/pesanan')->with('success', 'Pesanan berhasil dihapus.');
        }
        return redirect()->to('admin/pesanan')->with('error', 'Gagal menghapus pesanan.');
    }
}

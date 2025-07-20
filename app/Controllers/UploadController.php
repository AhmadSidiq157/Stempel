<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Controller ini bertugas untuk menampilkan file dari direktori 'writable/uploads'
 * yang secara default tidak dapat diakses oleh publik. Ini adalah praktik keamanan
 * yang baik untuk mencegah eksekusi skrip atau akses langsung ke file yang diunggah.
 */
class UploadController extends BaseController
{
    /**
     * Menampilkan file gambar berdasarkan folder dan nama file.
     *
     * @param string $folder   Nama sub-folder di dalam 'writable/uploads' (misal: 'produk')
     * @param string $filename Nama file yang akan ditampilkan (misal: 'gambar.jpg')
     */
    public function show(string $folder, string $filename)
    {
        // Membersihkan input untuk mencegah serangan Path Traversal
        $folder   = basename($folder);
        $filename = basename($filename);

        // Membangun path lengkap ke file
        $path = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename;

        // Periksa apakah file benar-benar ada dan merupakan file (bukan direktori)
        if (! is_file($path)) {
            // Jika tidak ada, tampilkan halaman error 404 standar CodeIgniter
            throw PageNotFoundException::forPageNotFound("File tidak ditemukan: {$filename}");
        }

        // Dapatkan tipe MIME dari file untuk header Content-Type yang benar
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $type  = $finfo->file($path);

        // Mengatur header HTTP agar browser tahu cara menampilkan file ini
        header("Content-Type: {$type}");
        header("Content-Length: " . filesize($path));

        // Membaca dan mengirimkan isi file ke browser, lalu hentikan eksekusi
        readfile($path);
        exit();
    }
}
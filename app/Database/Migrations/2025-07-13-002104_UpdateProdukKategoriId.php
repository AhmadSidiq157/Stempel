<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateProdukKategoriId extends Migration
{
    /**
     * Method up() untuk mengubah struktur tabel.
     * Skenario: Menghapus kolom 'kategori_enum' lama dan menambahkan 'kategori_id' baru.
     */
    public function up()
    {
        // Hapus kolom lama jika ada (misalnya bernama 'kategori_enum')
        // $this->forge->dropColumn('produk', 'kategori_enum');

        // Tambahkan kolom baru untuk foreign key
        $fields = [
            'kategori_id_new' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'gambar' // Menempatkan kolom setelah kolom 'gambar'
            ],
        ];
        $this->forge->addColumn('produk', $fields);

        // Tambahkan foreign key constraint ke kolom baru
        // $this->forge->addForeignKey('kategori_id_new', 'kategori', 'id', 'CASCADE', 'CASCADE');
        
        // Catatan: Kode di atas sebagian besar adalah contoh.
        // Dalam praktiknya, Anda perlu menangani pemindahan data dari kolom lama ke kolom baru
        // sebelum menghapus kolom lama.
    }

    /**
     * Method down() untuk mengembalikan perubahan jika di-rollback.
     */
    public function down()
    {
        // Hapus foreign key terlebih dahulu jika ada
        // $this->forge->dropForeignKey('produk', 'produk_kategori_id_new_foreign');

        // Hapus kolom yang baru ditambahkan
        $this->forge->dropColumn('produk', 'kategori_id_new');

        // Tambahkan kembali kolom enum lama (jika perlu)
        /*
        $fields = [
            'kategori_enum' => [
                'type' => 'ENUM("A","B","C")',
                'null' => false,
            ],
        ];
        $this->forge->addColumn('produk', $fields);
        */
    }
}

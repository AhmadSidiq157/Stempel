<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePesananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pemesan' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'produk_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // PERBAIKAN: Kolom ini diizinkan untuk bernilai NULL
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'diproses', 'selesai', 'dibatalkan'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pesanan');
    }
}

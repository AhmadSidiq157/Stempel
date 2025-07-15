<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('password123', PASSWORD_DEFAULT) // Passwordnya: password123
        ];

        // Simple Queries
        $this->db->table('users')->insert($data);
    }
}

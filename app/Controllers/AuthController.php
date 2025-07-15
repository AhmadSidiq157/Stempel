<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        // Jika pengguna sudah login, langsung arahkan ke dashboard.
        if (session()->get('isLoggedIn')) {
            return redirect()->to('admin');
        }

        return view('login_view', ['title' => 'Admin Login']);
    }

    /**
     * Memproses upaya login dari form.
     */
    public function attemptLogin()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            $session->setFlashdata('msg', 'Username dan Password wajib diisi.');
            return redirect()->to('login');
        }

        // Cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        // Jika user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            // Set data session
            $login_data = [
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'isLoggedIn' => true,
            ];
            $session->set($login_data);

            // Arahkan ke dashboard admin
            return redirect()->to('admin');
        }

        // Jika login gagal
        $session->setFlashdata('msg', 'Username atau Password Salah');
        return redirect()->to('login');
    }

    /**
     * Memproses logout.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}

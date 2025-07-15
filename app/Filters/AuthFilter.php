<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * This method is called before a controller is executed.
     * It checks if the user is logged in. If not, it redirects
     * them to the login page.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isLoggedIn' tidak ada atau bernilai false
        if (! session()->get('isLoggedIn')) {
            // Jika tidak login, alihkan ke halaman /login
            return redirect()->to('/login');
        }
    }

    /**
     * This method is called after a controller is executed.
     * We don't have anything to do here for this filter.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi yang perlu dilakukan setelah controller dijalankan.
    }
}

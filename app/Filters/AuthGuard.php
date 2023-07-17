<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/user/login');
        }
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        // TODO: Implement before() method.
    }
}
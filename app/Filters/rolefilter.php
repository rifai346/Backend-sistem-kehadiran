<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\JWTLib;
use App\Models\UserModel;

class rolefilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Mendapatkan token dari header
        $token = $request->getHeader('Authorization') ? $request->getHeader('Authorization')->getValue() : null;

        if (!$token) {
            return Services::response()->setStatusCode(401, 'Token is required');
        }

        // Verifikasi token
        $jwt = new JWTLib();
        try {
            $decoded = $jwt->decode($token);
        } catch (\Exception $e) {
            return Services::response()->setStatusCode(401, 'Invalid token');
        }

        // Cek role pengguna
        $userModel = new UserModel();
        $user = $userModel->find($decoded->user_id);
        
        if (!$user || !in_array($user['role'], $arguments)) {
            return Services::response()->setStatusCode(403, 'Access denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada proses setelah request
    }
}

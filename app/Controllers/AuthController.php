<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Libraries\JWTLib;
use CodeIgniter\Controller;

class AuthController extends ResourceController
{
    public function login()
{
    $json = $this->request->getJSON();
    
    // Validasi input
    if (!$json || !isset($json->email) || !isset($json->password)) {
        return $this->fail('Bad Request', 400);
    }

    // Cek kredensial
    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('email', $json->email)->first();

    if (!$user || !password_verify($json->password, $user['password'])) {
        return $this->failUnauthorized('Invalid credentials');
    }

    // Generate token
    $jwt = new JWTLib();
    $token = $jwt->encode([
        'user_id' => $user['id'],
        'exp' => time() + 3600
    ]);

    // Response yang lebih lengkap
    return $this->respond([
        'status' => 200,
        'token' => $token,
        'user_id' => $user['id'],
        'email' => $user['email']
        // Tambahkan field lain jika diperlukan
    ]);
}

    public function logout()
    {
        // Handle OPTIONS request for CORS preflight
        if ($this->request->getMethod() === 'options') {
            return $this->response->setStatusCode(200);
        }

        return $this->respond([
            'status' => 200,
            'message' => 'Logout berhasil'
        ])->setHeader('Access-Control-Allow-Origin', '*');
    }
   
}

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
        'email' => $user['email'],
        'user' => [
            'id' => $user['id'], // pastikan kolom ini ada
            'email' => $user['email'],
            'role' => $user['role'] 
            ] // pastik
            // Tambahkan field lain jika diperlukan
        ]);
    
}

public function register()
    {
        try {
            $json = $this->request->getJSON(true);  // Tambahkan true untuk mengembalikan array
            
            // Validasi input
            if (!$json || empty($json['email']) || empty($json['password']) || empty($json['role'])) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Bad Request: Missing required fields'
                ], 400);
            }
            
            $userModel = new UserModel();
    
            // Cek jika email sudah digunakan
            if ($userModel->where('email', $json['email'])->first()) {
                return $this->respond([
                    'status' => 409,
                    'message' => 'Email already in use'
                ], 409);
            }
    
            // Hash password
            $hashedPassword = password_hash($json['password'], PASSWORD_BCRYPT);
    
            // Simpan pengguna baru
            $userData = [
                'email' => $json['email'],
                'password' => $hashedPassword,
                'role' => $json['role']
            ];
    
            $userModel->insert($userData);
    
            // Buat respons sukses
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Registration successful',
                'user' => [
                    'id' => $userModel->getInsertID(),
                    'email' => $json['email']
                ]
            ]);
            
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
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

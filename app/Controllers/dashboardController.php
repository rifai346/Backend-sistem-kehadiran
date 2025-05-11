<?php

namespace App\Controllers;

use App\Libraries\JWTLib;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    protected $jwt;

    public function __construct()
    {
        $this->jwt = new JWTLib();
    }

    // Endpoint yang diproteksi
    public function index()
    {
        $authHeader = $this->request->getHeader('Authorization');
        
        if ($authHeader) {
            $token = str_replace('Bearer ', '', $authHeader);
            $decoded = $this->jwt->decode($token);

            if ($decoded) {
                // Token valid, lanjutkan dengan proses
                return view('dashboard');
            } else {
                return $this->failUnauthorized('Token tidak valid');
            }
        } else {
            return $this->failUnauthorized('Authorization header tidak ditemukan');
        }
    }
}

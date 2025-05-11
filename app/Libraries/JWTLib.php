<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTLib
{
    protected $key = 'rahasia_super_amannn'; // Ganti sesuai kebutuhan

    public function encode($payload)
    {
        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function decode($token)
    {
        try {
            return (array) JWT::decode($token, new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}

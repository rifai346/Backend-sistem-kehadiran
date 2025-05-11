<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';  // Nama tabel user di database
    protected $primaryKey = 'id';  // Primary key

    protected $allowedFields = ['email', 'password', 'role'];  // Kolom yang bisa diubah

    // Fungsi untuk mencari user berdasarkan email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}

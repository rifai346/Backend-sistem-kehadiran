<?php
namespace App\Models;

use CodeIgneter\Model;
use Exception;

class Modelotentikasi extends Model{
    protected $table = "otentikasi";
    protected $primarykey = "id";
    protected $allowedFields = ['email', 'password'];

    function getEmail ($email)
    {
        $builder = $this->table("authentikasi");
        $data = $builder->where("email", $email)->first();
        if (!$data){
            throw new Exception("Data otentikasi tidak ditemukan");
        }
        return $data;
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class Dosen extends Model
{
    protected $table            = 'tb_dosen';
    protected $primaryKey       = 'id_dosen';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_dosen'];

    public function getAllDosen(){
        return $this->findAll();
    }

    public function getDosenById($id){
        return $this->find($id);
    }

    public function tambahDosen($data)
    {
        return $this->insert($data);
    }

    public function updateDosen($id, $data){
        return $this->update($id, $data);
    }

    public function hapusDosen($id){
        return $this->delete($id);
    }
}

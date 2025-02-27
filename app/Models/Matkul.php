<?php

namespace App\Models;

use CodeIgniter\Model;

class Matkul extends Model
{
    protected $table            = 'tb_matkul';
    protected $primaryKey       = 'id_matkul';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_matkul','sks','semester'];

    public function getAllMatkul(){
        return $this->findAll();
    }

    public function getMatkulById($id){
        return $this->find($id);
    }

    public function tambahMatkul($data)
    {
        return $this->insert($data);
    }

    public function updateMatkul($id, $data){
        return $this->update($id, $data);
    }

    public function hapusMatkul($id){
        return $this->delete($id);
    }
}

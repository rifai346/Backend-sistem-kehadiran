<?php

namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa extends Model
{
    protected $table            = 'tb_mahasiswa';
    protected $primaryKey       = 'npm';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_mahasiswa','nama_matkul','jurusan','prodi','tahun_akademik'];

    public function getAllMahasiswa(){
        return $this->findAll();
    }

    public function getMahasiswaById($id){
        return $this->find($id);
    }

    public function tambahMahasiswa($data)
    {
        return $this->insert($data);
    }

    public function updateMahasiswa($id, $data){
        return $this->update($id, $data);
    }

    public function hapusMahasiswa($id){
        return $this->delete($id);
    }
}

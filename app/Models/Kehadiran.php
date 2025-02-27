<?php

namespace App\Models;

use CodeIgniter\Model;

class Kehadiran extends Model
{
    protected $table            = 'kehadiran';
    protected $primaryKey       = 'id_kehadiran';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_mahasiswa','id_matakuliah','id_dosen','tanggal','status'];

    public function getAllKehadiran(){
        return $this->findAll();
    }

    public function getKehadiranById($id){
        return $this->find($id);
    }

    public function tambahkehadiran($data)
    {
        return $this->insert($data);
    }

    public function updateKehadiran($id, $data){
        return $this->update($id, $data);
    }

    public function hapusKehadiran($id){
        return $this->delete($id);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi extends Model
{
    protected $table            = 'tb_absensi';
    protected $primaryKey       = 'id_kehadiran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['npm','id_dosen','id_matkul','pertemuan','keterangan'];

    public function getAllAbsensi(){
        return $this->findAll();
    }

    public function getAbsensiById($id){
        return $this->find($id);
    }

    public function tambahAbsensi($data)
    {
        return $this->insert($data);
    }

    public function updateAbsensi($id, $data){
        return $this->update($id, $data);
    }

    public function hapusAbsensi($id){
        return $this->delete($id);
    }
}

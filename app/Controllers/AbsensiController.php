<?php

namespace App\Controllers;

use App\Models\Absensi;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AbsensiController extends ResourceController
{

    protected $model;

    public function __construct()
    {
        $this ->model = new Absensi();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this ->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = $this->model->getAbsensiById($id);
        if ($data){
        return $this->respond($data);
        }else{
            return $this->failNotFound('Data Absesnsi tidak ditemukan');
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'npm' => 'required|numeric',
            'id_dosen'=> 'required|numeric',
            'id_matkul'=> 'required|numeric',
            'pertemuan'=> 'required|in_list[1,2,3,4,5]',
            'keterangan'=> 'required|in_list[H,S,I,A]',

        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'npm' => $this->request->getVar('npm'),
            'id_dosen' => $this->request->getVar('id_dosen'),
            'id_matkul' => $this->request->getVar('id_matkul'),
            'pertemuan' => $this->request->getVar('pertemuan'),
            'keterangan' => $this->request->getVar('keterangan')
        ];
    
            $this->model->tambahAbsensi($data);
            return $this->respondCreated(['message'=>'Data kehadiran berhasil ditambahkan']);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $rules = [
            'npm' => 'required|numeric',
            'id_dosen'=> 'required|numeric',
            'id_matkul'=> 'required|numeric',
            'pertemuan'=> 'required|in_list[1,2,3,4,5]',
            'keterangan'=> 'required|in_list[H,S,I,A]',

        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'npm' => $this->request->getVar('npm'),
            'id_dosen' => $this->request->getVar('id_dosen'),
            'id_matkul' => $this->request->getVar('id_matkul'),
            'pertemuan' => $this->request->getVar('pertemuan'),
            'keterangan' => $this->request->getVar('keterangan')
        ];
    
            $this->model->updateAbsensi($id,$data);
            return $this->respond(['message'=>'Data kehadiran berhasil diupdate']);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->hapusAbsensi($id);
        return $this->respondDeleted(['message' => 'Data kehadiran berhasil dihapus']);
    }
}

<?php

namespace App\Controllers;

use App\Models\Matkul;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MatkulController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this-> model = new Matkul();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
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
        $data = $this->model->getMatkulById($id);
        if ($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Data kehadiran tidak ditemukan');
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
            'nama_matkul' => 'required|string',
            'sks' => 'required|numeric',
            'semester' => 'required|string'
        ];
    
        // Jika validasi gagal, kembalikan pesan error
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
        'nama_matkul' => $this->request->getVar('nama_matkul'),
        'sks' => $this->request->getVar('sks'),
        'semester' => $this->request->getVar('semester')
    ];

        $this->model->tambahMatkul($data);
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
            'nama_matkul' => 'required|string',
            'sks' => 'required|numeric',
            'semester' => 'required|string'
        ];
    
        // Jika validasi gagal, kembalikan pesan error
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
        'nama_matkul' => $this->request->getVar('nama_matkul'),
        'sks' => $this->request->getVar('sks'),
        'semester' => $this->request->getVar('semester')
    ];

        $this->model->updateMatkul($id,$data);
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
        $this->model->hapusMatkul($id);
        return $this->respondDeleted(['message' => 'Data kehadiran berhasil dihapus']);
    }
}

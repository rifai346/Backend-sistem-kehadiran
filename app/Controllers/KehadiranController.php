<?php

namespace App\Controllers;

use App\Models\Kehadiran;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class KehadiranController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this-> model = new Kehadiran();
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
        $data = $this->model->getkehadiranById($id);
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
            'id_mahasiswa' => 'required|numeric',
            'id_matakuliah' => 'required|numeric',
            'id_dosen' => 'required|numeric',
            'tanggal' => 'required|valid_date',
            'status' => 'required|in_list[hadir,tidak hadir]'
        ];
    
        // Jika validasi gagal, kembalikan pesan error
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
        'id_mahasiswa' => $this->request->getVar('id_mahasiswa'),
        'id_matakuliah' => $this->request->getVar('id_matakuliah'),
        'id_dosen' => $this->request->getVar('id_dosen'),
        'tanggal' => $this->request->getVar('tanggal'),
        'status' => $this->request->getVar('status')
    ];

        $this->model->tambahkehadiran($data);
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
            'id_mahasiswa' => 'required|numeric',
            'id_matakuliah' => 'required|numeric',
            'id_dosen' => 'required|numeric',
            'tanggal' => 'required|valid_date',
            'status' => 'required|in_list[hadir,tidak hadir]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

         $data = [
        'id_mahasiswa' => $this->request->getVar('id_mahasiswa'),
        'id_matakuliah' => $this->request->getVar('id_matakuliah'),
        'id_dosen' => $this->request->getVar('id_dosen'),
        'tanggal' => $this->request->getVar('tanggal'),
        'status' => $this->request->getVar('status')
    ];
        $this->model->updatekehadiran($id, $data);
        return $this->respond(['message' => 'data kehadiran berhasil diupdate']);
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
        $this->model->hapuskehadiran($id);
        return $this->respondDeleted(['message' => 'Data kehadiran berhasil dihapus']);
    }

    public function validate_kehadiran($id){
        $total_kehadiran = $this->db->where('id_mahasiswa', $id_mahasiswa)->where('status','hadir')->count_all_result('kehadiran');
        $total_perkuliahan = 30;
        $kehadiran_persen = ($$total_kehadiran / $total_kehadiran) * 100;

        if ($kehadiran_persen < 75){
            return false;
        }
        return true;
    }
}

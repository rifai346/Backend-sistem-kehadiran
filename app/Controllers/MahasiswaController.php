<?php

namespace App\Controllers;

use App\Models\Mahasiswa;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MahasiswaController extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Mahasiswa();
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
        $data = $this->model->getMahasiswaById($id);
        if($data){
            return $this-respond($data);
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
            'npm' => 'required|is_unique[tb_mahasiswa.npm]',
            'nama_mahasiswa' => 'required|string',
            'nama_matkul' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|in_list[D3 TI,D3 ELEKTRO,D4 TRET,D3 LISTRIK,D4 TPPL,D4 RKS,D4 PPA]',
            'tahun_akademik' => 'required|string'
        ];
    
        // Jika validasi gagal, kembalikan pesan error
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
        'npm' => $this->request->getVar('npm'),
        'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
        'nama_matkul' => $this->request->getVar('nama_matkul'),
        'jurusan' => $this->request->getVar('jurusan'),
        'prodi' => $this->request->getVar('prodi'),
        'tahun_akademik' => $this->request->getVar('tahun_akademik')
    ];

        $this->model->tambahMahasiswa($data);
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
            'npm' => 'required|integer',
            'nama_mahasiswa' => 'required|string',
            'nama_matkul' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|in_list[D3 TI,D3 ELEKTRO,D4 TRET,D3 LISTRIK,D4 TPPL,D4 RKS,D4 PPA]',
            'tahun_akademik' => 'required|string'
        ];
    
        // Jika validasi gagal, kembalikan pesan error
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
        'npm' => $this->request->getVar('npm'),
        'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
        'nama_matkul' => $this->request->getVar('nama_matkul'),
        'jurusan' => $this->request->getVar('jurusan'),
        'prodi' => $this->request->getVar('prodi'),
        'tahun_akademik' => $this->request->getVar('tahun_akademik')
    ];

        $this->model->updateMahasiswa($id,$data);
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
        $this->model->hapusMahasiswa($id);
        return $this->respondDeleted(['message' => 'Data kehadiran berhasil dihapus']);
    }
}

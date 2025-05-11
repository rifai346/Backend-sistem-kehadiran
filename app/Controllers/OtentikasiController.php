<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\otentikasi;

class authentikasi extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'email'=> [
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Silahkan masukkan email yang valid'
                ]
                ],
                'password'=> [
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Silahkan masukkan password'
                    ]
                    ],
                ];
                $validation->setRules($aturan);
                if(!$validation->withRequest($this->request)->run()){
                    return $this->fail($validation->getErrors());
                }
    }
}

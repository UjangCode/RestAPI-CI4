<?php

namespace App\Controllers;
use App\Models\EmployeeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Employee extends BaseController
{
  use ResponseTrait;

  function __construct()
  {
    $this->model = new EmployeeModel();
  }

  public function index()
  {
    # code...
    $data = $this->model->orderBy('name','asc')->findAll();
    return $this->respond($data, 200);
  }

  public function show($id = null)
  {
    # code...
    $data = $this->model->where('id', $id)->findAll();
    if($data) {
      return $this->respond($data, 200);
    } else {
      return $this->fail('Data id tidak ditemukan');
    }
  }
  
  public function create()
  {
    # code...
    // $data = [
    //   'name' => $this->request->getVar('name'),
    //   'email' => $this->request->getVar('email'),
    // ];
    $data = $this->request->getPost();
    $this->model->save($data);
    if(!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }
    $response = [
      'status' => 200,
      'error' => null,
      'message' => 'Data berhasil ditambahkan',
    ];
    
    return $this->respond($response);
  
  }

  public function update($id = null)
  {
    # code...
    $data = $this->request->getRawInput();
    $data['id'] = $id;

    $isExists = $this->model->where('id', $id)->findAll();

    if(!$isExists) {
      return $this->failNotFound("data tidak ditemukan");
    }

    if(!$this->model->save($data)){
      // return $this->respond($data);
      return $this->fail($this->model->errors());
    }

    $response = [
      'status' => 200,
      'error' => null,
      'messages' => [
        'success' => 'Data berhasil diupdate.',
      ],
    ];

    return $this->respond($response);
  }

  public function delete($id = null) 
  {
    # code...
    $data = $this->model->where('id', $id)->findAll();
    if($data){
      $this->model->delete($id);
      $response = [
        'status' => 200,
        'error' => null,
        'messages' => [
          'success' => 'Data berhasil dihapus',
        ],
      ];
      return $this->respond($response);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
}

<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->EmployeeModel = new EmployeeModel();
    }
    public function index()
    {
        // $db = $this->EmployeeModel->where('id','2')->first();
        // return view('home');
        return view('home');
    }
}

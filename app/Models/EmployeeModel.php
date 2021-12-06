<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
	// nama tabel dan primary
    protected $table      = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email','name'];

    protected $validationRules = [
        'name' => 'required',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'silahkan isi nama',
        ],
    ];

}

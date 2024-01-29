<?php

namespace App\Models;

use CodeIgniter\Model;

class Recovery extends Model
{
    protected $table             = 'recoveryLicense';
    protected $primaryKey        = 'userid';
    protected $DBGroup           = 'default';
    protected $useAutoIncrement  = false;
    protected $returnType        = 'array';
    protected $allowedFields     = [
        'userid', 'user_Name', 'license'
    ];
    protected $validationRules = [
        'user_Name' => 'required',
        'userid' => 'required',
        'license' => 'required',
    ];
}

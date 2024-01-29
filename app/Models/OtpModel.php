<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table            = 'verifyemail';
    protected $primaryKey = 'userid';
    protected $DBGroup = 'default';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'userid', 'user_Name', 'otp'
    ];
    protected $validationRules = [
        'user_Name' => 'required',
        'userid' => 'required',
        'otp' => 'required',
    ];
}

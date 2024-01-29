<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'fast_name', 'Last_name', 'userName', 'profilePicture', 'email', 'birthOfDate', 'gender', 'country', 'district', 'division', 'password', 'position', 'created_at'
    ];
    protected $validationRules  = [
        'fast_name' => 'required',
        'userName' => 'required|is_unique[users.userName]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'confirm_password' => 'required|matches[password]',
        'birthOfDate' => 'required',
        'gender' => 'required',
        'country' => 'required',
        'district' => 'required',
        'division' => 'required',
        'agree' => 'required'
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    public function hashPassword($data)
    {

        if (array_key_exists("password", $data["data"])) {
            $data["data"]["password"] = password_hash($data["data"]["password"], PASSWORD_DEFAULT);
            return $data;
        } else {
            return $data;
        }
    }
}

<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class User extends Entity
{
    protected $attributes = [
        'fast_name' => null,
        'Last_name' => null,
        'userName' => null,
        'email'    => null,
        'password' => null,
        'confirm_password' => null,
        'birthOfDate' => null,
        'gender' => null,
        'country' => null,
        'district' => null,
        'division' => null,
        'agree' => null
    ];

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        //  var_dump($this->);
        return $this;
    }
}

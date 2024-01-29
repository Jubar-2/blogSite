<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'post';
    protected $primaryKey       = 'post_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'userName', 'title', 'text', 'image', 'comment', 'created_at'
    ];
    protected $validationRules = [
        'userName' => 'required',
        'text' => 'required',
    ];
}

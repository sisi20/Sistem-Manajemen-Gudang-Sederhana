<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'email', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id'; // sesuaikan dengan primary key tabel users

    protected $allowedFields = ['name', 'username', 'email', 'password', 'phone', 'address', 'role', 'reset_token', 'status', 'img_type', 'created_at', 'updated_at'];

    public function saveUser($data)
    {
        return $this->insert($data);
    }
}

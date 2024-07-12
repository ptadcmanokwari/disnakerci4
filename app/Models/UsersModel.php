<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        // 'name',
        // 'email',
        // 'username',
        // 'password_hash',
        // 'reset_hash',
        // 'reset_at',
        // 'reset_expires',
        // 'activate_hash',
        // 'status',
        // 'status_message',
        // 'active',
        // 'force_pass_reset',
        // 'created_at',
        // 'updated_at',
        // 'deleted_at',
        // 'phone',

        'email',
        'username',
        'password_hash',
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function saveUser($data)
    {
        return $this->insert($data);
    }
}

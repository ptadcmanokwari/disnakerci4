<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    // protected $table = 'activity_logs';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['title', 'user', 'ip_address', 'created_at', 'updated_at'];
    protected $table = 'auth_logins';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ip_address', 'email', 'user_id', 'date', 'success'];
}

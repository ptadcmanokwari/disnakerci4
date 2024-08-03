<?php

namespace App\Models;

use CodeIgniter\Model;

class TimelineuserModel extends Model
{
    protected $table = 'timeline_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['timeline_id',    'tglwaktu',    'description',    'users_id'];
}

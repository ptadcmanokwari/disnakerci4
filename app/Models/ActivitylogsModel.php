<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivitylogsModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'user', 'ip_address', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    // Activitylogs
    public function getLogsByUser($userId)
    {
        return $this->where('user', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}

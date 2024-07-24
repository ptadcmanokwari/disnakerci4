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

    public function userActor($id_pencaker)
    {
        // Menggunakan Query Builder untuk mendapatkan detail aktivitas
        return $this->builder()
            ->select('p.namalengkap, p.nik, al.user, al.title, al.ip_address, al.created_at')
            ->join('pencaker p', 'al.user = p.id')
            ->where('p.id', $id_pencaker)
            ->get()
            ->getResultArray();
    }

    public function add($message, $user_id = 0, $ip_address = null)
    {
        $data = [
            'title'      => $message,
            'user'       => $user_id ? $user_id : user_id(), // Pastikan fungsi user_id() sesuai dengan implementasi Anda
            'ip_address' => $ip_address ? $ip_address : service('request')->getIPAddress()
        ];

        return $this->insert($data);
    }


    public function getActivityLogs()
    {
        $builder = $this->db->table($this->table);
        $builder->select('activity_logs.id, activity_logs.title, users.username as user, activity_logs.ip_address, activity_logs.created_at');
        $builder->join('users', 'activity_logs.user = users.id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDistinctUsers()
    {
        $builder = $this->builder();
        $builder->distinct();
        $builder->select('users.id, users.username as text');
        $builder->join('users', 'activity_logs.user = users.id');
        $users = $builder->get()->getResultArray();
        return $users;
    }
}

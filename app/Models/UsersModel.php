<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'namalengkap',
        'nik',
        'nohp',
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
        'permissions',
        'deleted_at',
        'created_at',
    ];

    // Method untuk mengambil user terbaru
    public function getLatestUsers($limit = 5)
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Method untuk menyimpan user
    public function saveUser($data)
    {
        return $this->insert($data);
    }

    // Method untuk mengambil data user beserta role-nya
    public function ubah_status_user()
    {
        $builder = $this->db->table('users');
        $builder->distinct();
        $builder->select('users.id as userid, username, nohp, nik, active, email, name, group_id, namalengkap, auth_groups.name as group_name, users.updated_at');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $query = $builder->get();
        return $query->getResult();
    }

    // Method untuk mengupdate role user
    public function updateUserRole($userId, $groupId)
    {
        // Pastikan data yang dibutuhkan tidak kosong
        if (!$userId || !$groupId) {
            return false;
        }

        // Lakukan update
        return $this->db->table('auth_groups_users') // Sesuaikan nama tabel jika berbeda
            ->where('user_id', $userId)
            ->update(['group_id' => $groupId]);
    }
}

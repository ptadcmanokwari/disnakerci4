<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class User extends Controller
{
    public function index()
    {
        $data['title'] = 'User List';
        return $this->loadView('admin/users', $data);
    }

    public function usersajax()
    {
        $usersModel = new UsersModel();

        // Mengambil data users dari model
        $users = $usersModel->findAll();
        // $totalFilteredRecords = $usersModel->countAll();

        $data = [];
        $no = 1;

        // Mengisi data untuk DataTables
        foreach ($users as $user) {
            $defaultImagePath = base_url('uploads/user/no-user.jpg');

            if (!empty($user['img_type'])) {
                // Jika ada gambar di database
                $imagePath = base_url('path/to/image/' . $user['img_type']);
                if (file_exists(FCPATH . 'path/to/image/' . $user['img_type'])) {
                    // Jika gambar ada di direktori
                    $gambar = '<img src="' . $imagePath . '" alt="User Image" width="40">';
                } else {
                    // Jika gambar tidak ada di direktori
                    $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';
                }
            } else {
                // Jika tidak ada gambar di database
                $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';
            }

            $data[] = [
                "no" => $no++,
                "img_type" => $gambar,
                "name" => $user['name'],
                "email" => $user['email'],
                "role" => $user['role'],
                "last_login" => $user['updated_at'],
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $user['id'] . '" ' . ($user['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Actions">
                        <a href="' . base_url('admin/detail_user/' . $user['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $user['id'] . '" data-edit_name="' . htmlspecialchars($user['name']) . '" data-edit_email="' . htmlspecialchars($user['email']) . '" data-edit_role="' . $user['role'] . '" data-edit_gambar="' . $user['img_type'] . '" data-toggle="modal" data-target="#ubahUserBaruModal">
                            <i class="bi bi-pencil-square px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $user['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        // Mengembalikan data dalam format JSON untuk DataTables
        echo json_encode(["data" => $data]);
    }


    public function update_status_user()
    {
        $id = $this->request->getJSON()->id;
        $status = $this->request->getJSON()->status;

        $model = new UsersModel();
        $update = $model->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function hapus_user()
    {
        $userId = $this->request->getPost('user_id'); // Sesuaikan dengan nama yang dikirimkan dari AJAX
        $model = new UsersModel();

        $user = $model->find($userId);
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan'])->setStatusCode(404);
        }

        // Hapus gambar profil dari direktori jika ada
        $imgType = isset($user['img_type']) ? $user['img_type'] : null;
        if (!empty($imgType)) {
            $path = FCPATH . 'uploads/user/' . $imgType;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Lakukan penghapusan dengan klausa where
        $deleted = $model->where('id', $userId)->delete();

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil dihapus'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus user'])->setStatusCode(500);
        }
    }

    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}

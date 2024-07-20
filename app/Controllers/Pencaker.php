<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PencakerModel;
use App\Models\DokumenPencakerModel;
use CodeIgniter\Controller;

class Pencaker extends Controller
{
    public function index()
    {
        $usersModel = new UsersModel();
        $userId = user()->id;

        // Ambil data pengguna berdasarkan user ID
        $user = $usersModel->find($userId);

        $pencakerModel = new PencakerModel();
        $id_pencaker = $pencakerModel->getStatusByUserId($user['id']);

        $dokumenPencaker = new DokumenPencakerModel();

        $isDataComplete = $pencakerModel->isDataComplete($userId);
        $isDocumentComplete = $dokumenPencaker->isDocumentComplete($userId);

        $data = [
            'title' => 'Dashboard Pencaker',
            'user' => $user,
            'id_pencaker' => $id_pencaker,
            'isDocumentComplete' => $isDocumentComplete,
            'isDataComplete' => $isDataComplete
        ];

        return $this->loadView('pencaker/dashboard', $data);
    }

    public function minta_verifikasi()
    {
        $pencakerModel = new PencakerModel();
        $userId = $this->request->getPost('id_pencaker');

        if (!$userId) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'User ID tidak ditemukan.']);
        }

        $data = [
            'keterangan_status' => $this->request->getPost('keterangan_status'),
        ];

        // Check if user already exists in the pencaker table
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Update the existing record
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Insert a new record
            $data['user_id'] = $userId;
            $pencakerModel->insert($data);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }


    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}

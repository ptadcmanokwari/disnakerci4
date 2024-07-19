<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PencakerModel;
use CodeIgniter\Controller;

class Pencaker extends Controller
{
    public function index()
    {
        $pencakerModel = new PencakerModel();
        $userId = user()->id; // Asumsi Anda menggunakan sistem otentikasi yang menyediakan user()->id

        $data['title'] = 'Dashboard Pencaker';
        $data['isDataComplete'] = $pencakerModel->isDataComplete($userId);

        return $this->loadView('pencaker/dashboard', $data);
    }


    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}

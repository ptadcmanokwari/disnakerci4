<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Pencaker extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard Pencaker';
        return $this->loadView('pencaker/dashboard', $data);
    }


    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}

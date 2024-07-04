<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Frontend extends BaseController
{

    public function index(): string
    {
        $data['title'] = 'Galeri';

        return $this->loadView('frontend/template', $data);
    }

    private function loadView(string $viewName, array $data = []): string
    {
        // $uri = service('uri');
        // $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI
        // $data['logo'] = $this->logo;
        // $data['txtpaneladmin'] = "Panel Administrator";

        return view($viewName, $data);
    }
}

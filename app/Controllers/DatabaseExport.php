<?php

namespace App\Controllers;

use App\Models\DatabaseExportModel;
use CodeIgniter\Controller;

class DatabaseExport extends Controller
{
    public function index()
    {
        return view('admin/database_export');
    }

    public function download()
    {
        $model = new DatabaseExportModel();
        $databaseContent = $model->exportDatabase();

        $dbName = $model->db->getDatabase(); // Get the database name
        $filename = $dbName . '.sql';

        return $this->response->download($filename, $databaseContent);
    }
}

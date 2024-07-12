<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabaseModel extends Model
{
    protected $DBGroup = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect($this->DBGroup);
    }

    public function exportDatabase()
    {
        $dbName = $this->db->getDatabase(); // Get the database name

        // Get all tables
        $tables = $this->db->listTables();

        $output = "CREATE DATABASE IF NOT EXISTS `$dbName`;\n";
        $output .= "USE `$dbName`;\n\n";

        foreach ($tables as $table) {
            // Get create table statement
            $createTableQuery = $this->db->query("SHOW CREATE TABLE $table")->getRowArray();
            $output .= $createTableQuery['Create Table'] . ";\n\n";

            // Get all table data
            $query = $this->db->query("SELECT * FROM $table");
            foreach ($query->getResultArray() as $row) {
                $output .= "INSERT INTO $table VALUES(";
                foreach ($row as $data) {
                    $output .= $this->db->escape($data) . ', ';
                }
                $output = rtrim($output, ', ');
                $output .= ");\n";
            }
            $output .= "\n\n";
        }

        return $output;
    }
}

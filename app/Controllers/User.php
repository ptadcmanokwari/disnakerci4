<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

//controller utk user pencaker
class User extends BaseController
{
    public function index()
    {
        return view('be_user/dashboard');
    }
}
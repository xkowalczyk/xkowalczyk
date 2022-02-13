<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        echo view('templates/header.php');
        echo view('Login/index.php');
        echo view('templates/footer.php');
    }
}

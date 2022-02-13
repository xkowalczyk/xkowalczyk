<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        echo view('templates/header.php');
        echo view('Register/index.php');
        echo view('templates/footer.php');
    }
}

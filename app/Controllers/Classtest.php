<?php

namespace App\Controllers;

use App\Models\UserAddressModel;
use App\Libraries\Services\UserService;
use App\Libraries\Services\AuthService;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class Classtest extends Controller
{
    private $testSystem;

    public function __construct()
    {
        $this->testSystem = new UserService();
        $this->testSystems = new AuthService();
    }

    public function index()
    {
        echo view('templates/header.php');
    }

    public function test()
    {
        echo view('templates/header.php');
    }
}

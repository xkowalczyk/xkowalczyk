<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\BinService;

class Bin extends Controller
{
    private $binService;

    public function __construct()
    {
        $this->binService = new BinService();
    }

    public function index()
    {
        $SystemLang['productList'] = $this->binService->getBinItems();
        
        echo view('templates/header.php');
        echo view('Bin/index.php', $SystemLang);
        echo view('templates/footer.php');
    }
}

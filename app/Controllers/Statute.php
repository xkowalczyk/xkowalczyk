<?php

namespace App\Controllers;

use App\Libraries\Services\ConfigService;
use CodeIgniter\Controller;

class Statute extends Controller
{

    private $configService;

    public function __construct()
    {
        $this->configService = new ConfigService();
    }

    public function index()
    {
        $SystemLang['statute'] = $this->configService->getStatute();
        echo view('templates/header.php');
        echo view('Statute/index.php', $SystemLang);
        echo view('templates/footer.php');
    }
}

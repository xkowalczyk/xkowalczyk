<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Statute extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $SystemLang['statute'] = 'inproggress';
        echo view('Statute/index.php', $SystemLang);
    }
}

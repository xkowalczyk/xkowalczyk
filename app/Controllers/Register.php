<?php

namespace App\Controllers;

use App\Libraries\Services\SessionService;
use CodeIgniter\Controller;

class Register extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            echo view('templates/header.php');
            echo view('Register/index.php');
            echo view('templates/footer.php');
        } else {
            return redirect()->to(base_url('account'));
        }
    }
}

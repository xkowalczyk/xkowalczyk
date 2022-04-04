<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;

class Account extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        if($this->sessionService->checkIssetSession('userLogged') == false){
            return redirect()->to(base_url('login'));
        }

        $SystemLang['userObject'] = null;
        echo view('templates/header.php');
        echo view('UserAccount/index.php', $SystemLang);
    }

    public function orders(){
        
    }
}

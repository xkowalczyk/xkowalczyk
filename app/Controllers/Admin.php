<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;

class Admin extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        //$this->sessionService->setSession('adminLogged', 'ytmrhc@gmail.com');
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }

        echo view('Admin/header.php');
    }

    public function orders()
    {
        
    }
}

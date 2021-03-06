<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;

class Error extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        $errorData = $this->sessionService->getSingleSession('errorData');

        if ($errorData['errorName'] == null || $errorData['errorDetails'] == null || $errorData['errorToPage'] == null){
            return redirect()->to(base_url('home'));
        }

        $SystemLang['errorName'] = $errorData['errorName'];
        $SystemLang['errorDetails'] = $errorData['errorDetails'];
        $SystemLang['errorToPage'] = $errorData['errorToPage'];
        echo view('Error/index.php', $SystemLang);
    }
}

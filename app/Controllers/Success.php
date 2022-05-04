<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;

class Success extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        $successData = $this->sessionService->getSingleSession('successData');

        if ($successData['successName'] == null || $successData['successDetails'] == null || $successData['successToPage'] == null){
            return redirect()->to(base_url('home'));
        }

        $SystemLang['successName'] = $successData['successName'];
        $SystemLang['successDetails'] = $successData['successDetails'];
        $SystemLang['successToPage'] = $successData['successToPage'];
        echo view('Success/index.php', $SystemLang);
    }
}

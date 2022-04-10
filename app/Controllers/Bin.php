<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;
use App\Libraries;

class Bin extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
    }
}

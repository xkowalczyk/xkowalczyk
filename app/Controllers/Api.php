<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;
use App\Libraries\Api\ApiController;

class Api extends Controller
{
    private $sessionService;
    private $apiController;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->apiController = new ApiController();
    }

    public function index()
    {
        $response = null;

        $action = $_POST['action'];
        $value = $_POST['value'];

        if($action == "" && $value == ""){
            $response = "eror-novalue";
            return json_encode($response);
        } else {
            $response = $this->apiController->runRequest($action, $value);
            return json_encode($response);
        }
    }

    public function admin()
    {
        $response = null;

        if ($this->sessionService->checkIssetSession('adminLogged') == false) {
            $response = "error-noauthenticate";
            return json_encode($response);
        }
    }
}

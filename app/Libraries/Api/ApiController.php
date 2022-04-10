<?php

namespace App\Libraries\Api;

use App\Libraries\Services\BinService;

class ApiController
{

    private $binService;

    public function __construct()
    {
        $this->binService = new BinService();
    }

    public function runRequest($requestAction, $requestValue)
    {
        switch ($requestAction) {
            case "addItemToBin": {
                    return $this->binService->addItemToBin($requestValue);
                }
                break;
            default:{
                return "error_invalidaction";
            }
        }
    }
}

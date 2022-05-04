<?php

namespace App\Libraries\Services;

use App\Models\StatuteModel;
use CodeIgniter\Model;

class ConfigService{

    private $statuteModel;

    public function __construct()
    {
        $this->statuteModel = new StatuteModel();
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    public function getStatute()
    {
        return $this->convertToArray($this->statuteModel->getStatute())[0]['statute'];
    }

    public function editStatute($statute){
        $this->statuteModel->editStatute($statute);
    }
}
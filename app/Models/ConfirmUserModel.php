<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfirmUserModel extends Model
{
    protected $table = 'confirmation';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getAllConfirmStatus()
    {
        return $this->findAll();
    }

    public function getSingleConfirmStatus($userEmail)
    {
        $this->getConnect();
        $this->builder->select('confirmation_status')
                      ->where('confirmation_user_email', $userEmail);
        return $this->builder->get();
    }

    public function putNewConfirmStatus($userEmail, $status)
    {
        $this->getConnect();
        $data = [
            'confirmation_user_email' => $userEmail,
            'confirmation_status' => $status
        ];

        $this->builder->insert($data);
    }
}

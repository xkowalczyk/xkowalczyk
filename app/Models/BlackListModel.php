<?php

namespace App\Models;

use CodeIgniter\Model;

class BlackListModel extends Model
{
    protected $table = 'user_blacklist';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getAllBlackListStatus()
    {
        return $this->findAll();
    }

    public function getSingleBlackListStatus($userEmail)
    {
        $this->getConnect();
        $this->builder->selectCount('blacklist_id')
                      ->where('blacklist_user_email', $userEmail);
        return $this->builder->get();
    }
}

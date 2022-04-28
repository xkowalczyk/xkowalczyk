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
        $this->builder->select()
                      ->where('blacklist_user_email', $userEmail);
        return $this->builder->get();
    }

    public function putUser($userId){
        $this->getConnect();
        $data = array(
            'blacklist_user_email' => $userId
        );
        $this->builder->insert($data);
    }

    public function removeUser($userEmail)
    {
        $this->getConnect();
        $this->builder->delete(['blacklist_user_email' => $userEmail]);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getSingleUser($userEmail)
    {
        $this->getConnect();
        $this->builder->select()
                      ->where('user_email', $userEmail);

        return $this->builder->get();
    }

    public function putUser($userName, $userLastname, $userEmail, $userLogin, $userPassword){
        $this->getConnect();
        $data = [
            'user_name' => $userName,
            'user_lastname' => $userLastname,
            'user_email' => $userEmail,
            'user_password' => $userPassword,
            'user_permission' => '0'
        ];

        $this->builder->insert($data);
        //$this->builder->replace(['user_address_id' => $this->builder->selectMax('user_id')->get()->getRowArray()['user_id']], ['user_id', $this->builder->selectMax('user_id')->get()->getRowArray()['user_id']]);
    }
}

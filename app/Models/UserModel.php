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

    public function getAllUsers()
    {
        $this->getConnect();
        $this->builder->select();

        return $this->builder->get();
    }

    public function getSingleUser($userEmail)
    {
        $this->getConnect();
        $this->builder->select()
            ->where('user_email', $userEmail);

        return $this->builder->get();
    }

    public function getSingleUserId($userId)
    {
        $this->getConnect();
        $this->builder->select()
            ->where('user_id', $userId);

        return $this->builder->get();
    }

    public function putUser($userName, $userLastname, $userEmail, $userLogin, $userPassword)
    {
        $this->getConnect();
        $data = [
            'user_name' => $userName,
            'user_lastname' => $userLastname,
            'user_email' => $userEmail,
            'user_password' => $userPassword,
            'user_permission' => '0'
        ];

        $this->builder->insert($data);
    }

    public function editUser($userId, $editParameters)
    {
        $this->getConnect();
        $this->builder->where('user_id', $userId);
        $this->builder->update($editParameters);
        $this->builder->get();
    }
}

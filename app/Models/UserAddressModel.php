<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAddressModel extends Model
{
    protected $table = 'user_address';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getAllAddress()
    {
        $this->getConnect();
        return $this->builder->select()->get();
    }

    public function getUserAddress($userId){
        $this->getConnect();
        return $this->builder->where('user_address_user_id', $userId)->get();
    }

    public function getSingleAddress($addressId)
    {
        $this->getConnect();
        return $this->builder->where('user_address_id', $addressId)->get();
    }

    public function putAddress($addressParameters)
    {
        $this->getConnect();
        $this->builder->insert($addressParameters);
    }

    public function removeAddress($addressId)
    {
        $this->getConnect();
        $this->builder->where('user_address_id', $addressId)->delete();
        $this->builder->get();
    }

    public function editAddress($addressId, $editParameters){
        $this->getConnect();

        $this->builder->where('user_address_id', $addressId)
            ->update($editParameters);
        $this->builder->get();
    }
}

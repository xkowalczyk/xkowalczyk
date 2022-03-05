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

    public function getSingleAddress($userEmail)
    {
        $this->getConnect();
        return $this->builder->where('user_address_user', $userEmail)->get();
    }

    public function putAddress($userEmail, $addressCity, $addressHomeNumber, $addressStreet, $addressPostCode)
    {
        $this->getConnect();
        $data = [
            'user_address_user' => $userEmail,
            'user_address_street' => $addressStreet,
            'user_address_city' => $addressCity,
            'user_address_homenumber' => $addressHomeNumber,
            'user_address_postcode' => $addressPostCode
        ];

        $this->builder->insert($data);
    }
}

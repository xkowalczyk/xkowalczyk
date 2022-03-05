<?php

namespace App\Libraries\Services;

use App\Libraries\Address;
use CodeIgniter\Model;

class UserAddressService
{

    private $addressModel;

    public function __construct()
    {
        $this->addressModel = model(UserAddressModel::class);
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    private function convertToArrayAddress($mysqlObject)
    {
        $convertArrayObject = $mysqlObject->getResultArray();
        $addressArray = array();
        $arrayIndex = 0;
        foreach ($convertArrayObject as $object) {
            $addressArray[$arrayIndex] = new Address(
                $object['user_address_id'],
                $object['user_address_user'],
                $object['user_address_city'],
                $object['user_address_homenumber'],
                $object['user_address_postcode']
            );
            $arrayIndex++;
        }
        return $addressArray;
    }

    public function putAddress($userEmail, $addressCity, $addressHomeNumber, $addressStreet, $addressPostCode)
    {
        $this->addressModel->putAddress($userEmail, $addressCity, $addressHomeNumber, $addressStreet, $addressPostCode);
    }

    public function getAllAddress()
    {
        return $this->convertToArrayAddress($this->addressModel->getAllAddress());
    }

    public function getSingleAddress($userEmail)
    {
        return $this->convertToArrayAddress($this->addressModel->getSingleAddress($userEmail))[0];
    }
}

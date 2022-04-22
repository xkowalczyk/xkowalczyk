<?php

namespace App\Libraries\Services;

use App\Libraries\Supplier;
use App\Models;

class SuppliersService{

    private $suppliersModel;
    
    public function __construct()
    {
        $this->suppliersModel = model(SuppliersModel::class);
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    private function convertToArraySuppliers($mysqlObject)
    {
        $convertArrayObject = $mysqlObject->getResultArray();
        $suppliersArray = array();
        $arrayIndex = 0;
        foreach ($convertArrayObject as $object) {
            $suppliersArray[$arrayIndex] = new Supplier(
                $object['suppliers_id'],
                $object['suppliers_name'],
                $object['suppliers_description'],
                $object['suppliers_delivery_price']
            );
            $arrayIndex++;
        }
        return $suppliersArray;
    }

    public function getSuppliers(){
        return $this->convertToArraySuppliers($this->suppliersModel->getSuppliers());
    }

    public function getSingleSupplier($supplierId)
    {
        return $this->convertToArraySuppliers($this->suppliersModel->getSingleSupplier($supplierId));
    }
}
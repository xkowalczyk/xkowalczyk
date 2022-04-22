<?php

namespace App\Models;
use CodeIgniter\Model;

class SuppliersModel extends Model
{

    protected $table = 'suppliers';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getSuppliers()
    {
        $this->getConnect();
        return $this->builder->get();
    }

    public function getSingleSupplier($suppliersId)
    {
        $this->getConnect();
        $this->builder->where('suppliers_id', $suppliersId);
        return $this->builder->get();
    }

    public function putSuppliers($suppliersParameters)
    {
        $this->builder->insert($suppliersParameters);
    }

    public function removeSuppliers($suppliersId)
    {
        $this->getConnect();
        $this->builder->where('suppliers_id', $suppliersId)->delete();
        return $this->builder->get();
    }
}
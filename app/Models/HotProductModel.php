<?php

namespace App\Models;

use CodeIgniter\Model;

class HotProductModel extends Model
{
    protected $table = 'hot_product';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getHotProduct()
    {
        $this->getConnect();
        $this->builder->select('hot_item_product_id');
        return $this->builder->get();
    }
}

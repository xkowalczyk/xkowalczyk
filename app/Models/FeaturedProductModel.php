<?php

namespace App\Models;

use CodeIgniter\Model;

class FeaturedProductModel extends Model
{
    protected $table = 'featured_products';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getFeaturedProducts()
    {
        $this->getConnect();
        $this->builder->select('featured_products_product_id');
        return $this->builder->get();
    }
    public function addFeaturedProduct($productId)
    {
        $this->getConnect();
        $this->builder->insert(array('featured_products_product_id' => $productId));
    }

    public function removeFeaturedProduct($productId)
    {
        $this->getConnect();
        $this->builder->where('featured_products_product_id', $productId)->delete();
        $this->get();
    }
}

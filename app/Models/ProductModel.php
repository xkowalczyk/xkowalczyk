<?php

namespace App\Models;

use App\Libraries\Product;
use CodeIgniter\Database\Config;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getAllProducts()
    {
        $this->getConnect();
        return $this->builder->get();
    }

    public function getSingleProduct($productId){
        $this->getConnect();
        $this->builder->where('item_id', $productId);
        return $this->builder->get();
    }

    public function getChoseProduct($productsId){
        $this->getConnect();
        $this->builder->whereIn('item_id', $productsId);
        return $this->builder->get();
    }

    public function getCategoryProducts($productCategory)
    {
        $this->getConnect();
        $this->builder->where('item_category_id', $productCategory);
        return $this->builder->get();
    }

    public function getSubCategoryProducts($productSubCategory)
    {
        $this->getConnect();
        $this->builder->where('item_subcategory_id', $productSubCategory);
        return $this->builder->get();
    }
}

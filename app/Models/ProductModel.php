<?php

namespace App\Models;

use App\Libraries\Product;
use CodeIgniter\Database\Config;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    private $dbConnect;

    private function getConnect($table)
    {
        $this->dbConnect = \Config\Database::connect();
        $this->builder = $this->dbConnect->table($table);
    }

    public function getAllProduct()
    {
        $this->table = 'product';
        $response = $this->findAll();

        $productList = array();
        $index = 0;

        foreach ($response as $product) {
            $productList[$index] = new Product($product['item_id'], $product['item_name'], $product['item_description'], $product['item_category_id'], $product['item_subcategory_id'], $product['item_price'], $product['item_producer_id'], $product['item_photo']);
            $index++;
        };

        return $productList;
    }

    public function getCategoryProduct($category)
    {
        $this->getConnect('product');
        $this->builder->select();
        $this->builder->where('item_category_id', $category);
        $query = $this->builder->get();
        $response = $query->getResultArray();

        $productList = array();
        $index = 0;

        foreach ($response as $product) {
            $productList[$index] = new Product($product['item_id'], $product['item_name'], $product['item_description'], $product['item_category_id'], $product['item_subcategory_id'], $product['item_price'], $product['item_producer_id'], $product['item_photo']);
            $index++;
        };

        return $productList;
    }

    public function getSubCategoryProduct($subcategory)
    {
        $this->getConnect('product');
        $this->builder->select();
        $this->builder->where('item_subcategory_id', $subcategory);
        $query = $this->builder->get();
        $response = $query->getResultArray();

        $productList = array();
        $index = 0;

        foreach ($response as $product) {
            $productList[$index] = new Product($product['item_id'], $product['item_name'], $product['item_description'], $product['item_category_id'], $product['item_subcategory_id'], $product['item_price'], $product['item_producer_id'], $product['item_photo']);
            $index++;
        };

        return $productList;
    }

    public function getHotProduct()
    {
        $this->getConnect('hot_item');
        $this->builder->select('hot_item_product_id');
        $query = $this->builder->get();
        $idResponse = $query->getResultArray();

        $hotProduct = array();

        $indexId = 0;

        foreach ($idResponse as $id) {
            $hotItemId = $id['hot_item_product_id'];

            $this->getConnect('product');
            $this->builder->select();
            $this->builder->where('item_id', $hotItemId);
            $query = $this->builder->get();
            $response = $query->getResultArray();

            $hotProduct[$indexId] = new Product($response[0]['item_id'], $response[0]['item_name'], $response[0]['item_description'], $response[0]['item_category_id'], $response[0]['item_subcategory_id'], $response[0]['item_price'], $response[0]['item_producer_id'], $response[0]['item_photo']);

            $indexId++;
        }

        return $hotProduct;
    }

    public function getFeaturedProduct()
    {
        $this->getConnect('featured_products');
        $this->builder->select('featured_products_product_id');
        $query = $this->builder->get();
        $featuredResponse = $query->getResultArray();

        $featuredProduct = array();

        $indexId = 0;

        foreach ($featuredResponse as $id) {
            $featuredItemId = $id['featured_products_product_id'];

            $this->getConnect('product');
            $this->builder->select();
            $this->builder->where('item_id', $featuredItemId);
            $query = $this->builder->get();
            $response = $query->getResultArray();

            $featuredProduct[$indexId] = new Product($response[0]['item_id'], $response[0]['item_name'], $response[0]['item_description'], $response[0]['item_category_id'], $response[0]['item_subcategory_id'], $response[0]['item_price'], $response[0]['item_producer_id'], $response[0]['item_photo']);

            $indexId++;
        }

        return $featuredProduct;
    }
}

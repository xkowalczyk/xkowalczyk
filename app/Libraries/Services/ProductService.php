<?php

namespace App\Libraries\Services;

use App\Libraries\Product;
use App\Models\ProductModel;
use App\Models\FeaturedProductModel;

class ProductService
{

    private $productModel;
    private $hotProductModel;
    private $featuredProductModel;
    private $confirmUserModel;

    public function __construct()
    {
        $this->productModel = model(ProductModel::class);
        $this->hotProductModel = model(HotProductModel::class);
        $this->featuredProductModel = model(FeaturedProductModel::class);
    }

    private function convertToArrayProduct($mysqlObject)
    {
        if($mysqlObject == null){ return; }
        $convertArrayObject = $mysqlObject->getResultArray();
        $productArray = array();
        $arrayIndex = 0;
        foreach ($convertArrayObject as $object) {
            $productArray[$arrayIndex] = new Product(
                $object['item_id'],
                $object['item_name'],
                $object['item_description'],
                $object['item_category_id'],
                $object['item_subcategory_id'],
                $object['item_price'],
                $object['item_producer_id'],
                $object['item_photo'],
            );
            $arrayIndex++;
        }

        return $productArray;
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    public function editProduct($productId, $productParameters)
    {
        $this->productModel->editProduct($productId, $productParameters);
    }

    public function getAllProducts()
    {
        return $this->convertToArrayProduct($this->productModel->getAllProducts());
    }

    public function getSingleProduct($productId)
    {
        return $this->convertToArrayProduct($this->productModel->getSingleProduct($productId));
    }

    public function getChoseProducts($productsId)
    {
        return $this->convertToArrayProduct($this->productModel->getChoseProduct($productsId));
    }

    public function getCategoryProducts($productCategory)
    {
        return $this->convertToArrayProduct($this->productModel->getCategoryProducts($productCategory));
    }

    public function getLastAddItemId()
    {
        $allProducts = $this->getAllProducts();
        return $newProductId = end($allProducts)->item_id;
    }

    public function getSubCategoryProducts($productSubCategory)
    {
        return $this->convertToArrayProduct($this->productModel->getSubCategoryProducts($productSubCategory));
    }

    public function getHotProduct()
    {
        $productId = $this->convertToArray($this->hotProductModel->getHotProduct())[0]['hot_item_product_id'];
        return $this->getSingleProduct($productId);
    }

    public function addFeaturedProduct($productId)
    {
        $this->featuredProductModel->addFeaturedProduct($productId);
    }

    public function addProduct($productParameters)
    {
        $this->productModel->addProduct($productParameters);
    }

    public function removeFeaturedProduct($productId)
    {
        $this->featuredProductModel->removeFeaturedProduct($productId);
    }


    public function getFeaturedProduct()
    {
        $arrayIdObject = $this->convertToArray($this->featuredProductModel->getFeaturedProducts());
        $productIdArray = array();
        $arrayIndex = 0;
        foreach ($arrayIdObject as $productId) {
            $productIdArray[$arrayIndex] = $productId['featured_products_product_id'];
            $arrayIndex++;
        }
        return $this->getChoseProducts($productIdArray);
    }

    public function getFilterProduct($filterParameters, $getParameters)
    {
        $categoryParameters = explode('-', $filterParameters);
        $additionalParameters = $getParameters;
        $additionalParametersStatus = null;


        if ($categoryParameters[0] == null and $categoryParameters[1] == null) {
            return false;
        } else if ($categoryParameters[0] != 's' && $categoryParameters[0] != 'c') {
            return false;
        } else if (is_numeric($categoryParameters[1]) == false) {
            return false;
        }

        if ($additionalParameters == null) {
            $additionalParametersStatus = false;
        } else {
            $additionalParametersStatus = true;
        }

        if ($additionalParameters == false) {
            if ($categoryParameters[0] == 'c') {
                echo (int)$categoryParameters[1];
                return $this->getCategoryProducts((int)$categoryParameters[1]);
            } else if ($categoryParameters[0] == 's') {
                echo (int)$categoryParameters[1];
                return $this->getSubCategoryProducts((int)$categoryParameters[1]);
            }
        }

        if ($additionalParametersStatus == true) {
            return $this->getSortProduct($this->getCategoryProducts((int)$categoryParameters[1]), $getParameters);
        }
    }

    public function getSortProduct($product, $sortParameteresArray)
    {
        $sortParameteres = array_keys($sortParameteresArray);
        $returnProduct = array();

        foreach ($sortParameteres as $parameters) {
            switch ($parameters){
                case 'minprice':{
                    foreach ($product as $item) {
                        if ((int)$item->item_price >= (int)$sortParameteresArray['minprice']) {
                            array_push($returnProduct, $item);
                        }
                    }
                } break;
                case 'maxprice':{
                    foreach ($product as $item) {
                        if ((int)$item->item_price <= (int)$sortParameteresArray['maxprice']) {
                            array_push($returnProduct, $item);
                        }
                    }
                    foreach ($returnProduct as $item ) {
                        if ((int)$item->item_price >= (int)$sortParameteresArray['maxprice']) {
                            array_push($returnProduct, $item);
                        }
                    }
                }
            }

        }

        return $returnProduct;
    }

    public function getSearchProduct($searchString){
        $checkProducts = $this->getAllProducts();
        $returnProduct = array();

        $arrayIndex = 0;
        foreach($checkProducts as $item){
           $productCheckName = explode(' ', $item->item_name);
           foreach($productCheckName as $productFragment){
                if(mb_strtolower($productFragment) == mb_strtolower($searchString)){
                    $returnProduct[$arrayIndex] = $item;
                    $arrayIndex++;
                }
           }
        }

        return $returnProduct;
    }
}

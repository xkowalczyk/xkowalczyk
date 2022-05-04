<?php

namespace App\Libraries\Services;

use App\Libraries\Services\ProductService;

class BinService
{

    private $productService;

    public function __construct()
    {
        helper('cookie');
        $this->productService = new ProductService();
    }

    public function addItemToBin($itemId)
    {
        if (!isset($_COOKIE['bin'])) {
            setcookie('bin', $itemId . ",");
            return "succes-addtobin";
        }

        $checkValue = explode(',', get_cookie('bin'));

        foreach ($checkValue as $value) {
            if ($value == $itemId) {
                return "error-itemisset";
            }
        }

        $checkValue[count($checkValue) - 1] = $itemId . ",";
        setcookie('bin', implode(',', $checkValue));

        return get_cookie('bin');
    }

    public function getBinItems()
    {
        if(get_cookie('bin') == null || get_cookie('bin') == '' || get_cookie('bin') == ' '){
            return;
        }
        $binValue = explode(',', get_cookie('bin'));
        $returnProduct = array();

        foreach ($binValue as $item) {
            if ($item != null && $item != '' && $item != ' ') {
                if ($this->productService->getSingleProduct((int)$item) != null) {
                    array_push($returnProduct, $this->productService->getSingleProduct((int)$item));
                }
            }
        }

        return $returnProduct;
    }

    public function dellBinItem($itemId)
    {
        $binValue = explode(',', get_cookie('bin'));
        $newValue = array();

        foreach($binValue as $item){
            if($item != $itemId){
                array_push($newValue, $item);
            }
        }

        if($newValue == null || $newValue == '' || $newValue == ' '){
            setcookie('bin', ' ');
        }
        
        setcookie('bin', implode(',', $newValue));
        return "true";
    }

    public function clearBin()
    {
        delete_cookie('bin');
    }
}

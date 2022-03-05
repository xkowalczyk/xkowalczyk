<?php

namespace App\Libraries\Services;

class ProductSortService
{
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

        foreach($sortParameteres as $parameters){
            if($parameters == 'minprice'){
                foreach($product as $item){
                    if((int)$item->item_price >= (int)$sortParameteresArray['minprice']){
                        echo "s";
                    }
                }
            }
        }
    }
}
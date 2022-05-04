<?php

namespace App\Libraries\Services;

use CodeIgniter\Model;

class CategoryService{

    private $categoryModel;
    private $subCategoryModel;

    public function __construct()
    {
        $this->categoryModel = model(CategoryModel::class);
        $this->subCategoryModel = model(SubCategoryModel::class);
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    public function getCategory(){
        return $this->categoryModel->getCategory();
    }

    public function getAllSubCategory()
    {
        return $this->subCategoryModel->getSubCategory();
    }

    public function getSubCategory($categoryId)
    {
        $subCategory = $this->getAllSubCategory();
        $data = array();
        $arrayIndex = 0;
        foreach($subCategory as $subCategoryItem){
            if($subCategoryItem['subcategory_category_id'] == $categoryId){
                $data[$arrayIndex] = $subCategoryItem;
                $arrayIndex++;
            }
        }

        return $data;
    }

    public function removeCategory($categoryId)
    {
        $this->categoryModel->removeCategory($categoryId);
    }

    public function addCategory($categoryName, $categoryDescription, $categoryPhoto)
    {
        $this->categoryModel->addCategory($categoryName, $categoryDescription, $categoryPhoto);
    }

    public function editCategory()
    {

    }

    public function removeSubCategory($categoryId)
    {
        $this->subCategoryModel->removeSubCategory($categoryId);
    }

    public function addSubCategory($categoryName, $categoryDescription, $categoryMain)
    {
        $this->subCategoryModel->addSubCategory($categoryName, $categoryDescription, $categoryMain);
    }

    public function editSubCategory()
    {

    }
}
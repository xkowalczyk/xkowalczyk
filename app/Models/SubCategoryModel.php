<?php

namespace App\Models;
use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $table = 'subcategory';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getSubCategory()
    {
        return $this->findAll(); 
    }

    public function getSingleSubCategory($categoryId)
    {

    }

    public function addSubCategory($categoryName, $categoryDescription, $categoryMain)
    {
        $this->getConnect();
        $this->builder->insert(
            array(
                'subcategory_name' => $categoryName,
                'subcategory_description' => $categoryDescription,
                'subcategory_category_id' => $categoryMain
            )
        );
    }

    public function subCategoryEdit($categoryId, $categoryName, $categoryDescription){
        $this->getConnect();

        $this->builder->where('subcategory_id', $categoryId)
            ->update(array('subcategory_name' => $categoryName, 'subcategory_description' => $categoryDescription));
        $this->builder->get();
    }

    public function removeSubCategory($subCategoryId)
    {
        $this->getConnect();
        $this->builder->where('subcategory_id', $subCategoryId)->delete();
        $this->builder->get();
    }

}
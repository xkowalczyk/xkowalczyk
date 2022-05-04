<?php

namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getCategory()
    {
        return $this->findAll();
    }

    public function addCategory($categoryName, $categoryDescription, $categoryPhoto)
    {
        $this->getConnect();
        $this->builder->insert(
            array(
                'category_name' => $categoryName,
                'category_description' => $categoryDescription,
                'category_photo' => $categoryPhoto
            )
        );
    }

    public function categoryEdit($categoryId, $categoryName, $categoryDescription){
        $this->getConnect();

        $this->builder->where('category_id', $categoryId)
            ->update(array('category_name' => $categoryName, 'category_description' => $categoryDescription));
        $this->builder->get();
    }

    public function removeCategory($categoryId)
    {
        $this->getConnect();
        $this->builder->where('category_id', $categoryId)->delete();
        $this->builder->get();
    }
}
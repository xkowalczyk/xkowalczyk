<?php

namespace App\Models;
use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $table = 'subcategory';

    public function getSubCategory()
    {
        return $this->findAll(); 
    }

    public function getSingleSubCategory($categoryId)
    {

    }

}
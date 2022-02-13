<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    private $dbConnect;

    public function __construct(){
        $this->dbConnect = \Config\Database::connect();
    }

    public function index()
    {
        $productModel = model(ProductModel::class);
        $hotProduct = $productModel->getHotProduct();
        $featuredProduct = $productModel->getFeaturedProduct();

        $SystemLang['hot_product'] = $hotProduct;
        $SystemLang['featured_product'] = $featuredProduct;

        echo view('templates/header.php');
        echo view('Home/index.php', $SystemLang);
        echo view('templates/footer.php');
    }
}

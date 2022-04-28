<?php

namespace App\Controllers;

use App\Libraries\Services\ProductService;
use CodeIgniter\Controller;

class Home extends Controller
{

    private $productService;

    public function __construct(){
        $this->productService = new ProductService();
    }

    public function index()
    {

        $SystemLang['hot_product'] = $this->productService->getHotProduct();
        $SystemLang['featured_product'] = $this->productService->getFeaturedProduct();

        echo view('templates/header.php');
        echo view('Home/index.php', $SystemLang);
        echo view('templates/footer.php');
    }
}
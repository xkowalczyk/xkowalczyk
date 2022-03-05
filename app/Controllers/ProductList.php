<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\Services\ProductService;

class ProductList extends Controller
{
    private $productService;
    protected $request;

    public function __construct()
    {
        $this->productService = new ProductService();
        helper('html');
    }

    public function index()
    {
        $SystemLang['productList'] = $this->productService->getAllProducts();

        echo view('templates/header.php');
        echo view('ProductList/categorylist.php');
        echo view('ProductList/productlist.php', $SystemLang);
    }

    public function filter($filterParameters)
    {
        $SystemLang['productList'] = $this->productService->getFilterProduct($filterParameters, $this->request->getGet());
        echo view('templates/header.php');
        echo view('ProductList/categorylist.php');
        echo view('ProductList/productlist.php', $SystemLang);
    }
}

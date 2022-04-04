<?php

namespace App\Controllers;

use App\Libraries\Services\ProductService;
use CodeIgniter\Controller;

class Product extends Controller
{

    private $productService;

    public function __construct(){
        $this->productService = new ProductService();
    }

    public function index($productId = null)
    {
        if($productId == null){
            return redirect()->to(base_url('productlist'));
        }

        if($this->productService->getSingleProduct($productId) == null){
            return redirect()->to(base_url('productlist'));
        }

        $SystemLang['product'] = $this->productService->getSingleProduct($productId);

        echo view('templates/header.php');
        echo view('Product/index.php', $SystemLang);
        
    }
}

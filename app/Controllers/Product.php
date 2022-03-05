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

    public function index($productId)
    {

    }

    public function checkproduct($productId = null)
    {   
        if($productId == null){
            return redirect()->to(base_url('productlist'));
        }

        
    }
}

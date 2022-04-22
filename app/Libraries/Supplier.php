<?php 

namespace App\Libraries;

class Supplier{

    public $supplier_id;
    public $supplier_name;
    public $supplier_description;
    public $supplier_delivery_price;

    public function __construct($supplier_id, $supplier_name, $supplier_description, $supplier_price)
    {
        $this->supplier_id = $supplier_id;
        $this->supplier_name = $supplier_name;
        $this->supplier_description = $supplier_description;
        $this->supplier_delivery_price = $supplier_price;
    }
}
<?php

namespace App\Libraries;

class Product
{

    public $item_id = 0;
    public $item_name = 'null';
    public $item_description = 'null';
    public $item_category_id = 0;
    public $item_subcategory_id = 0;
    public $item_price = 0;
    public $item_producer_id = 0;
    public $item_photo = 'null';

    public function __construct($item_id, $item_name, $item_description, $item_category_id, $item_subcategory_id, $item_price, $item_producer_id, $item_photo)
    {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->item_description = $item_description;
        $this->item_category_id = $item_category_id;
        $this->item_subcategory_id = $item_subcategory_id;
        $this->item_price = $item_price;
        $this->item_producer_id = $item_producer_id;
        $this->item_photo = $item_photo;
    }
}

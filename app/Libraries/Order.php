<?php

namespace App\Libraries;

class Order{
    public $order_id;
    public $order_product;
    public $order_client_id;
    public $order_shipping;
    public $order_amount;
    public $order_address_id;
    public $order_address_type;
    public $order_date;
    public $order_status;

    public function __construct($order_id, $order_product, $order_client_id, $order_shipping, $order_amount, $order_address_id, $order_address_type, $order_date, $order_status)
    {
        $this->order_id = $order_id;
        $this->order_product = $order_product;
        $this->order_client_id = $order_client_id;
        $this->order_shipping = $order_shipping;
        $this->order_amount = $order_amount;
        $this->order_address_id = $order_address_id;
        $this->order_address_type = $order_address_type;
        $this->order_date = $order_date;
        $this->order_status = $order_status;
    }
}
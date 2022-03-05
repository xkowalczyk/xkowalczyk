<?php

namespace App\Libraries;

class Address
{
    public $address_id;
    public $address_city;
    public $address_homenumber;
    public $address_street;
    public $address_postcode;

    public function __construct($address_id, $address_City, $address_HomeNumber, $address_Street ,$address_PostCode)
    {
        $this->address_id = $address_id;
        $this->address_city = $address_City;
        $this->address_homenumber = $address_HomeNumber;
        $this->address_street = $address_Street;
        $this->address_postcode = $address_PostCode;
    }
}

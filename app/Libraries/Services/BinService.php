<?php

namespace App\Libraries\Services;


class BinService{
    
    public function __construct()
    {
        helper('cookie');
    }

    public function addItemToBin($itemId){
        if(!isset($_COOKIE['bin'])){
            setcookie('bin', $itemId.",");
            return "succes-addtobin";
        }
        
        return get_cookie('bin');
    }
}
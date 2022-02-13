<?php

namespace App\Libraries;

class User
{
    public $user_id = 0;
    public $user_name = 'null';
    public $user_lastname = 'null';
    public $user_address_id = 0;
    public $user_email = 'null';
    public $user_login = 'null';
    public $user_password = 'null';
    public $user_permission = 'null';

    public function __construct($user_id, $user_name, $user_lastname, $user_address_id, $user_email, $user_login, $user_password, $user_permission)
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_lastname = $user_lastname;
        $this->user_address_id = $user_address_id;
        $this->user_email = $user_email;
        $this->user_login = $user_login;
        $this->user_password = $user_password;
        $this->user_permission = $user_permission;
    }
}

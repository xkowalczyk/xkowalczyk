<?php

namespace App\Controllers;

use App\Models\UserAddressModel;
use App\Libraries\Services\UserService;
use App\Libraries\Services\AuthService;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class Classtest extends Controller
{
    private $testSystem;

    public function __construct()
    {
        $this->testSystem = new UserService();
        $this->testSystems = new AuthService();
    }

    public function index()
    {
        $email = \Config\Services::email();
        $email->setFrom('test@gmail.com' ,'Maciej Kowalczyk');
        $email->setTo('ytmrhc@gmail.com');
        $email->setSubject('test');
        $email->setMessage('test');
        if ($email->send()){
            echo "true";
        } else {
            echo "false";
        };
    }

    public function test()
    {
        print_r($this->testSystem->registerCheck('ytmrhc@gmail.com'));
        //print_r($this->testSystems->checkLoginUser('ytmrhc@gmail.com'));
        //$this->testSystem->putAddress('testm', 'testmm', 'testh', 'tests', 'testp');
        //return redirect()->to(base_url('login'));
    }
}

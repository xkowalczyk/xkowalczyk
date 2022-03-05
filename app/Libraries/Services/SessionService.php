<?php

namespace App\Libraries\Services;

class SessionService
{
    private $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function setSession($sessionTag, $sessionValue)
    {
        $this->session->set($sessionTag, $sessionValue);
    }

    public function getAllSession()
    {
        return $this->session->get();
    }

    public function getSingleSession($sessionTag)
    {
        return $this->session->get($sessionTag);
    }

    public function updateSession()
    {
    }

    public function removeSession($sessionTag)
    {
        $this->session->remove($sessionTag);
    }

    public function checkIssetSession($sessionTag)
    {
        return $this->session->has($sessionTag);
    }

    public function setFlashData($dataTag, $dataValue){
        $this->session->setFlashData($dataTag, $dataValue);
    }
}

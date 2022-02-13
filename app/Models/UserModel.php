<?php

namespace App\Models;

use App\Libraries\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    private $dbConnect;

    private function getConnect($table)
    {
        $this->dbConnect = \Config\Database::connect();
        $this->builder = $this->dbConnect->table($table);
    }

    public function getUser($userEmail)
    {
        $this->getConnect('user');
        $this->builder->select();
        $this->builder->where('user_email', $userEmail);
        $query = $this->builder->get();
        $response = $query->getResultArray();

        foreach ($response as $userData) {
            $user = new User($userData['user_id'], $userData['user_name'], $userData['user_lastname'], $userData['user_address_id'], $userData['user_email'], $userData['user_login'], $userData['user_password'], $userData['user_permission'],);
        }

        return $user;
    }

    public function getPassword($userEmail)
    {
        return $this->getUser($userEmail)->user_password; 
    }


    public function checkUser($userEmail)
    {
        if ($this->checkConfirm($userEmail) == 'error_noconfirm') {
            return ['error_checkuser_confirm',false];
        } else if ($this->checkBlackList($userEmail) == 'error_blacklist') {
            return ['error_checkuser_blacklist', false];
        } else if ($this->checkRegister($userEmail) == 'error_noregister') {
            return ['error_checkuser_register', false];
        } else {
            return ['succes_checkuser', true];
        }
    }

    public function checkRegister($userEmail)
    {
        $this->getConnect('user');
        $this->builder->selectCount('user_id');
        $this->builder->where('user_email', $userEmail);
        $query = $this->builder->get();
        $response = $query->getRow();
        if ($response->user_id == 0) {
            return 'error_noregister';
        } else {
            return 'succes_registercheck';
        }
    }

    public function checkConfirm($userEmail)
    {
        $this->getConnect('confirmation');
        $this->builder->select('confirmation_status');
        $this->builder->where('confirmation_user_email', $userEmail);
        $query = $this->builder->get();
        $response = $query->getRow();

        if ($response->confirmation_status == 0) {
            return 'error_noconfirm';
        } else {
            return 'succes_confirmcheck';
        }
    }

    public function checkBlackList($userEmail)
    {
        $this->getConnect('user_blacklist');
        $this->builder->selectCount('blacklist_id');
        $this->builder->where('blacklist_user_email', $userEmail);
        $query = $this->builder->get();
        $response = $query->getRow();
        if ($response->blacklist_id == 1) {
            return 'error_issetblacklist';
        } else {
            return 'succes_blacklistcheck';
        }
    }
}

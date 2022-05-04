<?php

namespace App\Models;
use CodeIgniter\Model;

class StatuteModel extends Model
{
    protected $table = 'statute';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getStatute()
    {
        $this->getConnect();
        $this->builder->select()->where('statute_id', 0);
        return $this->builder->get();
    }

    public function editStatute($statute)
    {
        $this->getConnect();
        $this->builder->where('statute_id', 0);
        $this->builder->update(array('statute' => $statute));
        $this->builder->get();
    }
}
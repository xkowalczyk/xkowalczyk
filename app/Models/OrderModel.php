<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    private $dataBaseConnect;

    private function getConnect()
    {
        $this->dataBaseConnect = \Config\Database::connect();
        $this->builder = $this->dataBaseConnect->table($this->table);
    }

    public function getAllOrders()
    {
        $this->getConnect();
        $this->builder->select();
        return $this->builder->get();
    }

    public function getUserOrders($userId)
    {
        $this->getConnect();
        $this->builder->select()
            ->where('order_client_id', $userId);
        return $this->builder->get();
    }

    public function getSingleOrder($orderId)
    {
        $this->getConnect();
        $this->builder->select()
            ->where('order_id', $orderId);
        return $this->builder->get();
    }

    public function addOrder($orderParameters)
    {
        $this->getConnect();
        $this->builder->insert($orderParameters);
    }

    public function editOrder($orderId, $orderParameters)
    {
        $this->getConnect();
        $this->builder->where('order_id', $orderId);
        $this->builder->update($orderParameters);
        $this->builder->get();
    }
}

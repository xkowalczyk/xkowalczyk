<?php

namespace App\Libraries\Services;

use App\Libraries\Order;
use App\Models\OrderModel;

class OrderService{

    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    private function convertToArrayOrder($mysqlObject)
    {
        $convertArrayObject = $mysqlObject->getResultArray();
        $userArray = array();
        $arrayIndex = 0;
        foreach ($convertArrayObject as $object) {
            $userArray[$arrayIndex] = new Order(
                $object['order_id'],
                $object['order_product'],
                $object['order_client_id'],
                $object['order_shipping'],
                $object['order_date'],
                $object['order_status']
            );
            $arrayIndex++;
        }

        return $userArray;
    }

    private function convertToArray($mysqlObject)
    {
        return $mysqlObject->getResultArray();
    }

    public function getAllOrders(){
        return $this->convertToArrayOrder($this->orderModel->getAllOrders());
    }

    public function getUserOrders($userId){
        return $this->convertToArrayOrder($this->orderModel->getuserOrders($userId));
    }

    public function getSingleOrder($orderId){
        return $this->convertToArrayOrder($this->orderModel->getSingleOrder($orderId));
    }

    public function editOrder($orderId, $orderParameters){
        $this->orderModel->editOrder($orderId, $orderParameters);
    }
}
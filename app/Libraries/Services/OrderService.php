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
                $object['order_amount'],
                $object['order_address_id'],
                $object['order_address_type'],
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

    public function editOrderStatus($orderId, $orderStatus)
    {
        $data = array(
            'order_status' => $orderStatus
        );

        $this->orderModel->editOrder($orderId ,$data);
    }

    public function putNewOrder($orderProduct, $orderClientId, $orderShipping, $orderDate, $orderStatus, $orderAmount, $orderAddressId, $orderAddressType)
    {
        $data = array(
            'order_product' => $orderProduct,
            'order_client_id' => $orderClientId,
            'order_shipping' => $orderShipping,
            'order_address_id' => $orderAddressId,
            'order_address_type' => $orderAddressType,
            'order_amount' => $orderAmount,
            'order_date' => $orderDate,
            'order_status' => $orderStatus,
        );

        $this->orderModel->putNewOrder($data);
    }

    public function getNewOrderId()
    {
        $allOrders = $this->getAllOrders();
        return $newOrderId = end($allOrders)->order_id;
    }
}
<?php

// require '../config.php';

class Admin
{
    private $conn;

    public function __construct()
    {
        global $db;
        $this->conn = $db;
    }

    public function getUsers()
    {
        $selectQuery = 'select * from users where role="1"';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getAllUsers()
    {
        $selectQuery = 'select * from users';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getOrders()
    {
        $selectQuery =
            "SELECT sum(total_price) as total_price,user_name,users.user_id FROM orders JOIN users on orders.user_id = users.user_id GROUP BY user_id";
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getOrderedProducts($order_id)
    {
        $selectQuery = 
            'SELECT products.product_name , products.image , products.price , order_product.product_amount from order_product join products on products.product_id = order_product.product_id where order_product.order_id ='.$order_id.'';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getOrderData($userId)
    {
        $selectQuery = 'SELECT * FROM orders where user_id = '.$userId.'';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }
}

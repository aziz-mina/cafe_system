<?php

require_once '../config.php';

class order
{
    private $order_state;
    private $order_notes;
    private $order_date;
    private $total_price;
    private $room_number;
    private $user_id;
    private $productID;
    private $product_amount;

    public function setOrderNotes($_notes)
    {
        $this->order_notes = $_notes;
        echo ($this->order_notes);
    }

    public function setOrderDate($_date)
    {
        $this->order_date = $_date;
        echo ($this->total_price);
    }

    public function setTotalPrice($_total_Price)
    {
        $this->total_price = $_total_Price;
        echo ($this->total_price);
    }
    public function setRoomNumber($_room)
    {
        $this->room_number = $_room;
        echo ($this->room_number);
    }
    public function setUserId($_userid)
    {
        $this->user_id = $_userid;
        echo ($this->user_id);
    }

    public function setOrderAmount($_product_amount)
    {
        $this->product_amount = $_product_amount;
    }

    public function displayAllOrders()
    {
        global $db;
        $result = mysqli_query($db, "SELECT order_id  , date  , ext   ,total_price, state, user_name , image From orders , users where orders.user_id = users.user_id   GROUP BY order_id order by order_id desc");
        return $result;
    }


    public function displayOrders($user_id)
    {
        global $db;
        $result = mysqli_query($db, "SELECT users.user_name,orders.date ,orders.state,
            products.price,order_product.product_amount,products.image
            , orders.total_price ,orders.order_notes ,products.product_name,orders.order_id
            from orders inner join users on users.user_id=orders.user_id
            INNER JOIN order_product on order_product.order_id=orders.order_id 
            INNER JOIN products on order_product.product_id=products.product_id 
            where orders.user_id={$user_id}");
            return $result;
    }
            
    public function displayOrdersAdmin($date)
    {
        global $db;
        $result=mysqli_query($db,"SELECT orders.date ,orders.state,
        products.price,order_product.product_amount,products.image
        , orders.total_price ,orders.order_notes ,products.product_name,orders.order_id,users.user_name
        from orders INNER JOIN order_product on order_product.order_id=orders.order_id 
        INNER JOIN products on order_product.product_id=products.product_id 
        INNER JOIN users on orders.user_id =users.user_id
        where  DATE(orders.date)='{$date}'        
        ");
                
        return $result;
    }

    public function cancelOrder($order_id)
    {
        global $db;
        $result=mysqli_query($db,"DELETE FROM `orders` WHERE order_id={$order_id}");
        return $result;
    }
        
    public function changeStatus ($status,$order_id)
    {
        global $db;
        $result=mysqli_query($db,"UPDATE `orders` SET `state`='{$status}'  WHERE order_id={$order_id}");
        echo $result;
            
    }

    public function add_Order()
    {
        global $db;
        $order_notes = mysqli_escape_string($db, $this->order_notes);
        $total_price = mysqli_escape_string($db, $this->total_price);
        $room_number = mysqli_escape_string($db, $this->room_number);
        $user_id = mysqli_escape_string($db, $this->user_id);

        $result = mysqli_query($db, "INSERT INTO orders SET
        `order_notes` = '$order_notes',
        `state` = 'ordered',
        `total_price` = '$total_price',
        `room_number` = '$room_number',
        `user_id` = $user_id");

        echo ("INSERT INTO orders SET
        `order_notes` = '$order_notes',
        `state` = 'ordered' ,
        `total_price` = $total_price,
        `room_number` = $room_number,
        `user_id` = $user_id");

        return mysqli_insert_id($db);
    }



    public function Order_Product($orderId, $productId, $productaAmount)
    {
        global $db;
        $result = mysqli_query($db, "INSERT INTO order_product SET order_id = '$orderId' ,
             product_id = '$productId', product_amount = '$productaAmount'");
        echo ("INSERT INTO order_product SET order_id = '$orderId' ,
         product_id = '$productId', product_amount = '$productaAmount'");

        return ($result) ? true : false;
        echo ($result);
    }
}


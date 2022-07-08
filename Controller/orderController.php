<?php
require_once '../config.php';
if (isset($_SESSION['id'])) 
{
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
}
else 
{
    header("Location:login.php");
}
if (isset($_POST['addOrder'])) 
{
    $addOrder = new order();
    $addOrder->setUserId($userId);
    $addOrder->setRoomNumber($_POST['room_number']);
    $addOrder->setOrderNotes($_POST['order_notes']);
    $addOrder->setTotalPrice($_POST['to_Price']);
    $products = $_POST['ordersProducts'];
    $productsarr = explode(",", $products);
    $vals = array_count_values($productsarr);
    $OrderAmount = (array_values($vals));
    $prods = (array_keys($vals));
    $OrderId = $addOrder->add_Order();
    for ($i = 0; $i < count($prods); $i++) 
    {
        echo ("<br>");
        $addOrder->Order_Product($OrderId, $prods[$i], $OrderAmount[$i]);
        echo ("<br>");
    }
    header("Location:../Views/DisplayOrders.php");

} 

else if (isset($_POST['addOrdermanually'])) 
{
    $addOrder = new order();
    $addOrder->setUserId($_POST['user_id']);
    $addOrder->setRoomNumber($_POST['room_number']);
    $addOrder->setOrderNotes($_POST['order_notes']);
    $addOrder->setTotalPrice($_POST['to_Price']);
    $products = $_POST['ordersProducts'];
    $productsarr = explode(",", $products);
    $vals = array_count_values($productsarr);
    $OrderAmount = (array_values($vals));
    $prods = (array_keys($vals));
    echo ("<br>");
    $OrderId = $addOrder->add_Order();
    echo("<br>");
    for ($i = 0; $i < count($prods); $i++) 
    {
        echo ("<br>");
        $addOrder->Order_Product($OrderId, $prods[$i], $OrderAmount[$i]);
        echo ("<br>");
    }
    header("Location:../Views/DisplayOrdersAdmin.php");
}
else if(isset($_GET['state']))
{
    $order1=new order();
    $order1->changeStatus($_GET['state'],$_GET['orderId']);
    if($order1)
    {
        header("location:../Views/DisplayOrdersAdmin.php");
    }
    else
    {
        header("location:../Views/DisplayOrdersAdmin.php");
    }
}
else if($_GET['id'])
{
    $order1=new order();
    $result=$order1->cancelOrder($_GET['id']);
    if($result)
    {
        if($_SESSION['role'] =='user' )
        {
            header("location:../Views/DisplayOrders.php");
        }
        else
        {
            header("location:../Views/DisplayOrdersAdmin.php");
        }
        
    }
    else
    {
        echo "Error";
    }

}
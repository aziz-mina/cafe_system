<?php
require '../config.php';
if(isset($_SESSION['id']))
{
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
}
else
{
    header("Location:index.php");
}

$errorArray=[];

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($db)
{
    
    if(isset($_POST['login']))
    {
        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errorArray[]="email";
        }
        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errorArray[]="password";
        }
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorArray[] = "Invalid";
        }
        if(count($errorArray)>0)
        {
            header("Location:../Views/index.php?error=".implode(",",$errorArray));    
        }
        else
        {
            $email=$_POST['email'];
            $password=md5($_POST['password']);
           // $password=password_hash($password,PASSWORD_DEFAULT);
            $result= mysqli_query($db,"select * from users where email='$email' and password='$password'");
            if($result->num_rows > 0)
            {
                foreach($result as $row)
                {
                   if($row['role'] == '1') // is Admin
                   {
                        session_start();
                        $_SESSION['username']=$row['user_name'];
                        $_SESSION['img']=$row['image'];
                        $_SESSION['email']=$email;
                        $_SESSION['role']='admin';
                        header("Location:../Views/DisplayOrdersAdmin.php");
                        exit;
                   }
                   else if ($row['role'] == '0') // is User
                   {
                        session_start();
                        $_SESSION['username']=$row['user_name'];
                        $_SESSION['img']=$row['image'];
                        $_SESSION['id']=$row['user_id'];
                        $_SESSION['email']=$email;
                        $_SESSION['role']='user';
                        header("Location:../Views/DisplayOrders.php");
                        exit;
                   }
                }
            }
            else
            {
                header("Location:../Views/index.php?error=Invalid");
            }
        }
    }
    else if(isset($_GET['action']) && $_GET['action']=="logout")
    {
        session_destroy();
        header("Location:../Views/");
    }
}
else
{
    echo "Error connecting to DB";
}

?>
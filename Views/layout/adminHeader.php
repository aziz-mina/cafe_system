<?php
require_once("../Controller/functions.php");

require_once("../config.php");

    if ($_SESSION['role']!='admin')
    {
        header("Location:./");
    }   
?>


<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&family=Montserrat:wght@300;400&family=Outfit:wght@300&family=Poppins:wght@300" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../Public/css/style.css">
<link rel="shortcut icon" href="../Public/images/logo__.png" type="image/x-icon" />
<link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"rel="stylesheet"crossorigin="anonymous"integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fad fa-mug"></i> Cafe Project</a>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbarshadow" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" >
            <li class="nav-item active" >
                <a class="nav-link" href="DisplayOrdersAdmin.php"><i class="far fa-clock"></i> Latest Orders <span class="sr-only">(current)</span></a>
            </li>         
            <li class="nav-item active">
                <a class="nav-link" href="listProduct.php"><i class="far fa-mug"></i> Products</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="addProduct.php"><i class="far fa-plus"></i> Add Product</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="listUsers.php"><i class="far fa-user"></i> Users</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="addUser.php"><i class="far fa-user-plus"></i> Add User</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="addOrderManually.php"> <i class="far fa-check"></i> Manual Order</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="checks.php"><i class="far fa-list"></i> Checks</a>
            </li>
        </ul>
         <img src="../uploads/<?php echo $_SESSION['img'] ?>"style="width:38px;height:38px">
        <a  href="../Controller/authController.php?action=logout" style="text-decoration:none;color:black"><i class="far fa-sign-out"></i> Logout  </a>
    </div>
</nav>
<br>
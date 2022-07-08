<?php
    require '../config.php';
    $errordata=[];
    if(isset($_GET["error"]))
    {
        $errordata=explode(',',$_GET["error"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cafe | Login </title>
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"rel="stylesheet"crossorigin="anonymous"integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&family=Montserrat:wght@300;400&family=Outfit:wght@300&family=Poppins:wght@300" rel="stylesheet">
    <link rel="stylesheet" href="../Public/css/bootstrap.css">
    <link rel="stylesheet" href="../Public/css/login.css">
</head>
<body>
    <div class="wrap">
        <form class="login-form" action="../Controller/authController.php" method="POST">
            <div class="form-header">
                <img class="logo" src="../Public/images/logo.png">
                <h3>Cafe Project</h3>
            </div>
        
            <div class="form-group">
                <input type="text" class="form-input" placeholder="name@example.com" name="email" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" placeholder="password" name="password" required>
            </div>

            <div class="form-group">
                <button class="btn btn-success d-block form-control" type="submit" name="login"><i class="far fa-sign-in"></i> Login </button>
            </div>
                <h6 style="font-size:13px ; text-align:center" >Developed By <i style="color:red" class="fa fa-heart"></i> Mina Isaac</h6>
            <span>
            <?php
                if(isset($_GET["error"]))
                {
                    echo "<div class='alert alert-danger text-center' style='font-size:13px'><i class='fas fa-exclamation-triangle'></i> Wrong Email or password</div>  ";
                }
            ?>
            </span>
        </form>
    </div>
</body>
</html>
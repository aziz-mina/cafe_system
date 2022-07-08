<?php
    $errordata=[];
    if(isset($_GET["error"]))
    {
        $errordata=explode(',',$_GET["error"]);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="../Public/css/forms.css" rel="stylesheet">
</head>
    <body>
        <?php include 'layout/adminHeader.php';?>
        <form class="login-form" action="../Controller/userController.php" method="POST" enctype="multipart/form-data">
            <div class="form-header">
                <br><h4 class="text-center">Add New User</h4><br>
            </div>
            <div class="form-group">
                <input type="text" class="form-input" placeholder="User Name" name="username">
                <span> <?php if(in_array("username",$errordata))echo "  *User Name is empty";?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-input" placeholder="email@example.com" name="email">
                <span> 
                    <?php 
                        if(in_array("email",$errordata))echo "  *Email is empty";
                        elseif(in_array("Invalid",$errordata))echo "  *Invalid Email";
                    ?>
                </span>            
            </div>
            <div class="form-group">
                <input type="password" class="form-input" placeholder="password" name="password">
                <span> <?php if(in_array("password",$errordata))echo "  *password is empty";?></span>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" placeholder="confirm password" name="password">
                <span> <?php if(in_array("password",$errordata))echo "  *password is empty";?></span>
            </div>

            <div class="form-group">
                <input type="text" class="form-input" placeholder="Room Number" name="room_number">
                <span> <?php if(in_array("room_number",$errordata))echo "  *Room Number is empty";?></span>
            </div>

            <div class="form-group">
                <input type="number" class="form-input" placeholder="Ext" name="ext">
                <span> <?php if(in_array("ext",$errordata))echo "  *Ext is empty";?></span>
            </div>
            <div class="form-group">
                <input type="file" class="form-input" placeholder="Ext" name="userfile">
                <span> <?php if(in_array("file",$errordata))echo "  *upload ur image";?></span>
            </div>

            <div  class="form-group">
                <button class="btn btn-primary d-block form-control" type="submit" name="add_user"><i class="far fa-plus"></i> Save User</button>
            </div>
        </form>
    </body>
</html>
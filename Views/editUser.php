<?php
    require '../config.php';
    $errordata=[];
    if(isset($_GET["error"]))
    {
        $errordata=explode(',',$_GET["error"]);
    }
    if(isset($_GET['id']))
    {
        if($db)
        {
            $result=  mysqli_query($db,"select * from users where user_id='{$_GET['id']}'");
            if($result)
            {
                $user=mysqli_fetch_assoc($result);
            }
        }
        else
        {
            echo "Error in DataBase";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cafe | Edit User</title>
    <link href="../Public/css/forms.css" rel="stylesheet">
</head>
<body>
    <?php
        include 'layout/adminHeader.php';
    ?>
    <div class="wrap">
        <form class="login-form" action="../Controller/userController.php" method="POST" enctype="multipart/form-data">
            <div class="form-header">
                <h3 class="text-center">Edit User</h3><br>
            </div>
            <div class="form-group">
                <input type="text" class="form-input" placeholder="User Name" name="username" value=<?php echo $user['user_name'];?>>
                <span> <?php if(in_array("username",$errordata))echo "  *User Name is empty";?></span>
            </div>

            <div class="form-group">
                <input type="text" class="form-input" placeholder="name@example.com" name="email" value=<?php echo $user['email'];?>>
                <span> <?php if(in_array("email",$errordata))echo "  *Email is empty";?></span>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" placeholder="password" name="password" value=<?php echo $user['password'];?>>
                <span> <?php if(in_array("password",$errordata))echo "  *password is empty";?></span>
            </div>

            <div class="form-group">
                <input type="text" class="form-input" placeholder="Room Number" name="room_number" value=<?php echo $user['room_number'];?>>
                <span> <?php if(in_array("room_number",$errordata))echo "  *Room Number is empty";?></span>
            </div>

            <div class="form-group">
                <input type="number" class="form-input" placeholder="Ext" name="ext" value=<?php echo $user['ext'];?>>
                <span> <?php if(in_array("ext",$errordata))echo "  *Ext is empty";?></span>
            </div>
            <div class="form-group">
                <input type="file" class="form-input" placeholder="Ext" name="userfile">
                <span> <?php if(in_array("file",$errordata))echo "  *upload ur image";?></span>
            </div>

            <div class="form-group">
                <button class="btn btn-primary d-block form-control" type="submit" name="update_user"><i class="fa fa-check"></i> Save</button>
            </div>
            <span>
            <?php
                if(isset($_GET["error"]))
                {
                    echo "Wrong Email or already taken";
                }
            ?>
            </span>
            <input hidden type="text" name="id" value="<?php echo $user['user_id']?>">
        </form>
    </div>
</body>
</html>
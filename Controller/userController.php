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
    if(isset($_POST['add_user']))
    {
        if(!isset($_POST['username']) || empty($_POST['username'])){
            $errorArray[]="username";
        }

        if(!isset($_POST['email']) || empty($_POST['email'])){
            $errorArray[]="email";
        }

        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errorArray[]="password";
        }

        if(!isset($_POST['room_number']) || empty($_POST['room_number'])){
            $errorArray[]="room_number";
        }

        if(!isset($_POST['ext']) || empty($_POST['ext'])){
            $errorArray[]="ext";
        }
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errorArray[] = "Invalid";
        }
        if(count($errorArray)>0)
        {
            echo "not valid";
            header("Location:../Views/addUser.php?error=".implode(",",$errorArray));
        }
        else
        {
            $username=mysqli_escape_string($db,$_POST['username']);
            $email=mysqli_escape_string($db,$_POST['email']);
            $pass=mysqli_escape_string($db,$_POST['password']);
            $password = md5($pass);
            $room_number=mysqli_escape_string($db,$_POST['room_number']);
            $ext=mysqli_escape_string($db,$_POST['ext']);
            
            $tempName = $_FILES['userfile']['tmp_name'];
            $fileName = $_FILES['userfile']['name'];
            if($fileName){
                //upload image with user data
                if ($_FILES['userfile']['error'] > 0) 
                { 
                    echo 'Problem: ';
                    switch ($_FILES['userfile']['error']) {
                        case 1: 
                            echo 'File exceeded upload_max_filesize';
                            break;
                        case 2: 
                            echo 'File exceeded max_file_size'; 
                            break; 
                        case 3: 
                            echo 'File only partially uploaded';
                            break;
                        case 4: 
                            echo 'No file uploaded';
                            break; 
                        case 6: 
                            echo 'Cannot upload file: No temp directory specified'; 
                            break; 
                        case 7: 
                            echo 'Upload failed: Cannot write to disk'; 
                            break; 
                    } 
                    exit; 
                }
                $upfile = '../uploads/'.$_FILES['userfile']['name'] ; 
                if (is_uploaded_file($_FILES['userfile']['tmp_name']))
                {  
                    if (!move_uploaded_file ( $_FILES['userfile']['tmp_name'] , $upfile ))
                    { 
                        echo 'Problem: Could not move file to destination directory'; 
                        exit; 
                    } 
                    else 
                    { 
                        $result= mysqli_query($db,"insert into users set
                        user_name='$username', email='$email',
                        password='$password', room_number ='$room_number',
                        ext='$ext', image='$upfile'");
                
                        if($result)
                        {
                            header("Location:../Views/listUsers.php");
                        }
                        else
                        {
                            header("Location:../Views/addUser.php?error=wrongEntry");
                        }
                    } 
                    
                }
            }
            else
            {
                //insert data without image
                $result= mysqli_query($db,"insert into users set
                user_name='$username',email='$email',password='$password'
                ,room_number ='$room_number',ext='$ext'");
                if($result)
                {
                    header("Location:../Views/listUsers.php");
                }
                else
                {
                    header("Location:../Views/addUser.php?error=wrongEntry");
                }
            }
        }
    }
    if(isset($_POST['update_user']))
    {
        if(!isset($_POST['username']) || empty($_POST['username'])){
            $errorArray[]="username";
        }

        if(!isset($_POST['email']) || empty($_POST['email'])){
            $errorArray[]="email";
        }

        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errorArray[]="password";
        }

        if(!isset($_POST['room_number']) || empty($_POST['room_number'])){
            $errorArray[]="room_number";
        }

        if(!isset($_POST['ext']) || empty($_POST['ext'])){
            $errorArray[]="ext";
        }

        if(count($errorArray)>0)
        {
            echo "not valid";
            header("Location:../Views/index.php?error=".implode(",",$errorArray)); 
        }
        else
        {
            $id=mysqli_escape_string($db,$_POST['id']);
            $username=mysqli_escape_string($db,$_POST['username']);
            // $email=mysqli_escape_string($connect,$_POST['email']);
            $password=mysqli_escape_string($db,$_POST['password']);
            $room_number=mysqli_escape_string($db,$_POST['room_number']);
            $ext=mysqli_escape_string($db,$_POST['ext']);
            // upload file
            $tempName = $_FILES['userfile']['tmp_name'];
            $fileName = $_FILES['userfile']['name'];
            if($fileName){
                //upload image with user data
                if ($_FILES['userfile']['error'] > 0) { 
                    echo 'Problem: ';
                    switch ($_FILES['userfile']['error']) {
                        case 1: 
                            echo 'File exceeded upload_max_filesize';
                            break;
                        case 2: 
                            echo 'File exceeded max_file_size'; 
                            break; 
                        case 3: 
                            echo 'File only partially uploaded';
                            break;
                        case 4: 
                            echo 'No file uploaded';
                            break; 
                        case 6: 
                            echo 'Cannot upload file: No temp directory specified'; 
                            break; 
                        case 7: 
                            echo 'Upload failed: Cannot write to disk'; 
                            break; 
                    } 
                    exit; 
                }
                $upfile = '../uploads/'.$_FILES['userfile']['name'] ; 
                if (is_uploaded_file($_FILES['userfile']['tmp_name']))
                {  
                    if (!move_uploaded_file ( $_FILES['userfile']['tmp_name'] , $upfile ))
                    { 
                        echo 'Problem: Could not move file to destination directory'; 
                        exit; 
                    } 
                    else 
                    { 
                        $result= mysqli_query($db,"update users set
                        user_name='$username', password='$password',
                        room_number ='$room_number', ext='$ext',
                        image='$upfile' where user_id ='$id'");
                            
                        if($result)
                        {
                            header("Location:../Views/listUsers.php");
                        }
                        else
                        {
                            header("Location:../Views/listUsers.php");
                        }
                    } 
                    
                }
            }
            else
            {
                // update data without image
                $result= mysqli_query($connect,"update users set
                    user_name='$username',
                    password='$password',
                    room_number ='$room_number',
                    ext='$ext' where user_id ='$id'");
                if($result)
                {
                    header("Location:../Views/listUsers.php");
                }
                else
                {
                    header("Location:../Views/listUsers.php");
                }
            }
        }
    }
    elseif(isset($_GET['id']))
    {
        $userId = $_GET['id'];
        $result=  mysqli_query($db,"delete from users where user_id='{$userId}'");
        if($result)
        {
            header("Location:../Views/listUsers.php");
        }
    }
}
else
{
    echo "Error connecting to DB";
}

?>
<?php
require_once '..' . DIRECTORY_SEPARATOR . 'config.php'; 
 $errorArray = [];
 $statusMsg = [];
        if($db)
        {
            if(isset($_POST['add_product']))
            {
                $productName = $_POST["productName"] ;
                $productPrice = $_POST["price"];
                $productCategory=$_POST["category"];
                $productPicture = $_POST["file"];
                if(!isset($_POST["productName"]) || empty($productName))
                {
                    $errorArray[]="productName"; 
                    echo "name not set";            
                }
                if(!isset($_POST["price"]) || empty($productPrice))
                {
                    $errorArray[]="productPrice";  
                    echo "price not set";            
                }
                if(!isset($_POST["category"]) || empty($productCategory))
                {
                    $errorArray[]="productCategory";        
                    echo"cat not set";      
                }

                    $targetDir = "../uploads/";
                    $fileName = basename($_FILES['file']['name']);
                    $targetFilePath = $targetDir.$fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(isset($_POST["add_product"]) && !empty($_FILES["file"]["name"]))
                    {
                        $allowTypes = array('jpg','png','jpeg','gif','pdf');
                        if(in_array($fileType, $allowTypes))
                        {
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){                
                            }
                            else
                            {
                                $statusMsg []= "Sorry, there was an error uploading your file";
                            }
                        }
                        else
                        {
                            $statusMsg [] = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload";

                        }
                    }
                    else
                    {
                        $statusMsg [] = "Please select a file to upload";
                        
                    }   
                if(count($errorArray)>0)
                {
                    var_dump(count($errorArray));
                    header("Location:../Views/addProduct.php?error=".implode(",",$errorArray));
                }
                else if(count($statusMsg)>0)
                {
                    header("Location:../Views/addProduct.php?imgerror=".implode(",",$statusMsg));

                }
                else
                {          
                    $productName = trim($_POST['productName']);
                    $product = new Product();  
                    $res = $product->addProduct($productName,$productPrice,$productCategory,$fileName);
                    if($res)
                    {
                        header("Location:../Views/listProduct.php");
                    }
                    else
                    {
                        echo "Error";
                    }
                }
            }
            elseif(isset($_POST['update_product']))
            {
                $id = $_POST['id'];
                $productName = $_POST["proname"] ;
                $productPrice = $_POST["price"];
                $productCategory=$_POST["category"];
                $productPicture = $_FILES["file"];
                $productAvilable = $_POST["avilable"];
                $targetDir = "../uploads/";
                $fileName = basename($_FILES['file']['name']);
                $targetFilePath = $targetDir.$fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(isset($_POST["update_product"]) && !empty($_FILES["file"]["name"]))
                {
                    $allowTypes = array('jpg','png','jpeg','gif','pdf');
                    if(in_array($fileType, $allowTypes))
                    {
                        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){                
                        }
                        else
                        {
                            $statusMsg [] = "Sorry, there was an error uploading your file";
                        }
                    }
                    else
                    {
                        $statusMsg [] = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload";

                    }
                }
                else
                {
                    $statusMsg [] = "Please select a file to upload";
                    
                }   
                if(count($errorArray)>0)
                {
                    var_dump(count($errorArray));
                    header("Location:../Views/editProduct.php?error=".implode(",",$errorArray));
                }
                else if(count($statusMsg)>0)
                {
                    header("Location:../Views/editProduct.php?id=".$id."&imgerror=".implode(",",$statusMsg));

                }
                else
                {          
                    $productName = trim($_POST['proname']);
                    $product = new Product();  
                    $res = $product->editProduct($id,$productName,$productPrice,$productCategory,$fileName, $productAvilable);
                    if($res)
                    {
                        header("Location:../Views/listProduct.php");
                    }
                    else
                    {
                        echo "Error";
                    }
                }    
                
            }
            elseif(isset($_GET['delete']))
            {
                $productId = $_GET['delete'];
                $product = new product();
                $result = $product->deleteProduct($productId);
                if($result)
                {
                    header("Location:../Views/listProduct.php");
                }
                else
                {
                    echo "Error";
                }
            }
            
        }
?>
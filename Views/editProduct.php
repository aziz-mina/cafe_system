<?php
    require '../config.php';
    if(isset($_GET['id']))
    {
        if($db)
        {
            $result=  mysqli_query($db,"select * from products where product_id ='{$_GET['id']}'");
            if($result)
            {
                $product=mysqli_fetch_assoc($result);
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
    <title>Cafe | Edit Product</title>
    <link href="../Public/css/forms.css" rel="stylesheet">
</head>
    <body>
        <?php
            include 'layout/adminHeader.php';
        ?>
        <div class="wrap">
            <form class="login-form" action="../Controller/productController.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    <h3 class="text-center">Edit Product</h3><br>
                </div>
            
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Product name" name="proname" value=<?php echo $product['product_name'];?> required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-input" placeholder="product price" name="price" value=<?php echo $product['price'];?> required>
                </div>

                <div class="form-group">
                    <select  class="form-input" name="category" required>
                        <option >Please Select Category</option>
                        <option value="Cold Drinks" <?php if($product['category']=="Cold Drinks") echo 'selected="selected"'; ?> >Cold Drinks</option>
                        <option value="Hot Drinks" <?php if($product['category']=="Hot Drinks") echo 'selected="selected"'; ?> >Hot Drinks</option>
                        <option value="Fresh Juice" <?php if($product['category']=="Fresh Juice") echo 'selected="selected"'; ?> >Fresh Juice</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-input" name="avilable" required>
                        <option >Choose Avilability</option>
                        <option value="0" <?php if($product['avilable']=="0") echo 'selected="selected"'; ?> >Not avilable</option>
                        <option value="1" <?php if($product['avilable']=="1") echo 'selected="selected"'; ?> >avilable</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="file" class="form-input" placeholder="image" name="file" required>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary d-block form-control" type="submit" name="update_product"><i class="fa fa-check"></i> Save</button>
                </div>
                <input hidden type="text" name="id" value="<?php echo $product['product_id']?>">
            </form>
        </div>
    </body>
</html>
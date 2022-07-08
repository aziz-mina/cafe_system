<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../Public/css/forms.css" >
    <title>Cafe | Add Product</title>
</head>
<body>
    <?php
    include 'layout/adminHeader.php';
    $errordata = [];
    $stateMsg;
    if (isset($_GET["error"]))
    {
        $errordata = explode(',', $_GET["error"]);
    }
    if (isset($_GET["imgerror"]))
    {
        $stateMsg = $_GET["imgerror"];
    }
    ?>
    <div class="container">
        <div>
            <h4 class="text-center">Add New Product</h4>
        </div>
        <br>
        <form action="../Controller/productController.php" class="login-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-input" type="text" name="productName" placeholder="Enter Product Name" />
                <span style="display:inline;"> <?php if (in_array("productName", $errordata)) echo "<p style='color:red;'>*Please Enter a Valid Name</p>"; ?></span>
            </div>
            <div class="form-group">
                <input class="form-input" name="price" type="number" min="5.00" max="500.00" placeholder="Enter Price">
                <span style="display:inline;"> <?php if (in_array("productPrice", $errordata)) echo "<p style='color:red;'>* Price is empty</p>"; ?></span>
            </div>
            <div class="form-group">
                <select class="form-input" name="category">
                    <option value="" selected disabled hidden>Choose Category</option>
                     <?php
                        $categories = new category();
                        $cats=$categories->getCategories(); 
                        while ($row = mysqli_fetch_assoc($cats)) 
                        {
                            echo'<option value='.$row['category'].'>'.$row['category'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input class="form-input" type="file" name="file" >
                <span style="display:inline;color:red"><?php if(!(empty($stateMsg))){ echo"$stateMsg";} ?></span>
            </div>
            <div class="form-group">
                <button type="submit" name="add_product" value="add" class="btn btn-primary d-block form-control"><i class="far fa-plus"></i> Add Product</button>
            </div>
        </form>
    </div>
</body>
</html>
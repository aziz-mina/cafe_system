<?php 

class product
{
    private $product_id;
    private $product_name;
    private $price;
    private $image;
    private $category;
    
    public function setProductName($_name)
    {
        $this->product_name = $_name;
    }
    public function getProductName()
    {
        return $this->product_name;
    }
    public function setProductPrice($price)
    {
        $this->price = $price ;
    }
    public function getProductPrice()
    {
        $this->price;
    }
    public function setProductImage($img)
    {
        $this->image =$img;
    }
    public function getProductImage()
    {
        return $this->image ;
    }
    public function setProductCategory($cat)
    {
        $this->category = $cat;
    }
    public function getProductCategory()
    {
        return $this->category;
    }
    public function addProduct($name ,$price,$cat,$pic)
    {
        global $db;
        $result = mysqli_query($db,"insert into products(product_name,price,category,image) 
        values('{$name}',{$price},'{$cat}','{$pic}')");
        return $result;
    }

    public function editProduct($id,$name ,$price,$cat,$pic,$avilable)
    {
        global $db;
        $result = mysqli_query($db,"update products set product_name = '$name' , price ='$price', category = '$cat' ,image = '$pic' , avilable='$avilable' where product_id='$id'") ;
        return $result;
    }

    public function listAllProducts()
    {
        global $db;
        $result = mysqli_query($db,"select * from products");
        return $result;
    }
    public function deleteProduct($id)
    {
        global $db ;
        $result2 = mysqli_query($db,"delete from products where product_id='{$id}'");
        if($result2)
        {
            header("Location:../Views/listProduct.php");
        }
        
        else
        {
            echo "error while delete";
        }
    }
}
?>
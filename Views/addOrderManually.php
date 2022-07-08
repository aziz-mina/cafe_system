<!DOCTYPE html>
<html>
<head>
    <title>Cafe | Add Order</title>
</head>
<body>
    <?php
    include 'layout/adminHeader.php';
    $errordata = [];
    if (isset($_GET["error"]))
        $errordata = explode(',', $_GET["error"]);
    ?>
        <div class="row" style="width: 100%;text-align:center;">
            <section class="col-4" style="margin-left: 50px">
                <div style="border: 1px #B0B0B0 solid;border-radius:10px">
                    <h5 class="text-center" style="padding-top:9px">Order Details</h5>
                    <section style="height:300px;overflow: auto; border:1px solid #B0B0B0;margin:10px;text-align:center;border-radius:10px">
                        <div style="display: inline-block; margin: 10px;" class="product parent" id="parent2">
                        </div>
                    </section>
                    <hr class="divider">
                    <form id="order" action="../Controller/orderController.php" method="POST" class="form-horizontal text-info">
                        <div style="color: brown" class="form-group row">
                            <label for="" class="col-sm-1 control-label"> </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_id">
                                        <option disabled selected> Select User ..</option>
                                        <?php
                                        $admin = new Admin();
                                        $users = $admin->getUsers();
                                        while ($row = mysqli_fetch_assoc($users)) 
                                        {
                                            echo'<option value='.$row['user_id'].'>'.$row['user_name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                           </div>
                        <div style="color: brown" id="SelectedOrdersContainers">
                            <div class="form-group row">
                                <label for="" class="col-sm-1 control-label"></label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="room_number" type="number" placeholder="Room"  />
                                </div>
                            </div>
                        </div>
                        <div style="color: brown" class="form-group row">
                            <label for="" class="col-sm-1 control-label"></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="order_notes" type="text" placeholder="Enter your notes" ></textarea>
                            </div>
                        </div>
                        <hr class="divider">
                        <div style="text-align:center;color: brown">
                            <h5>Total <input id="TotalPrice" style="font-size:22px" class="col-md-2" type="text" value="0" readonly /> EGP </h5>
                        </div>
                        <input type="hidden" name="products" />
                        <br />
                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit" name="addOrdermanually"><i class="fa fa-check"></i> Order Now </button>
                        </div>
                    </form>
                </div>
            </section>
            <section id="right" class="offset-1 col-6" style="text-align: center; border: 1px #B0B0B0 solid; border-radius:10px">
                <div style="display: inline-block; margin: 10px;">
                    <p>All Products</p>
                    <hr>
                    <?php
                    $product = new product();
                    $result = $product->listAllProducts();
                    while ($row = mysqli_fetch_assoc($result)) {; ?>
                        <div style="display: inline-block; margin: 10px;">
                            <?php $pro_id = 0;
                            ?>
                            <div onclick="calculatePrice(<?php echo $row['product_id'] ?>,<?php echo $row['price'] ?>)" class="parent">
                                <div class="child" id='<?php echo $row['product_id'] ?>'>
                                    <div id="container" style="display: inline-block; margin: 10px;">
                                        <div id="product-box" style="cursor: pointer;">
                                            <input type="hidden" name="Id" value="<?php echo $row['product_id'] ?>">
                                            <img src="../uploads/<?php echo $row['image']; ?>" width="160px" height="160px" />
                                            <span style="margin-left:-12px" class="badge badge-pill badge-success"><?php echo $row['price']; ?> EGP</span>
                                            <figcaption style="margin-right:52px;padding:2px"><?php echo $row['product_name'] ?></figcaption>                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <script>
                        var arr = [];
                        var totalprice = 0;
                        var totalPrice;
                        var prod;
                        var prodinput;
                        var nu = 2;
                        //var flag = 0;

                        function calculatePrice(id, price) 
                        {
                            amou = `<span> Quantity </span><span id="amou${id}" class="badge badge-pill badge-danger"></span><hr>`;
                            //console.log(flag);
                            if (arr.includes(id)) 
                            {
                                if (!document.getElementById("amou" + id)) 
                                {
                                    nu = 2;
                                    $('#' + id).append($(amou));
                                    document.getElementById("amou" + id).innerText = nu;
                                } 
                                else 
                                {
                                    document.getElementById("amou" + id).innerText = ++nu;
                                }
                            } 
                            else 
                            {
                                $('#' + id).clone().appendTo('#parent2');
                            }
                            arr.push(id);
                            prod = arr.toString();
                            totalprice += price;
                            totalPrice = `<input type="hidden" name="to_Price" value="${totalprice}"/>`;
                            $('#order').append($(totalPrice));
                            document.getElementById("TotalPrice").value = totalprice;
                            prodinput = `<input type="hidden" name="ordersProducts" value="${prod}"/>`
                            $('#order').append($(prodinput));
                        }
                    </script>
                </div>
             </section>
         </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
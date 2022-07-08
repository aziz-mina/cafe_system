<html>
<head>
	<title>Cafe | All Product</title>
	<link href="../Public/css/loader.css" rel="stylesheet" />
</head>
<body onload="Loader()">
	<div id="loader" class="loader">
        <div id="team">BY <i class="fa fa-heart"></i> Mina Isaac </div>
    </div>
	<div id="main-div" style="display:none;">
		<?php
		include 'layout/adminHeader.php';
		require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
		if ($db) 
		{
			$prods = new product();
			$products=$prods->listAllProducts(); 
		?>
		<div>
            <br><h4 class="text-center">All products</h4>
        </div>
			<div class="container">
				<div class="wrap-table100">
					<div class="table100">
						<table class="table text-center">
							<thead>
								<tr class="table100-head">
									<th scope="col">#</th>
									<th scope="col">Product</th>
									<th scope="col">category</th>
									<th scope="col">Price</th>
									<th scope="col">Avilable</th>
									<th scope="col">Image</th>								
									<th scope="col">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								while ($row = mysqli_fetch_assoc($products)) 
								{
									$imageURL = '../uploads/' . $row['image'];
								?>
									<tr>
										<td scope="col"><?php echo $row['product_id']; ?></td>
										<td scope="col"><?php echo $row['product_name']; ?></td>
										<td scope="col"><?php echo $row['category']; ?></td>
										<td scope="col"><?php echo $row['price']; ?></td>
										<td scope="col"><?php if($row['avilable']=="1") 
										echo '<span class="badge badge-success">avilable</span>'; 
										else
										echo '<span class="badge badge-danger">Not avilable</span>'; 
										?>
										</td>

										<td scope="col">
											<?php
											echo '
										<img class="product-image" id="image"src="' . $imageURL . '" alt="" />
											
										</td>'?>
										<td scope="col"><a class="btn btn-warning" href="./editProduct.php?id=<?php echo $row['product_id'] ?>" style="color:white"><i class="fa fa-cog"></i></a>
										<a class="btn btn-danger" href="../Controller/productController.php?delete=<?php echo $row['product_id'] ;?>"><i class="far fa-trash"></i></a></td>											
									</tr> 
								<?php
								}
							} ?>	
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../Public/js/jquery-3.2.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="../Public/js/loader.js"></script>
	</body>
</html>
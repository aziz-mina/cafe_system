<html>
<head>
	<title>Cafe | My Orders</title>

</head>

<?php
	require './layout/userHeader.php';
	$orders=new order();
	$arr=array();
	$result2=$orders->displayOrders($_SESSION['id']); 
	
echo "
<body>
	<div class='box'>
		<div class='container'>
			<form method='get' action='#'>
				<div class='row'>
					<div class='input-group my-3 col-sm-3'>
						<div class='input-group-prepend'>
							<span class='input-group-text' id='dateFrom'>From</span>
						</div>
						<input type='date' class='form-control' name='datefrom' />
					</div>
					<div class='input-group my-3 col-sm-3'>
							<div class='input-group-prepend'>
								<span class='input-group-text' id='dateTo'>To</span>
							</div>
						<input type='date' class='form-control' name='dateto'/>
					</div>	
					<button type='submit' name='filter' class='btn btn-primary m-3'><i class='far fa-filter'></i> Filter Orders</button>
				</div>
			</form>
			";
			if($result2)
			{
				while($row=mysqli_fetch_assoc($result2))
				{
				$arr[]=$row;
				}
				$orders = array();
				$datefrom=0;
				$dateto=0;
				foreach ( $arr as $element )
				{
					$orders[$element['order_id']][] = $element;
					
				} 
				if(isset($_GET['filter'])&&!empty($_GET['filter']))
				{
					$datefrom=new DateTime($_GET['datefrom']);
					$dateto=new DateTime($_GET['dateto']);
					if($datefrom && $dateto)
					{
						$filteredorders=array_filter($orders,function($item) 
						{	 
							$orderdatetime=new DateTime($item[0]["date"]);
							$orderdate= new DateTime($orderdatetime->format('Y-m-d'));
							if($orderdate>= $GLOBALS['datefrom'] && $orderdate<= $GLOBALS ['dateto']) 
							{
								return true; 
							}
							  
							else 
							{
								return false;  
							}
							   
						});
					}   
				}	
				else
				{
					$filteredorders=$orders;
				}?>
				<table class='table table-striped'>
					<thead>
							<tr>
								<th scope='col'>#</th>
								<th scope='col'>Order Time</th>
								<th scope='col'>Status</th>
								<th scope='col'>Total </th>
								<th scope='col'>Action </th>
							</tr>
					</thead>
					<tbody id='accordion'>
				<?php			
					foreach ($filteredorders as $key=>$order){?>
							<tr>
							<th scope="row">
								<?php
								echo
								"<button type='button' data-toggle='collapse' data-target='#collapse{$key}' aria-expanded='true' aria-controls='collapse{$key}' class='btn btn-danger'>
									<i class='far fa-chevron-down'></i> 
								</button>";
								?>
                            </th>
							<td><?php echo '<i class="fal fa-clock"></i> '.$order[0]['date'] ; ?></td>
							<td> <span class="badge badge-pill badge-success"><?php echo $order[0]['state']; ?></span>
							</td>
							<td> <?php echo $order[0]['total_price']; ?> 
							</td>
							<td><?php 
								if ($order[0]['state']==0) {
								echo "<a class='btn btn-danger' href='../Controller/orderController.php?id={$order[0]['order_id']}'><i class='far fa-times'></i></a>";
							}?></td>
                            </tr>
							<?php
							 echo " <tr  id='collapse{$key}' class='collapse' aria-labelledby='heading{$key}' data-parent='#accordion'>";?>
							  <td colspan="4">
									<?php 
									 
									 foreach($order as $product)
									 {
									   echo "<div style='display:inline-block;padding-left:30px;'>
									   <img src='../uploads/{$product['image']}' width='150px' height='150px' />
									   <span style='margin-left:-12px;' class='badge badge-pill badge-success'>{$product['price']} EGP</span>
									   <figcaption>{$product['product_name'] }<br/> Quantity <span class='badge badge-pill badge-danger'>{$product['product_amount'] }</span></figcaption>
								  	   </div>";
									   echo "</div>";	
								   }?>
								</td>
							</tr>
						<?php } ?>
					    </tbody>
					</table>
				<?php }   ?>
			</div>		
		</div>
	</div>
	<script src="../Public/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../Public/vendor/bootstrap/js/popper.min.js"></script>							   
</body>
</html>

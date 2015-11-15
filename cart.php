<?php
	require_once "catalogue.php";

	//Reset visiting checkout
	if(!isset($_SESSION["checkoutVisit"])){
		$_SESSION["checkoutVisit"] = false;
	}

	if(isset($_POST["product"]) && $_POST["product"] != ""){
		$item = (int)$_POST["product"];
		if($item >= 0){
			$_SESSION["cart"][$catalogue[$item]->name] = new Cart($catalogue[$item], 1);
		}
	}
	else if(isset($_SESSION["cart"])){
		foreach ($_SESSION["cart"] as $key => $value){
			if(isset($_SESSION["cart"][$key])){
				$_SESSION["cart"][$key]->quantity = (int)$_POST["quantity"][$key];

				if(isset($_POST["quantity"])){
					if((int)$_POST["quantity"][$key] <= 0 || (int)$_SESSION["cart"][$key]->quantity <= 0){
						unset($_SESSION["cart"][$key]);
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - Cart</title>
		<?php require_once "css.php"; ?>
	</head>
	<body>
		<?php require_once "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron" style="margin-bottom:5px;">
				<h1>Cart <small> 
					<?php 
						if(isset($_SESSION["cart"])){ 
							echo (count($_SESSION["cart"]).(count($_SESSION["cart"]) !== 1?" Items":" Item"));
						}
					?>
				</small></h1>
			</div>
				<?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): ?>
					<form method="POST">
						<div class="row-fluid">
							<div class="content">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Item</th>
												<th>Name</th>
												<th>Quantity</th>
												<th>Price</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$total = 0;
												foreach ($_SESSION["cart"] as $key => $value):
													$subtotal = $value->product->price * $value->quantity;
													$total += $subtotal;
												?>
													<tr>
													<td>
														<img src="./img/placeholder.jpg" width="80" height="80" class="img-responsive img-thumbnail" alt="Product Image">
													</td>
													<td>
														<label class="h4"><?=$value->product->name?></label>													
													</td>
													<td>
														<input type="number" style="color: black;" min="0" max="100" name="quantity[<?=$key?>]" value="<?=$value->quantity?>">
													</td>
													<td>
														<label class="h4">$<?=$value->product->price?></label>
													</td>
													<td>
														<label class="h4 blue">$<?=$subtotal?></label>
													</td>
												</tr>
											<?php endforeach; 
												$_SESSION['costTotal'] = $total;
											?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th class="h4"><strong>Total</strong></th>
												<th class="h4 blue"><strong>$<?=$total?></strong></th>
											</tr>
										</tfoot>
									</table>
									<span class="button pull-right"><a href="checkout.php">Checkout</a></span>
									<button class="button pull-right" type="submit">Save Cart</button>
								</div>
							</div>
						</div>
					</form>
				<?php else:?>	
					<div class="row">
						<div class="col-xs-12">
							<div class="content">
								<p>Your cart is empty</p>
							</div>
						</div>
					</div>
				<?php endif ?>
		</div>
		<?php require_once "js.php"; ?>
	</body>
</html>
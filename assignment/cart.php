<?php
	$item = isset($_POST["product"])?(int)$_POST["product"]:-1;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - Cart</title>
		<?php require "css.php"; ?>
	</head>
	<body>
		<?php 
			require "navbar.php"; 
			if($item >= 0){
				$cart[] = new Cart($catalogue[$item], 1);
			}
		?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron" style="margin-bottom:5px;">
				<h1 class="yellow">Cart <small> <?php echo (count($cart).((count($cart) !== 1)?" Items":" Item"));?></small></h1>
			</div>
				<?php if(count($cart) > 0): ?>
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
											<?php foreach ($cart as $key => $value): ?>
												<tr>
													<td>
														<img src="img/placeholder.jpg" width="80" height="80" class="img-responsive img-thumbnail" alt="Product Image">
													</td>
													<td>
														<label class="h4 yellow"><?=$value->product->name?></label>													
													</td>
													<td>
														<input type="number" style="color: black;" min="0" max="100" name="quantity[<?=$key?>]" value="1">
													</td>
													<td>
														<label class="h4 yellow">$<?=$value->product->price?></label>
													</td>
													<td>
														<label class="h4 orange">$<?=($value->product->price * $value->quantity)?></label>
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
								<button class="pull-right" type="submit">Save Cart</button>
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
		<?php require "js.php"; ?>
	</body>
</html>
<?php
	$productIndex = isset($_GET["product"])?(int)$_GET["product"]:null;
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php require "css.php"; ?>
	</head>
	<body>
		<?php require "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<?php if($productIndex >= 0 && $productIndex < count($catalogue)):?>
				<div class="jumbotron" style="padding: 30px 60px; margin-bottom:5px;">
					<?php $product = $catalogue[$productIndex];?>
					<h1 class="yellow"><?=$product->name;?> <small><?=$product->category->name?></small></h1>
				</div>

				<div class="row">
					<div class="col-md-9">
						<div class="content" style="min-height: 95px;">
							<p><?=$product->description?></p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="content" style="min-height: 95px;">
							<form method="POST" action="cart.php">
								<div>
									<h2 style="display: inline; color: #f2992e;"><strong>$<?=$product->price?></strong></h2>
									<button class="pull-right" type="submit" name="product" value="<?=$productIndex?>"><i class="fa fa-cart-plus fa-lg"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php else:?>
				<div class="jumbotron">
					<h1>404 page not found.</h1>
				</div>
			<?php endif; ?>
		</div>
	<body>


		<?php require "js.php"; ?>
	</body>
</html>
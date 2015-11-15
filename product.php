<?php
	require_once "catalogue.php";

	//Reset visiting checkout
	if(!isset($_SESSION["checkoutVisit"])){
		$_SESSION["checkoutVisit"] = false;
	}

	$productIndex = isset($_GET["product"])?(int)$_GET["product"]:null;


	if($productIndex >= 0 && $productIndex < count($catalogue)){
		$product = $catalogue[$productIndex];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - <?php echo (($productIndex >= 0 && $productIndex < count($catalogue))? $product->name:"404");?> </title>
		<?php require_once "css.php"; ?>
	</head>
	<body>
		<?php require_once "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<?php if($productIndex >= 0 && $productIndex < count($catalogue)):?>
				<div class="jumbotron" style="padding: 30px 60px; margin-bottom:5px;">
					<h1><?=$product->name;?> <small><?=$product->category->name?></small></h1>
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
									<h2 style="display: inline; color: #64B5F6;"><strong>$<?=$product->price?></strong></h2>
									<button class="button pull-right" type="submit" name="product" value="<?=$productIndex?>"><i class="fa fa-cart-plus fa-lg"></i></button>
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
		<?php require_once "js.php"; ?>
	</body>
</html>
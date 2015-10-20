<?php
	include "catalogue.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<?php include "css.php"; ?>
	</head>
	<body>
		<?php include "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron">
				<?php 
					$productIndex = isset($_GET["product"])?(int)$_GET["product"]:null;
					echo "Index: ".$productIndex." Count: ".count($catalogue);
					echo $productIndex < count($catalogue));
				?>
				<?php if($productIndex && $productIndex < count($catalogue)):?>
						<?php $product = $catalogue[$productIndex];?>
						<h1><?=$product->name;?></h1>
				<?php else:?>
					<h1>404 page not found.</h1>
				<?php endif; ?>
			</div>
		</div>
	<body>


		<?php include "js.php"; ?>
	</body>
</html>
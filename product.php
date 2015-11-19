<?php
	require_once "catalogue.php";

	//Reset visiting checkout
	if(!isset($_SESSION["checkoutVisit"])){
		$_SESSION["checkoutVisit"] = false;
	}

	// Get product info
	$productIndex = isset($_GET["product"])?(int)$_GET["product"]:null;

	$query = "SELECT name, image, price, description FROM products WHERE id = $productIndex";
	$result = $conn->query($query);

	if($result->num_rows > 0){
		$product = $result->fetch_assoc();
	}

	// Add comments if entered

	$filename = "reviews/reviews_".$productIndex.".reviews";
	if(isset($_POST["email"])){
		$email = $_POST["email"];
	}
	if(isset($_POST["commentBody"])){
		$comment = $_POST["commentBody"];
		$comment =  htmlspecialchars(strip_tags(trim($comment)));
	}

	if(isset($email) && isset($comment)){
		$str = @file_get_contents($filename);
		$write = array('email' => $email, 'comment' => $comment);

		if($str !== "" && $str !== false){
			$contents = json_decode($str, true);
			$contents[] = $write;
			file_put_contents($filename, json_encode($contents));
		}
		else {
			file_put_contents($filename, json_encode([$write]));
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - <?php echo (($product !== null)? $product["name"]:"404");?> </title>
		<?php require_once "css.php"; ?>
	</head>
	<body>
		<?php require_once "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<?php if($result->num_rows > 0):?>
				<div class="jumbotron" style="padding: 30px 60px; margin-bottom:5px;">
					<h1><?=$product["name"];?> <small></small></h1>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="content">
							<img src="<?=$product["image"]?>" class="img-responsive">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-9">
						<div class="content" style="min-height: 95px;">
							<p><?=$product["description"]?></p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="content" style="min-height: 95px;">
							<form method="POST" action="cart.php">
								<div>
									<h2 style="display: inline; color: #64B5F6;"><strong>$<?=$product["price"]?></strong></h2>
									<button class="button pull-right" type="submit" name="product" value="<?=$productIndex?>"><i class="fa fa-cart-plus fa-lg"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
					$str = @file_get_contents($filename);

					if($str !== "" && $str !== false):
						$json = json_decode($str, true);
						foreach ($json as $key => $value): ?>
							<div class="row">
								<div class="col-md-12">
									<div class="content">
										<div class="form-group">
											<h4><strong><?=$value["email"]?></strong></h4>
											<q><?=$value["comment"]?></q>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>

				<div class="row">
					<div class="col-md-12">
						<div class="content">
							<form action="" method="POST">
								<div class="form-group">
									<label for="email">Email address</label>
									<input type="email" class="form-control" name="email" placeholder="example@email.com">
								</div>
								<div class="form-group">
									<label for="commentBody">Review</label>
									<textarea rows="10" class="form-control" name="commentBody"></textarea>
								</div>
								<div class="form-group">
									<button class="button" type="submit">Save</button>
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
<?php $conn->close();
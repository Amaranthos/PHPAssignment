<?php
	require_once "catalogue.php";

	//Reset visiting checkout
	if(!isset($_SESSION["checkoutVisit"])){
		$_SESSION["checkoutVisit"] = false;
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games</title>
		<?php require_once "css.php"; ?>
	</head>
	<body>
		<?php require_once "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron">
				<div class="row">
					<h1>Buy some video games!</h1>
					<br/>
				</div>
				<div class="row">
					<?php
						$query = "SELECT id, name, thumbnail FROM products";
						$result = $conn->query($query);

						if($result->num_rows > 0):
							while($row = $result->fetch_assoc()):?>
								<div class="col-xs-6 col-md-3">
									<div class="thumbnail">
										<a href="product.php?product=<?=$row["id"]?>">
											<img src="<?=$row["thumbnail"]?>" class="img-responsive" style="max-height: 240px;" alt="<?=$value->name?>">
											<div style="padding-top: 5px; width: 100%; display: block;">
												<span class="button button-block"><?=$row["name"]?></span>
											</div>
										</a>
									</div>
								</div>
							<?php endwhile ?>
						<?php endif ?>
				</div>
			</div>
		</div>
		<?php require_once "js.php"; ?>
	</body>
</html>

<?php $conn->close();
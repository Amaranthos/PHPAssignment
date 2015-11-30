<?php
	require_once "catalogue.php";

	$_SESSION["checkoutVisit"] = false;
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
					<div class="col-xs-12">
						<h2>Buy some Steam video game keys! Because they are cheaper than on Steam...</h2>
					</div>
				</div>
				<div class="row">
					<?php
						$query = "SELECT id, name, thumbnail FROM products";

						if ($result = $conn->query($query)){

						}
						else {
							die("Error: ".$conn->error);
						}	

						if($result->num_rows > 0):
							while($row = $result->fetch_assoc()):?>
								<div class="col-xs-6 col-md-3" style="padding-top: 30px">
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
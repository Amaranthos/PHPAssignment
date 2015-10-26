<?php
	// include "catalogue.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games</title>
		<?php require "css.php"; ?>
	</head>
	<body>
		<?php require "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron">
				<div class="row">
					<?php foreach ($catalogue as $key => $value): ?>
						<div class="col-xs-6 col-md-3">
							<div class="thumbnail">
								<img src="img/placeholder.jpg" class="img-responsive img-thumbnail">
								<a href="product.php?product=<?=$key?>" class="btn btn-success btn-block" role="Button"><?=$value->name?></a>
							</div>
						</div>
					<?php endforeach?>
				</div>
			</div>
		</div>
	<body>


		<?php require "js.php"; ?>
	</body>
</html>
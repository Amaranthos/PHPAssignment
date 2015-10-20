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
				<div class="row">
					<?php foreach ($catalogue as $key => $value): ?>
						<div class="col-xs-6 col-md-3">
							<a href="product.php?product=<?=$key?>" class="thumbnail">
								<img src="img/placeholder.jpg">
							</a>
						</div>
					<?php endforeach?>
				</div>
			</div>
		</div>
	<body>


		<?php include "js.php"; ?>
	</body>
</html>
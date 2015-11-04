<?php
	// include "catalogue.php";

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
					<?php foreach ($catalogue as $key => $value): ?>
						<div class="col-xs-6 col-md-3">
							<div class="thumbnail">
								<a href="product.php?product=<?=$key?>">
									<img src="../img/placeholder.jpg" class="img-responsive" alt="<?=$value->name?>">
									<div style="padding-top: 5px; width: 100%; display: block;">
										<span class="button button-block"><?=$value->name?></span>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach?>
				</div>
			</div>
		</div>

		<?php require_once "js.php"; ?>
	</body>
</html>
<?php
	$cart[] = array();
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
				<h1 class="yellow">Cart</h1>
				<?php
					$newItem = isset($_POST["product"])?(int)$_POST["product"]:null;
					if($newItem >= 0): ?>
						<h1><?php var_dump($catalogue[$newItem])?></h1>
					<?php endif ?>
			</div>
		</div>
	<body>


		<?php include "js.php"; ?>
	</body>
</html>
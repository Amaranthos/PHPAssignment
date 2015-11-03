<?php  

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - Checkout</title>
		<?php require "css.php"; ?>
	</head>
	<body>
		<?php require "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron" style="margin-bottom:5px;">
				<h1 class="yellow">Checkout</h1>
				<form method="post" action="#">
					<label>First Name: </label>
					<input type="text" name="firstname">

					<label>Last Name: </label>
					<input type="text", name="lastname">


					<input type="submit" value="Purchase">
				</form>
			</div>
		</div>
	</body>
</html>
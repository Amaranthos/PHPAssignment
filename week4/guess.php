<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<body>
	<h1 class="yellow">Guess a number 1-10 <small>(inclusive)</small></h1>

	<form method='post'>
		<input type='number' name='guess' min="0" max="10">
		<input type="submit">
	</form>
	<br/>

	<?php
		$guess = isset($_POST['guess'])? (int)$_POST['guess']: null;
		echo $guess;
		if($guess)
			if($guess > 0 && $guess <= 10){
				$rand = rand(1, 10);

				if($guess === $rand)
					echo "You guess correctly";
				else
					echo "You fail at life";
			}
	?>
</body>
</html>
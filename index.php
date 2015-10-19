<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
</head>
<body>
	<form method="post" action="#">
		<?php
			for($i = 0; $i < 5; $i++){
				echo "<input type='number' name='no$i' value='0'/> <br/>";
			}
		?>
		<input type='submit'/>
	</form>
	<?php
		$result = 0;
		for($i = 0; $i < 5; $i++){
			(isset($_POST['no$i']))?$_POST['no$i']:0;
			result *= $_POST['no$i'];
		}
	?>
</body>
</html>

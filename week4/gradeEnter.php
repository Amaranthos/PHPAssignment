<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../custom.css">
	</head>
	<body>
		<form method="post" action="gradeResult.php">
			<h1 class="yellow">Please enter your grades.</h1>
			<?php
				for($i = 0; $i < 4; $i++){
					?>
						<label class="orange">Subject <?=(int)$i+1?>: </label>
						<input type="text" name="subject<?=$i?>" value="Subject">
						<input type="number" name="result<?=$i?>" value="0" min="0" max="100">
						<br/>
					<?php
				}
			?>
			<input type="submit">
		</form>
	</body>
</html>
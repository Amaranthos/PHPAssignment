<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<body>
		<form method="post" action="holidayConfirm.php">
			<label><strong>Full Name:</strong></label>
			<input type="text" name="name" value="Name"/> <br/>
			<label><strong>Destination:</strong></label>
			<input type="radio" name="dest" value="nz">New Zealand</input>
			<input type="radio" name="dest" value="ch">China</input>
			<input type="radio" name="dest" value="ba">Bali</input>
			<br/>
			<label><strong>Quality:</strong></label>
			<input type="radio" name="qual" value="4">4 Star</input>
			<input type="radio" name="qual" value="5">5 Star</input>
			<br/>
			<br/>
			<input type="submit">
		</form>
	</body>
</html>
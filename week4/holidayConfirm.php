<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			$name = (isset($_POST['name']))?$_POST['name']:null;
			$dest = (isset($_POST['dest']))?$_POST['dest']:null;
			$qual = (isset($_POST['qual']))?$_POST['qual']:null;

			if($name && $dest && $qual){
				$destName = "";
				$cost = 0;
				switch ($dest) {
					case 'nz':
						$destName = "New Zealand";
						$cost = 500;
						break;

					case 'ch':
						$destName = "China";
						$cost = 400;
						break;

					case 'nz':
						$destName = "New Zealand";
						$cost = 300;
						break;
					
					default:
						echo "Fuck";
						break;
				}
				switch ($qual) {
					case '4':
						$cost *= 2;
						break;
					case '5':
						$cost *= 3;
						break;

					default:
						break;
				}
		?>
		<h1>Hello <?=$name;?>, your booking details are as follows</h1>
		<p>Your destination is <?=$destName?> with <?=$qual?> Star accomodation.<br/>Your total cost is $<?=$cost?>.</p>
		<?php
			}
			else{
				echo "You failed to complete the appropriate fields";
			}
		?>
	</body>
</html>
<?php 
	class Package {
		public $value;
		public $rate;

		public function __construct($value, $rate){
			$this->value = $value;
			$this->rate = $rate;
		}
	}

	$packages[0] = new Package(1000, 5.0);
	$packages[1] = new Package(5000, 6.5);
	$packages[2] = new Package(10000, 8.0);
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../custom.css">
	</head>
	<body>
		<h1 class="yellow">Namllu credit bank loan form</h1>
		<p class="orange">How much do you want to borrow?</p>
		<form method="POST" action="loan.php">
			<?php
				for($i = 0; $i < count($packages); $i++){
					?><input type="radio" name="package" value="<?=$i?>"> our $<?=$packages[$i]->value?> package at <?=$packages[$i]->rate?>% p.a.</input><br/><?php
				}
				?>
			<br/>
			<input type="submit" value="Calculate" />
		</form>

		<?php
			$package = isset($_POST['package'])?$packages[(int)$_POST['package']]:null;

			if($package){
				?><h3 class="orange">Chosen Package</h3>
				<p>$<?=$package->value?> at <?=$package->rate?>% p.a.</p><?php

				$total = $package->value * $package->rate / 100;
				$monthly = $total / 12;

				echo $monthly;
			}
		?>
	</body>
</html>
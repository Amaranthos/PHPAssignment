<?php
	if(!isset($_SESSION["costTotal"])){
		header("index.php");
	}

	require_once "catalogue.php";

	$detailsChecked = true;
	$error = "";

	$params = ["firstname", "surname", "email", "address", "contactNumber", "cardType", "cardNumber", "cardExpiry"];
	$details = array();

	foreach ($params as $param) {
		if(isset($_POST[$param]) && $_POST[$param] != ""){
			$details[$param] = $_POST[$param];
		}
		else {
			$detailsChecked = false;
		}
	}

	if(isset($details["email"])){
		$details["email"] = RemoveExtraChars($details["email"]);

		if(!ValidateEmail($details["email"])){
			$error.=" Email is not valid, please enter a valid email.";
			$detailsChecked = false;
		}
	}

	if(isset($details["contactNumber"])){
		$details["contactNumber"] = RemoveExtraChars($details["contactNumber"]);

		$details["contactNumber"] = (int)$details["contactNumber"];

		if(!ValidateNumbers($details["contactNumber"])){
			$error.=" Contact number is not valid, valid contact numbers should contain only numerals.";
			$detailsChecked = false;
		}
	}

	if(isset($details["cardNumber"]) && $details["cardNumber"] != ""){
		$details["cardNumber"] = RemoveExtraChars($details["cardNumber"]);

		$match = "";
		if(isset($details["cardType"])){
			switch ($details["cardType"]) {
			case 'mc':
				$match = "/^5[1-5][0-9]{14}$/";
				if(!preg_match($match, $details["cardNumber"]) && !LuhnCheckSum($details["cardNumber"])){
					$error.=" Card number is not valid for MasterCard.";
					$detailsChecked = false;
				}
				break;
			
			case 'v':
				$match = "/^4[0-9]{12}(?:[0-9]{3})?$/";
				if(!preg_match($match, $details["cardNumber"]) && !LuhnCheckSum($details["cardNumber"])){
					$error.=" Card number is not valid for Visa.";
					$detailsChecked = false;
				}
				break;

			case 'a':
				$match = "/^3[47][0-9]{13}$/";
				if(!preg_match($match, $details["cardNumber"]) && !LuhnCheckSum($details["cardNumber"])){
					$error.=" Card number is not valid for AMEX.";
					$detailsChecked = false;
				}
				break;

			default:
				$error.=" Card Type is not valid, please select a valid card.";
				$detailsChecked = false;
				break;
			}
		}
		else {
			$error.=" Card Type is not valid, please select a valid card.";
			$detailsChecked = false;
		}
	}
	else {
		$error.=" A card number has not been entered, please enter a valid card number.";
		$detailsChecked = false;
	}

	if(isset($details["cardExpiry"])){
		if(date("Y-m") > $details["cardExpiry"]){
			$error.=" Card has expired, please enter a non-expired date.";
			$detailsChecked = false;
		}
	}
	else {
		$error.=" Card expiry not a valid date, please select a valid date.";
		$detailsChecked = false;
	}

	//Don't error for first visit
	if(!isset($_SESSION["checkoutVisit"]) || $_SESSION["checkoutVisit"] == false){
		$error = "";
		$_SESSION["checkoutVisit"] = true;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buy Games - Checkout</title>
		<?php require_once "css.php"; ?>
	</head>
	<body>
		<?php require_once "navbar.php"; ?>
		<div class="container" style="padding-top: 78px;">
			<div class="jumbotron" style="margin-bottom:5px;">
				<h1>Checkout</h1>
				<?php if(!$detailsChecked):?>
				<div class="row">
					<div class="col-md-6">
						<form class="form-horizontal" method="post" action="">
							<div class="form-group">
								<label for="firstname" class="col-sm-4">First Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
								</div>
							</div>
							<div class="form-group">
								<label for="surname" class="col-sm-4">Last Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="surname" id="surname" placeholder="Last Name">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-4">Email:</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" name="email" id="email" placeholder="example@email.com">
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-4">Address:</label>
								<div class="col-sm-8">
									<textarea rows="3" class="form-control" name="address" id="address" placeholder="Address"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="contactNumber" class="col-sm-4">Contact Number:</label>
								<div class="col-sm-8">
									<input type="tel" class="form-control" name="contactNumber" id="contactNumber" placeholder="Contact Number">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4">Card Type:</label>
								<div class="col-sm-8">
									<label for="cardType0" class="radio-inline">
										<input type="radio" name="cardType" id="cardType0" value="mc">MasterCard
									</label>
									<label for="cardType1" class="radio-inline">
										<input type="radio" name="cardType" id="cardType1" value="v">Visa
									</label>
									<label for="cardType2" class="radio-inline">
										<input type="radio" name="cardType" id="cardType2" value="a">AMEX
									</label>
								</div>
							</div>

							<div class="form-group">
								<label for="cardNumber" class="col-sm-4">Card Number:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="Card Number">
								</div>
							</div>
							<div class="form-group">
								<label for="cardExpiry" class="col-sm-4">Card Expiry Date:</label>
								<div class="col-sm-8">
									<input type="month" class="form-control" name="cardExpiry" id="cardExpiry">
								</div>
							</div>							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<div class="checkbox">
										<label><input type="checkbox" name="giftWrapped">Gift Wrapped</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<?php if($error != ""):?>
										<p class="red"><?=$error?></p>
									<?php endif ?>
									<input class="button button-block" type="submit" value="Purchase">
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php else: ?>

					<p>Order successfully placed for <?=$details["firstname"]." ".$details["surname"]?>.</p>
					<p>Delivery to <?=$details["address"]?></p>
					<p>Card: <?=$details["cardNumber"]?> charged $<?=$_SESSION["costTotal"]?> </p>
				<?php endif ?>
			</div>
		</div>
	</body>
</html>
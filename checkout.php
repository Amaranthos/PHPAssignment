<?php
	if(!isset($_SESSION["costTotal"])){
		header("index.php");
	}

	require_once "catalogue.php";

	$detailsChecked = true;
	$error = array();

	$params = ["firstname", "surname", "email", "address", "contactNumber", "cardNumber", "cardExpiry"];
	$details = array();

	foreach ($params as $param) {
		if(isset($_POST[$param]) && $_POST[$param] != ""){
			$details[$param] = $_POST[$param];
			setcookie($param, $_POST[$param], time()+60*60*24*30);
		}
		else {
			$detailsChecked = false;
			$error[$param] = "Required field";
		}
	}

	// Validate email
	if(isset($details["email"])){
		$details["email"] = RemoveExtraChars($details["email"]);

		if(!ValidateEmail($details["email"])){
			$error["email"] = "Email is not valid, please enter a valid email.";
			$detailsChecked = false;
		}
	}

	// Validate phone number
	if(isset($details["contactNumber"])){
		$details["contactNumber"] = RemoveExtraChars($details["contactNumber"]);

		$details["contactNumber"] = (int)$details["contactNumber"];

		if(!ValidateNumbers($details["contactNumber"])){
			$error["contactNumber"] = "Contact number is not valid, valid contact numbers should contain only numerals.";
			$detailsChecked = false;
		}
	}

	// Validate credit card number
	if(isset($details["cardNumber"]) && $details["cardNumber"] != ""){
		$details["cardNumber"] = RemoveExtraChars($details["cardNumber"]);

		$check = ValidateCard($details["cardNumber"]);

		if($check !== false){
			$details["cardType"] = $check;
		}
		else {
			$detailsChecked = false;
			$error["cardNumber"] = "Card number is not valid.";
		}
	}

	// Validate credit card date
	if(isset($details["cardExpiry"])){
		if(date("Y-m") > $details["cardExpiry"]){
			$error["cardExpiry"] = "Card has expired, please enter a non-expired date.";
			$detailsChecked = false;
		}
	}

	// Don't error for first visit
	if($_SESSION["checkoutVisit"] === false){
		unset($error);				
		$_SESSION["checkoutVisit"] = true;
	}

	// Save customer details
	if($detailsChecked){
		AppendToJSON($details, "customer.details");
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
									<p class="red"><?php echo (isset($error["firstname"])? $error["firstname"]: "");?></p>
									<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo SavedCheckoutField("firstname");?>">
								</div>
							</div>
							<div class="form-group">
								<label for="surname" class="col-sm-4">Last Name:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["surname"])? $error["surname"]: "");?></p>
									<input type="text" class="form-control" name="surname" id="surname" placeholder="Last Name" value="<?php echo SavedCheckoutField("surname");?>">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-4">Email:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["email"])? $error["email"]: "");?></p>
									<input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?php echo SavedCheckoutField("email");?>">
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-4">Address:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["address"])? $error["address"]: "");?></p>
									<textarea rows="3" class="form-control" name="address" id="address" placeholder="Address"><?php echo SavedCheckoutField("address");?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="contactNumber" class="col-sm-4">Contact Number:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["contactNumber"])? $error["contactNumber"]: "");?></p>
									<input type="tel" class="form-control" name="contactNumber" id="contactNumber" placeholder="Contact Number" value="<?php echo SavedCheckoutField("contactNumber");?>">
								</div>
							</div>

							<div class="form-group">
								<label for="cardNumber" class="col-sm-4">Card Number:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["cardNumber"])? $error["cardNumber"]: "");?></p>
									<input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="Card Number" value="<?php echo SavedCheckoutField("cardNumber");?>">
								</div>
							</div>
							<div class="form-group">
								<label for="cardExpiry" class="col-sm-4">Card Expiry Date:</label>
								<div class="col-sm-8">
									<p class="red"><?php echo (isset($error["cardExpiry"])? $error["cardExpiry"]: "");?></p>
									<input type="month" class="form-control" name="cardExpiry" id="cardExpiry" value="<?php echo SavedCheckoutField("cardExpiry");?>">
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
									<input class="button button-block" type="submit" value="Purchase">
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php else: ?>

					<p>Order successfully placed for <?=$details["firstname"]." ".$details["surname"]?>.</p>
					<p>Delivery to <?=$details["address"]?></p>
					<p>Card: <?=$details["cardType"]?> <?=$details["cardNumber"]?> charged $<?=$_SESSION["costTotal"]?> </p>
				<?php endif ?>
			</div>
		</div>
	</body>
</html>
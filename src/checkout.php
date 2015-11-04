<?php
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
		}
	}

	if(isset($details["contactNumber"])){
		$details["contactNumber"] = RemoveExtraChars($details["contactNumber"]);

		$details["contactNumber"] = (int)$details["contactNumber"];

		if(!ValidateNumbers($details["contactNumber"])){
			$error.=" Contact number is not valid, valid contact numbers should contain only numerals.";
		}
	}

	if(isset($details["cardNumber"])){
		$details["cardNumber"] = RemoveExtraChars($details["cardNumber"]);

		$match = "";

		switch ($details["cardType"]) {
		case 'mc':
			$match = "/^5[1-5][0-9]{14}$/";
			if(!preg_match($match, $details["cardNumber"])){
				$error.=" Card number is not valid for MasterCard.";
			}
			break;
		
		case 'v':
			$match = "/^4[0-9]{12}(?:[0-9]{3})?$/";
			if(!preg_match($match, $details["cardNumber"])){
				$error.=" Card number is not valid for Visa.";
			}
			break;

		case 'a':
			$match = "/^3[47][0-9]{13}$/";
			if(!preg_match($match, $details["cardNumber"])){
				$error.=" Card number is not valid for AMEX.";
			}
			break;

		default:
			$error.=" Card Type is not valid, please select a valid card.";
			break;
		}

		if($match != ""){
			if(!LuhnCheckSum($details["cardNumber"])){
				$error.=" Card number is not a valid card number, please re-enter your card number.";
			}
		}
	}	

	if(isset($details["cardExpiry"])){
		if(date("Y-m") > $details["cardExpiry"]){
			$error.=" Card has expired, please enter a new expiry date.";
		}
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
						<form class="form-horizontal" method="post" action="#">
							<div class="form-group">
								<label for="firstname" class="col-sm-4">First Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo isset($details["firstname"])? $details["firstname"]:"First Name";?>" requried/>
								</div>
							</div>
							<div class="form-group">
								<label for="surname" class="col-sm-4">Last Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="surname" id="surname" value="<?php echo isset($details["surname"])? $details["surname"]:"Last Name";?>"requried/>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-4">Email:</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" name="email" id="email" value="<?php echo isset($details["email"])? $details["email"]:"email@example.com";?>"requried/>
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-4">Address:</label>
								<div class="col-sm-8">
									<textarea type="text" rows="3" class="form-control" name="address" id="address"><?php echo isset($details["address"])? $details["address"]:"Address";?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="contactNumber" class="col-sm-4">Contact Number:</label>
								<div class="col-sm-8">
									<input type="tel" class="form-control" name="contactNumber" id="contactNumber" value="<?php echo isset($details["contactNumber"])? $details["contactNumber"]:"Phone";?>"requried/>
								</div>
							</div>

							<div class="form-group">
								<label for="cardType" class="col-sm-4">Card Type:</label>
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
									<input type="text" class="form-control" name="cardNumber" id="cardNumber" value="<?php echo isset($details["cardNumber"])? $details["cardNumber"]:"Card Number";?>"requried/>
								</div>
							</div>
							<div class="form-group">
								<label for="cardExpiry" class="col-sm-4">Card Expiry Date:</label>
								<div class="col-sm-8">
									<input type="month" class="form-control" name="cardExpiry" id="cardExpiry" value="<?php echo isset($details["cardExpiry"])? $details["cardExpiry"]:"";?>"requried/>
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
					<?php foreach ($details as $key => $value):?>
						<?=$key?>
						<?=$value?>
						<br/>
					<?php endforeach ?>					
				<?php endif ?>
			</div>
		</div>
	</body>
</html>
<?php
	// Record session
	session_start();

	// Connect to mySQL database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "catalogue";

	$conn = new mysqli($servername, $username, $password);

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	if($conn->select_db($dbname) === false){
		require_once "sql.php";
	}

	// Validate data functions
	function RemoveExtraChars($string) {
		return str_replace(" ", "", str_replace("-", "", htmlspecialchars(stripslashes(trim($string)))));
	}

	function ValidateEmail($email) {
		return(filter_var($email, FILTER_VALIDATE_EMAIL));
	}

	function ValidateNumbers($number){
		return(filter_var($number, FILTER_VALIDATE_INT));
	}

	function ValidateCard($cardNumber){
		$format = array(
			'visa' => "(4\d{12}(?:\d{3})?)",
			'amex' => "(3[47]\d{13})",
			'master' => "(5[1-5]\d{14})"
		);
		$names = array("Visa", "Amercian Express","Mastercard");
		$matches = array();
		$pattern = "#^(?:".implode(("|"), $format).")$#";
		$result = preg_match($pattern, str_replace(" ", "", $cardNumber), $matches);

		if($result > 0){
			$result = (LuhnCheckSum($cardNumber))?1:0;
		}
		return ($result>0)?$names[sizeof($matches)-2]:false;
	}


	function LuhnCheckSum($number){
		$checksum = "";
		foreach (str_split(strrev((string)$number)) as $i => $value) {
			$checksum .= $i %2 !== 0? $value * 2 : $value;
		}
		return array_sum(str_split($checksum)) % 10 === 0;
	}

	function AppendToJSON($array, $filename){
		$str = @file_get_contents($filename);

		if($str !== "" && $str !== false){
			$contents = json_decode($str, true);
			$contents[] = $array;
			file_put_contents($filename, json_encode($contents));
		}
		else {
			file_put_contents($filename, json_encode([$array]));
		}
	}

	function SavedCheckoutField($field){
		if($_POST[$field]){

		}
		elseif ($_COOKIES[$field]) {
			# code...
		}
	}

	//Old Catalouge
	class Category{
		public $name;

		public function __construct($name){
			$this->name = $name;
		}
	}

	class Cart {
		public $id;
		public $product;
		public $quantity;

		public function __construct($id, $product, $quantity){
			$this->id = $id;
			$this->product =  $product;
			$this->quantity = $quantity;
		}
	}

	$categories["action"] = new Category("Action");
	$categories["adventure"] = new Category("Adventure");
	$categories["casual"] = new Category("Casual");
	$categories["puzzle"] = new Category("Puzzle");
	$categories["strategy"] = new Category("Strategy");

	
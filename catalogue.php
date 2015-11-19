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

	// Query SQL functions
	function Query($conn, $query) {
		if($conn->query($query) !== true){
			die("Error: ".$conn->error);
		}		
	}

	function Prepare($conn, $statement, ...$params){

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

	function LuhnCheckSum($number){
		$checksum = "";
		foreach (str_split(strrev((string)$number)) as $i => $value) {
			$checksum .= $i %2 !== 0? $value * 2 : $value;
		}
		return array_sum(str_split($checksum)) % 10 === 0;
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

	
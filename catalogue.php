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

	class Product {
		public $name;
		public $price;
		public $description;
		public $category;

		public function __construct($name, $price, $description, $category){
			$this->name = $name;
			$this->price = $price;
			$this->description = $description;
			$this->category = $category;
		}	
	}

	class Cart {
		public $product;
		public $quantity;

		public function __construct($product, $quantity){
			$this->product =  $product;
			$this->quantity = $quantity;
		}
	}

	$categories["action"] = new Category("Action");
	$categories["adventure"] = new Category("Adventure");
	$categories["casual"] = new Category("Casual");
	$categories["puzzle"] = new Category("Puzzle");
	$categories["strategy"] = new Category("Strategy");

	$catalogue[] = new Product("Generic Shooter", 29.99, "A shooter where you shoot things!", $categories["action"]);
	$catalogue[] = new Product("Epic Quest", 79.99, "Running sim, where you endless grind for levels, upgrading meaningless skills!", $categories["adventure"]);
	$catalogue[] = new Product("Flappy Flock", 2.99, "Have you had your fix today?", $categories["casual"]);
	$catalogue[] = new Product("Stupid Puzzles", 29.99, "You'll never solve these puzzles!", $categories["puzzle"]);
	$catalogue[] = new Product("Streamlined RTS", 59.99, "Who even liked AOE anyway?", $categories["strategy"]);

	$conn->close();


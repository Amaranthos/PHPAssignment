<?php
	// Record session
	session_start();

	// Connect to mySQL database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "catalogue";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	function Query($conn, $query) {
		if($conn->query($query) !== True){
			die("Error: ".$conn->error);
		}		
	}

	// Create database
	$query = "CREATE DATABASE IF NOT EXISTS catalogue";

	// if($conn->query($query) !== True){
	// 	die("Error creating database: ".$conn->error);
	// }

	Query($conn, $query);

	// Create tables
	$query = "CREATE TABLE IF NOT EXISTS categories (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(30) NOT NULL
			)";

	Query($conn, $query);

	$query = "CREATE TABLE IF NOT EXISTS products (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(255) NOT NULL,
				price DECIMAL NOT NULL,
				description TEXT NOT NULL,
				cat_id INT UNSIGNED NOT NULL,
				FOREIGN KEY fk_cat(cat_id)
				REFERENCES categories(cat_id)
				ON UPDATE CASCADE
				ON DELETE RESTRICT
			)";

	Query($conn, $query);

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


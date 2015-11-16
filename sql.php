<?php	
	function Query($conn, $query) {
		if($conn->query($query) !== true){
			die("Error: ".$conn->error);
		}		
	}

	// Create database
	$query = "CREATE DATABASE IF NOT EXISTS catalogue";

	if($conn->query($query) !== true){
		die("Error creating database: ".$conn->error);
	}

	$conn->select_db($dbname);

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
				image TEXT NOT NULL
			)";

	Query($conn, $query);

	// Insert data
	$query = "INSERT INTO products (id, name, price, description, image) VALUES ('')
	
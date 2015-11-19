<?php	
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
				price DECIMAL(19, 2) NOT NULL,
				description TEXT NOT NULL,
				image TEXT NOT NULL,
				thumbnail TEXT NOT NULL
			)";

	Query($conn, $query);

	// Insert data
	$query = "INSERT INTO products (name, price, description, image, thumbnail) VALUES ('Generic Shooter', 89.99, 'A shooter where you shoot things!', 'http://www.hdwallpapers.in/download/star_wars_battlefront-1920x1080.jpg', 'https://upload.wikimedia.org/wikipedia/en/thumb/2/22/Star_Wars_Battlefront_2015_box.jpg/250px-Star_Wars_Battlefront_2015_box.jpg');";
	$query .= "INSERT INTO products (name, price, description, image, thumbnail) VALUES ('Epic Quest', 69.99, 'Running sim, where you endless grind for levels, upgrading meaningless skills!', 'http://www.hdwallpapers.in/download/fallout_4_ncr_ranger-1920x1080.jpg', 'https://upload.wikimedia.org/wikipedia/en/7/70/Fallout_4_cover_art.jpg');";
	$query .= "INSERT INTO products (name, price, description, image, thumbnail) VALUES ('Flappy Flock', 2.99, 'Have you had your fix today?', 'http://www.hdwallpapers.in/download/witcher_3_wild_hunt_swords-1920x1080.jpg', 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0c/Witcher_3_cover_art.jpg/250px-Witcher_3_cover_art.jpg');";
	$query .= "INSERT INTO products (name, price, description, image, thumbnail) VALUES ('Streamlined RTS', 59.99, 'Who even liked AOE anyway?', 'http://www.hdwallpapers.in/download/starcraft_2_heart_of_the_swarm-1920x1080.jpg', 'https://upload.wikimedia.org/wikipedia/en/thumb/9/93/StarCraft_box_art.jpg/250px-StarCraft_box_art.jpg');";

	echo "Insert";

	if (mysqli_multi_query($conn, $query) !== true){
		die("Error: ".$conn->error);
	}	
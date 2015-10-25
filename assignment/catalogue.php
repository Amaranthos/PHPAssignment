<?php
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

	$categories["action"] = new Category("Action");
	$categories["adventure"] = new Category("Adventure");
	$categories["casual"] = new Category("Casual");
	$categories["puzzle"] = new Category("Puzzle");
	$categories["strategy"] = new Category("Strategy");

	$catalogue[] = new Product("Generic Shooter", 29.99, "A shooter where you shoot things!", $categories["action"]);
	$catalogue[] = new Product("Epic Quest", 79.99, "Running sim, where you endless grind for levels, upgrading meaningless skills!", $categories["adventure"]);
	$catalogue[] = new Product("Flappy Flock", 2.99, "Have you had your fix today?", $categories["casual"]);
	$catalogue[] = new Product("Yes You Are Stupid Puzzles", 29.99, "You'll never solve these puzzles!", $categories["puzzle"]);
	$catalogue[] = new Product("Streamlined RTS", 59.99, "Who even liked AOE anyway?", $categories["strategy"]);

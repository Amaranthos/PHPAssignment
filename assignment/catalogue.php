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

	$catalogue[] = new Product("Generic Shooter", 29.99, "A shooter where you shoot things!", $categories["action"]);

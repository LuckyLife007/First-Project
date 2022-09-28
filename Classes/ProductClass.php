<?php

require '../Classes/DBProduct.php';
require '../Classes/DvdClass.php';
require '../Classes/BookClass.php';
require '../Classes/FurnitureClass.php';

abstract class Product
{
	// Declare the protected attributes
	protected string $new_sku;
	protected string $new_name;
	protected float $new_price;
	protected float $new_size;
	protected float $new_height;
	protected float $new_length;
	protected float $new_width;
	protected float $new_weight;

	// Assign values to the attributes on instantiation
	public function __construct()
	{
		$this->new_sku = $_POST["sku"];
		$this->new_name = $_POST["name"];
		$this->new_price = floatval($_POST["price"]);
		$this->new_size = floatval($_POST["size"]);
		$this->new_height = floatval($_POST["height"]);
		$this->new_length = floatval($_POST["length"]);
		$this->new_width = floatval($_POST["width"]);
		$this->new_weight = floatval($_POST["weight"]);
	}

	// Abstract method to be implemented by children classes
	abstract protected function productDetails();

	// Getter method for retrieving new object from productDetails() method
	public function getNew()
	{
		return $this->productDetails();
	}
}

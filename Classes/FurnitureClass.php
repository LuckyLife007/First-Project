<?php

class Furniture extends Product
{
	// This private method implements the inherited abstract method
	// for Furniture products in particular, returning an object of 
	// the class DBProduct
	protected function productDetails()
	{
		$furniture_sku = $this->new_sku;
		$furniture_name = $this->new_name;
		$furniture_price = $this->new_price;
		$furniture_desc = "Dimensions: $this->new_height cm by 
			$this->new_width cm by $this->new_length cm";

		$newfurniture = ['sku'=>$furniture_sku, 'name'=>$furniture_name,
			'price'=>$furniture_price, 'description'=>$furniture_desc];
		
		$furniture_prod = new DBProduct();
		
		foreach ($newfurniture as $k=>$v) {
			$furniture_prod->$k = $v;
		}

		return $furniture_prod;
	}
}

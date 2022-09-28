<?php

class Dvd extends Product
{
	// This private method implements the inherited abstract method
	// for DVD products in particular, returning an object of 
	// the class DBProduct
	protected function productDetails()
	{
		$dvd_sku = $this->new_sku;
		$dvd_name = $this->new_name;
		$dvd_price = $this->new_price;
		$dvd_desc = "Size: $this->new_size MB";

		$newdvd = ['sku'=>$dvd_sku, 'name'=>$dvd_name,
			'price'=>$dvd_price, 'description'=>$dvd_desc];
		
		$dvd_prod = new DBProduct();
		
		foreach ($newdvd as $k=>$v) {
			$dvd_prod->$k = $v;
		}

		return $dvd_prod;
	}
}

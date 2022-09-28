<?php

class Book extends Product
{
	// This private method implements the inherited abstract method
	// for Book products in particular, returning an object of 
	// the class DBProduct
	protected function productDetails()
	{
		$book_sku = $this->new_sku;
		$book_name = $this->new_name;
		$book_price = $this->new_price;
		$book_desc = "Weight: $this->new_weight Kg";

		$newbook = ['sku'=>$book_sku, 'name'=>$book_name,
			'price'=>$book_price, 'description'=>$book_desc];
		
		$book_prod = new DBProduct();
		
		foreach ($newbook as $k=>$v) {
			$book_prod->$k = $v;
		}

		return $book_prod;
	}
}

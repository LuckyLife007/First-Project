<?php

class DBProduct
{
    // Declare the private attributes
    public string $sku;
	  public string $name;
	  public float $price;
    public string $description;

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->property = $value;
        }
    }
  
    public function __get($property)
    {
      if (isset($property)) {
        return $this->$property;
      }
    }
}

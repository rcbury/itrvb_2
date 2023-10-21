<?php

include("./product.php")

class ShortProduct extends Product
{
    public $short_description;
    public $small_image;
    public $average_rate;
  
    function __construct($name, $image, $price, $decription, $reviews, $short_description, $small_image, $average_rate) {
      parent::__construct($name, $image, $price, $decription, $reviews);
      $this->short_description = $short_description;
      $this->small_image = $small_image;
      $this->average_rate = $average_rate;
    }
}
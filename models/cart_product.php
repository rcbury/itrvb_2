<?php

include("./product.php")

class CartProduct extends Product
{
    public $xs_image;
    public $amount;
  
    function __construct($name, $image, $price, $decription, $reviews, $xs_image, $amount) {
      parent::__construct($name, $image, $price, $decription, $reviews);
      $this->xs_image = $xs_image;
      $this->amount = $amount;
    }

    function increase_amount() {}

    function decrease_amount() {}

}
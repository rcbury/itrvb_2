<?php

class Cart 
{
    public $total_price;
    public $products;
  
    function __construct($total_price = 0, $products = array()) {
      $this->total_price = $total_price;
      $this->products = $products;
    }

    function get_total_price() {
      return $this->total_price;
    }

    function add_product($product) 
    {
        array_push($this->products, $product);
        change_price($product->price);
    }

    function remove_product($product) 
    {
        change_price(-1*$product->price);
    }

    function change_price($amount) 
    {
        $total_price = $total_price + $amount;
    }

    function create_order()
}
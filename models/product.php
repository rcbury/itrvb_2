<?php

class Product
{
    public $name;
    public $image;
    public $price;
    public $decription;
    public $reviews;
  
    function __construct($name, $image, $price, $decription, $reviews) {
      $this->name = $name;
      $this->image = $image;
      $this->price = $price;
      $this->description = $description;
      $this->reviews = $reviews;
    }

    function add_review() {}

    function save();

    function add_to_cart() {}

    function delete() {}
}
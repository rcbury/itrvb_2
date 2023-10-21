<?php

class User
{
    public $name;
    public $avatar;
    public $email;
    public $cart;
    public $reviews;
  
    function __construct($name, $avatar, $email, $cart, $reviews) {
      $this->name = $name;
      $this->email = $email;
      $this->avatar = $avatar;
      $this->cart = $cart;
      $this->reviews = $reviews;
    }

    function save_changes() {};
}
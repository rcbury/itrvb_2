<?php

class Review
{
    public $product;
    public $user;
    public $content;
    public $rate;
  
    function __construct($product, $user, $content, $rate) {
      $this->product = $product;
      $this->user = $user;
      $this->content = $content;
      $this->rate = $rate;
    }

    function send() {}
}
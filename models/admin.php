<?php

include("./user.php")

class Admin
{
    function __construct($name, $avatar, $email, $cart, $reviews) {
      parent::__construct($name, $avatar, $email, $cart, $reviews);
    }

    function ban_user($user) {}

    function add_product($product) {}
}
<?php

class Feedback
{
    public $user;
    public $content;
  
    function __construct($user, $content) {
      $this->user = $user;
      $this->content = $content;
    }
}
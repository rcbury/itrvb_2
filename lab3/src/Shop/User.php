<?php

namespace Shop;

class User {
    public $id;
    public $first_name;
    public $last_name;

    public function __construct($id, $first_name, $last_name) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function __toString() {
        return "ID: {$this->id}, First Name: {$this->first_name}, Last Name: {$this->last_name}";
    }
}
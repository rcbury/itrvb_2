<?php

namespace lab3\Blog;

class User {
    public string $uuid;
    public string $first_name;
    public string $last_name;
    public string $username;

    public function __construct($uuid, $first_name, $last_name, $username) {
        $this->uuid = $uuid;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
    }

    public function __toString() {
        return "UUID: {$this->uuid}, First Name: {$this->first_name}, Last Name: {$this->last_name}, Username: {$this->username}";
    }
}
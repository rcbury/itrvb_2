<?php

namespace lab3;

require 'src/custom_autoloader.php';
require 'vendor/autoload.php';

use lab3\Blog\Article;
use lab3\Blog\Comment;
use lab3\Blog\User;
use Faker\Factory;

$faker = Factory::create();

$article = new Article($faker->randomNumber(), $faker->randomNumber(), $faker->text, $faker->text);

$comment = new Comment($faker->randomNumber(), $faker->randomNumber(),$faker->randomNumber(), $faker->text);

$user = new User($faker->randomNumber(), $faker->text, $faker->text, $faker->text);

echo $article . '</br>';

echo $comment . '</br>';

echo $user . '</br>';


?>
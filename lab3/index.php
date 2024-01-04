<?php

namespace lab3;

require_once 'src/custom_autoloader.php';
require_once 'vendor/autoload.php';

use Shop\Article;
use Shop\Comment;
use Shop\User;
use Faker\Factory;

$faker = Factory::create();

$article = new Article($faker->randomNumber(), $faker->randomNumber(),$faker->text, $faker->text);

$comment = new Comment($faker->randomNumber(), $faker->randomNumber(),$faker->randomNumber(), $faker->text);

$user = new User($faker->randomNumber(), $faker->text, $faker->text);

echo $article . '</br>';

echo $comment . '</br>';

echo $user . '</br>';


?>
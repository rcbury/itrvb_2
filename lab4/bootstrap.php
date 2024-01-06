<?php

require 'src/custom_autoloader.php';
require 'vendor/autoload.php';

use lab3\Blog\Container\DIContainer;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use lab3\Blog\Repositories\SQLiteArticlesRepository;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Repositories\SQLiteCommentsRepository;
use lab3\Blog\Interfaces\ArticleLikesRepositoryInterface;
use lab3\Blog\Repositories\SQLiteArticleLikesRepository;
use lab3\Blog\Database\Db;

$container = new DIContainer;

$db = new Db(__DIR__ . '/blog.db');

$container->bind(SQLite3::class, $db);
$container->bind(ArticlesRepositoryInterface::class, SQLiteArticlesRepository::class);
$container->bind(CommentsRepositoryInterface::class, SQLiteCommentsRepository::class);
$container->bind(ArticleLikesRepositoryInterface::class, SQLiteArticleLikesRepository::class);

return $container;
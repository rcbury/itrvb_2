<?php

require 'src/custom_autoloader.php';
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use lab3\Blog\Container\DIContainer;
use lab3\Blog\Interfaces\ArticlesRepositoryInterface;
use lab3\Blog\Repositories\SQLiteArticlesRepository;
use lab3\Blog\Interfaces\CommentsRepositoryInterface;
use lab3\Blog\Repositories\SQLiteCommentsRepository;
use lab3\Blog\Interfaces\ArticleLikesRepositoryInterface;
use lab3\Blog\Repositories\SQLiteArticleLikesRepository;
use lab3\Blog\Database\Db;

$container = new DIContainer;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$db = new Db(__DIR__ . '/blog.db');

$container->bind(SQLite3::class, $db);
$container->bind(ArticlesRepositoryInterface::class, SQLiteArticlesRepository::class);
$container->bind(CommentsRepositoryInterface::class, SQLiteCommentsRepository::class);
$container->bind(ArticleLikesRepositoryInterface::class, SQLiteArticleLikesRepository::class);

$logger = new Logger('blog');

if ($_SERVER['LOG_TO_FILES'] === 'yes') {
	$logger->pushHandler(new StreamHandler(__DIR__ . '/blog.log'))
		->pushHandler(new StreamHandler(
			__DIR__ . '/blog.error.log', 
			level: Level::Error, 
			bubble: false
	));
}

if ($_SERVER['LOG_TO_CONSOLE'] === 'yes') {
	$logger->pushHandler(new StreamHandler("php://stdout"));
}

$container->bind(LoggerInterface::class, $logger);

return $container;
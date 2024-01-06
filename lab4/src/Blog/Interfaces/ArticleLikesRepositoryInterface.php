<?php

namespace lab3\Blog\Interfaces;

use lab3\Blog\ArticleLike;

interface ArticleLikesRepositoryInterface 
{
    public function save(ArticleLike $article);
    public function getByPostUuid(string $uuid);
}

?>
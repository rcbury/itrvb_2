<?php

namespace lab3\Blog\Interfaces;

use lab3\Blog\Article;

interface ArticlesRepositoryInterface 
{
    public function save(Article $article);
    public function get(string $uuid);
    public function delete(string $uuid);
}

?>
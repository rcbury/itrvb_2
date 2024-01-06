<?php

namespace lab3\Blog\Interfaces;

use lab3\Blog\Comment;

interface CommentsRepositoryInterface 
{
    public function save(Comment $comment);
    public function get(string $uuid);
}

?>

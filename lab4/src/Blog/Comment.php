<?php

namespace lab3\Blog;

class Comment {
    public string $uuid;
    public string $author_uuid;
    public string $article_uuid;
    public string $content;

    public function __construct($uuid, $author_uuid, $article_uuid, $content) {
        $this->uuid = $uuid;
        $this->author_uuid = $author_uuid;
        $this->article_uuid = $article_uuid;
        $this->content = $content;
    }

    public function __toString() {
        return "UUID: {$this->uuid}, Author ID: {$this->author_uuid}, Article ID: {$this->article_uuid}, Content: {$this->content}";
    }
}
<?php

namespace Shop;

class Comment {
    public string $uuid;
    public string $author_id;
    public string $article_id;
    public string $content;

    public function __construct($uuid, $author_id, $article_id, $content) {
        $this->uuid = $uuid;
        $this->author_id = $author_id;
        $this->article_id = $article_id;
        $this->content = $content;
    }

    public function __toString() {
        return "UUID: {$this->uuid}, Author ID: {$this->author_id}, Article ID: {$this->article_id}, Content: {$this->content}";
    }
}
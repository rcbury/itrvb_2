<?php

namespace Shop;

class Comment {
    public $id;
    public $author_id;
    public $article_id;
    public $content;

    public function __construct($id, $author_id, $article_id, $content) {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->article_id = $article_id;
        $this->content = $content;
    }

    public function __toString() {
        return "ID: {$this->id}, Author ID: {$this->author_id}, Article ID: {$this->article_id}, Content: {$this->content}";
    }
}
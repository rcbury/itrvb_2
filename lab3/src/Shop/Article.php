<?php

namespace Shop;

class Article {
    public $id;
    public $author_id;
    public $header;
    public $content;

    public function __construct($id, $author_id, $header, $content) {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->header = $header;
        $this->content = $content;
    }

    public function __toString() {
        return "ID: {$this->id}, Author ID: {$this->author_id}, Header: {$this->header}, Content: {$this->content}";
    }
}
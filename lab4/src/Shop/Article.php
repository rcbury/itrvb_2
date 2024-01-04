<?php

namespace Shop;

class Article {
    public string $uuid;
    public string $author_id;
    public string $header;
    public string $content;

    public function __construct($uuid, $author_id, $header, $content) {
        $this->uuid = $uuid;
        $this->author_id = $author_id;
        $this->header = $header;
        $this->content = $content;
    }

    public function __toString() {
        return "UUID: {$this->uuid}, Author ID: {$this->author_id}, Header: {$this->header}, Content: {$this->content}";
    }
}
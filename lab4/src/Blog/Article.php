<?php

namespace lab3\Blog;

class Article {
    public string $uuid;
    public string $author_uuid;
    public string $header;
    public string $content;

    public function __construct($uuid, $author_uuid, $header, $content) {
        $this->uuid = $uuid;
        $this->author_uuid = $author_uuid;
        $this->header = $header;
        $this->content = $content;
    }

    public function __toString() {
        return "UUID: {$this->uuid}, Author ID: {$this->author_uuid}, Header: {$this->header}, Content: {$this->content}";
    }
}
<?php

interface ArticlesRepositoryInterface 
{
    public function save($article);
    public function get($uuid);
}

?>
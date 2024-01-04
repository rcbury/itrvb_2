<?php 

interface CommentsRepositoryInterface 
{
    public function save($article);
    public function get($uuid);
}

?>

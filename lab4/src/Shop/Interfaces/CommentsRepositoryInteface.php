<?php 

interface CommentsRepositoryInterface 
{
    public function save($comment);
    public function get($uuid);
}

?>

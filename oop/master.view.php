<?php

class Masterview extends Mastermodel {
//you can show anything using this globalshowview() method
    public function globalshowview($table){

        return $this->globalview($table);
    }

    public function fetchBlogpost($table, $limit){
        return $this->blogPost($table, $limit);
    }
    
    public function selectcmnt($comments){
        return $this->commentsselection($comments);
    }

    public function cmnttitle($tabledb, $table, $commentId){
        return $this->forTitle($tabledb, $table, $commentId);
    }
//this method is for num rows
    public function showrow($comments, $post_id, $blog){
        return $this->rowfetch($comments, $post_id, $blog);
    }

    public function selectanthngbyid($table, $id, $primarykey){

        return $this->selectbyid($table, $id, $primarykey);
    }

    
}


?>
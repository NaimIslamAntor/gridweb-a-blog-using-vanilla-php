<?php

class Mastercntr extends Mastermodel {

        public $table;
        public $key_table;
        public $key;

//updating content

    public function contents($logo, $headtext, $headerdes, $headerimage, $aboutdes, $service, $servicedes, $blogheading, 
    $blogdescription, $contact, $contactdescription, $leftline,
     $leftdescription, $socialheading, $copyright){

        $this->updating($logo, $headtext, $headerdes, $headerimage, $aboutdes, $service, $servicedes, $blogheading, 
    $blogdescription, $contact, $contactdescription, $leftline,
     $leftdescription, $socialheading, $copyright);
    }
//this method is for posting comments
    public function comments($blog, $user_key, $comment, $comment_date){
        $this->postComments($blog, $user_key, $comment, $comment_date);
        
    }

    public  function anOtherdelete($table, $key_table, $key){
         $this->table = $table;
         $this->key_table = $key_table;
         $this->key = $key;
         $this->deleteMmethod($table, $key_table, $key);
    }


//this method is for uploading blogs
    public function uploadingblogs($thumbnail, $alt, $makingItnormal, $title, $excerpt, 
    $editor, $thumbnailname, $thumbnailtype, $thumbnailtmp, $thumbnailerror, $thumbnailsize, $thumbext, $thumbactual, 
    $fileextCheck){
        $this->blogposts($thumbnail, $alt, $makingItnormal, $title, $excerpt, 
     $editor, $thumbnailname, $thumbnailtype, $thumbnailtmp, $thumbnailerror, $thumbnailsize, $thumbext, $thumbactual, 
     $fileextCheck);
    }

//this method is for editing blogs

public function cateygorymethod($realising_array_categories, $get_blog_primary_key){
    $this->category($realising_array_categories, $get_blog_primary_key);
}


    //this method is for deleting
    public function delete($table_name, $postblog){
        $this->deleteglobal($table_name, $postblog);
    }
    

    //this method is for creating blog categories

    public function createCategory(string $category_actual, string $c_short_description){
        $this->CPosts($category_actual, $c_short_description);
    }

    public  function views($blog, $viewValue){
        $this->collectview($blog, $viewValue);
    }

    

}

?>
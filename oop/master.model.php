<?php

class Mastermodel extends Database {

        protected $table;
        protected $key_table;
        protected $key;

//you can show anything by using this method
     protected function globalview($table){
        $select_global = "SELECT * FROM $table";
        $firing_select_global = $this->connect()->prepare($select_global);
        $firing_select_global->execute();
        return $firing_select_global->fetchAll();
    }

    //this method is for showing blogpost

     protected function blogPost($table, $limit){
         $sql_for_blog = "SELECT * FROM $table ORDER BY id DESC LIMIT $limit";
         $firing_sql_for_blog = $this->connect()->prepare($sql_for_blog);
         $firing_sql_for_blog->execute();
         return $firing_sql_for_blog->fetchAll();

     }

 protected function category($realising_array_categories, $get_blog_primary_key){
    foreach($realising_array_categories as $realising_array_category){

    $insertingcategories = "INSERT INTO blogpost_category (blogpost_id, category_id)
     VALUES ('$get_blog_primary_key', '$realising_array_category')";
     $firing_insertingcategories = $this->connect()->prepare($insertingcategories);
     $firing_insertingcategories->execute();
    }

 }

    //This method is for updating contents
    protected function updating($logo, $headtext, $headerdes, $headerimage, $aboutdes, $service, $servicedes, $blogheading, 
    $blogdescription, $contact, $contactdescription, $leftline,
     $leftdescription, $socialheading, $copyright){

        $content_sql = "UPDATE content SET textlogo='$logo', headertext='$headtext', headerdescription='$headerdes', headerbg='$headerimage', aboutdescription='$aboutdes',
    servicesheading='$service', servicesdescription='$servicedes',  blogheading='$blogheading', blogdescription='$blogdescription',
     contactheading='$contact', contactdescription='$contactdescription', footerleftheadline='$leftline',
      footerleftdescription='$leftdescription', socialheading='$socialheading', deadline='$copyright' WHERE id=1";

      $firing_content_sql = $this->connect()->query($content_sql);

     }



//this method is for deleting
     protected function deleteglobal($table_name, $postblog){
        $dlsql = "DELETE FROM $table_name WHERE id='$postblog'";
        $firedlsql = $this->connect()->query($dlsql);
     }

     protected function deleteMmethod($table, $key_table, $key){

         $this->table = $table;
         $this->key_table = $key_table;
         $this->key = $key;

         $delete_sql_stmt = "DELETE FROM $this->table WHERE $this->key_table='$this->key'";
         $lets_go = $this->connect()->query($delete_sql_stmt);
     }
     //this method is for posting comments
     protected function postComments($blog, $user_key, $comment, $comment_date){
        $insertcmnts = "INSERT INTO comments (post_id, user_key, comment, comment_date) VALUE (?,?,?,?)";
        $firing_insertcmnts = $this->connect()->prepare($insertcmnts);
        $firing_insertcmnts->execute([$blog, $user_key, $comment, $comment_date]);
     }

    //this method is for creating blog categories

    protected function CPosts(string $category_actual, string $c_short_description){
        $create_a_category = "INSERT INTO blogpost_meta (category, c_short_description) VALUES (?,?)";
        $firing_create_a_category = $this->connect()->prepare($create_a_category);
        $firing_create_a_category->execute([$category_actual, $c_short_description]);
    }

    //this method is for view creation
    protected function collectview($blog, $viewValue){
        $Insertview = "INSERT INTO views (postId,viewData) VALUE (?,?)";
        $firing_view = $this->connect()->prepare($Insertview);
        $firing_view->execute([$blog, $viewValue]);
        $SelectActualviews = "SELECT count(*) FROM views WHERE postId=$blog";
        $firing_actual_Viewss = $this->connect()->query($SelectActualviews);
 
        $num_of_views = $firing_actual_Viewss->fetchColumn();

        $updating_views = "UPDATE blogpost SET views='$num_of_views' WHERE id=$blog";
        $firing_updating_views = $this->connect()->query($updating_views);
    }

    protected function commentsselection($comments){
        $csql = "SELECT * FROM $comments ORDER BY id DESC";
        $firing_csql = $this->connect()->query($csql);
        return $firing_csql->fetchAll();
    }

//fetch anythng you want
    protected function forTitle($tabledb,$table,$commentId){
        $title_sql = "SELECT * FROM $tabledb WHERE $table=$commentId ORDER BY id DESC";
        $firing_title_sql = $this->connect()->query($title_sql);
        return $firing_title_sql->fetchAll();
    }

    

//this method is for num rows
    protected function rowfetch($comments, $post_id, $blog){
        $selectrow = "SELECT count(*) FROM $comments WHERE $post_id='$blog'";
        $firing_selectrow = $this->connect()->prepare($selectrow);
        $firing_selectrow->execute();
        return $firing_selectrow->fetchColumn();
    }

    //select enything by primary or foreign key using this method

    protected function selectbyid($table, $id, $primarykey){
        $BlogQuery = "SELECT * FROM $table WHERE $id=?";
        $firing_BlogQuery = $this->connect()->prepare($BlogQuery);
        $firing_BlogQuery->execute([$primarykey]);
        return $firing_BlogQuery->fetchAll();
    }

    // protected function selectbyid($table, $id, $primarykey){
    //     $BlogQuery = "SELECT * FROM $table WHERE $id='$primarykey'";
    //     $firing_BlogQuery = $this->connect()->prepare($BlogQuery);
    //     $firing_BlogQuery->execute();
    //     return $firing_BlogQuery->fetchAll();
    // }

}




abstract class PostAndEtc extends Database{

    abstract protected function update(string $col1val, string $col2val,
    string $col3val, string $col4val, string $col5val, int $keyVal);

     abstract protected function upload(int $author, string $col1val, string $col2val,
     string $col3val, string $col4val, string $col5val,string $col6val);
}



class someStuffModel extends PostAndEtc
{
    protected function update(string $col1val, string $col2val,
    string $col3val, string $col4val, string $col5val, int $keyVal){
         $sql = "UPDATE blogpost SET alt=?, title=?, excerpt=?, postcontent=?, postTags=? WHERE id=?";
         $fire_sql = $this->connect()->prepare($sql);
         $fire_sql->execute([$col1val,  $col2val,
          $col3val, $col4val, $col5val,  $keyVal]);
     }

    protected function upload(int $author, string $col1val, string $col2val,
     string $col3val, string $col4val, string $col5val,string $col6val){
         $sql = "INSERT INTO blogpost (author, thumbnail, alt, title, excerpt, postcontent, postTags)
          VALUES (?,?,?,?,?,?,?)";
         $fire_sql = $this->connect()->prepare($sql);
         $fire_sql->execute([$author, $col1val, $col2val,
         $col3val, $col4val, $col5val, $col6val]);
     }
}



?>
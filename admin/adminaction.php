<?php
session_start();
require_once('../ooprequirements.php');
include_once('../function.arrange.php');


if(isset($_SESSION['id'])){
    if($_SESSION['type_of_user'] == 'superadmin' || $_SESSION['type_of_user'] == 'admin'){
    require_once("./admincsrf.php");

        if(isset($_POST['submit'])){
            if(hash_equals($csrf_admin_generator, $_REQUEST['admin_csrf'])){

            //getting posts data
            $author_id = $_SESSION["id"]; 
            $alt = deal_with_quotes($_POST["alt"]);
            $tags = deal_with_quotes($_POST["tags"]);
            $title = deal_with_quotes($_POST["title"]);
            $excerpt = deal_with_quotes($_POST["excerpt"]);
            $editor = deal_with_quotes_without_htmlentities($_POST["editor"]);


            $post__category = $_POST['post__category'];
            $makingarray_post__category  = implode(",", $post__category);
            $realising_array_categories = explode (",", $makingarray_post__category);

    
            $thumbnail = $_FILES["thumbnail"];
            $thumbnailname = $_FILES["thumbnail"]["name"];
            $thumbnailtype = $_FILES["thumbnail"]["type"];
            $thumbnailtmp = $_FILES["thumbnail"]["tmp_name"];
            $thumbnailerror = $_FILES["thumbnail"]["error"];
            $thumbnailsize = $_FILES["thumbnail"]["size"];
        
    
            $thumbext = explode('.',$thumbnailname);
            $thumbactual = strtolower(end($thumbext));
            $fileextCheck = array('jpg','jpeg','png','pdf','psd','svg');
        
    
        $uniq_file_name = '';
        if(in_array($thumbactual, $fileextCheck, TRUE)){
            $uniq_file_name = uniqid('',true).'.'.$thumbactual;
        }
    
        $stfuff_cntr = new StuffCntr();
        $stfuff_cntr->let_me_upload(
            $author_id,
            $uniq_file_name, $alt, $title,
             $excerpt, $editor, $tags  
        );
    
        $cntrobj55 = new Masterview();
        foreach ($cntrobj55->fetchBlogpost('blogpost', 1) as $key => $valueb) {
            $id_last_blog = $valueb['id'];
            $cntrobj56 = new Mastercntr();
            $cntrobj56->cateygorymethod($realising_array_categories, $id_last_blog);
        }
    
        if(in_array($thumbactual, $fileextCheck, TRUE)){
            $directory = '../img/thumbnail';
            $return_file = './addpost.php';
            $return_type = '';
            $id = '';
            upload_img_file($thumbnailerror, $thumbnailsize, $uniq_file_name, $directory,
                 $thumbnailtmp, $return_file, $return_type, $id);
        }

        $_SESSION['csrf__for_admin'] = admin__csrf__token(30);
        header('location: ./addpost.php?success');
            }else {
                header('location: ./addpost.php?submit_rejected');
            }
    
   
        }elseif(isset($_REQUEST['edit'])){
            $id = $_REQUEST["edit_post"];
            if (hash_equals($csrf_admin_generator_for_edit_post, $_REQUEST['admin_csrftoken_edit'])) {
                
                //skipping single quote error!!!
                $title = deal_with_quotes($_REQUEST["title"]);
             
                $excerpt = deal_with_quotes($_REQUEST["excerpt"]);
              
               $editor = deal_with_quotes_without_htmlentities($_REQUEST["editor"]);
               
               $alt = deal_with_quotes($_REQUEST["alt"]);
              
               $tags = deal_with_quotes($_REQUEST["tags"]);
              
    

    
               $thumbnail = $_FILES["thumbnail"];
               $thumbnailname = $_FILES["thumbnail"]["name"];
               $thumbnailtype = $_FILES["thumbnail"]["type"];
               $thumbnailtmp = $_FILES["thumbnail"]["tmp_name"];
               $thumbnailerror = $_FILES["thumbnail"]["error"];
               $thumbnailsize = $_FILES["thumbnail"]["size"];
               $attached_img_file = $_REQUEST['attached_img_file'];
        
          
               $selected_category_keys = $_POST['post__category'];
               $making_category_keys_array = implode(',', $selected_category_keys);
               $thumbext = explode('.',$thumbnailname);
               $thumbactual = strtolower(end($thumbext));
               $fileextCheck = array('jpg','jpeg','png','pdf','psd','svg');
        
        
                
               category_mess($id, $making_category_keys_array);
               // updateBlogPost method call
               $stuff_cntr1 = new StuffCntr();
               $stuff_cntr1->let_me_update($alt, $title, $excerpt,
               $editor, $tags, $id);
        
            if(strlen($thumbnailname) > 0){
            if(in_array($thumbactual, $fileextCheck, TRUE)){
                $directory = "../img/thumbnail";
                $return_file = './edit.php?';
                $uniq__name_of_file = uniqid('',true).'.'.$thumbactual;
        
            upload_img_file($thumbnailerror, $thumbnailsize, $uniq__name_of_file, $directory, $thumbnailtmp, $return_file, 'edit_post', $id);
            update_stringloacal_content($uniq__name_of_file, $id);
           // unlink("$directory/$attached_img_file");
            }else{
            header("./edit.php?file_not_valid");
            }  
            }
            $_SESSION['admin_edit_post'] = admin__csrf__token(24);
            header("location: ./edit.php?edit_post=$id&edit=done");
        
            }else {
                header("location: ./edit.php?edit_post=$id&edit=rejected");
            }

        }elseif(isset($_POST['submitcategory'])){
                 if(hash_equals($csrf_admin_generator_for_category__adding, $_REQUEST['admin_category__token'])){
                    $category_actual = str_replace("'", "\'", htmlentities($_REQUEST['category_name']));
                    $c__desc = str_replace("'", "\'", htmlentities($_REQUEST['c__desc']));
            
                    //creatingCategory function call
            
                    $view = new Masterview();
            
                    $num_of_category = $view->showrow('blogpost_meta', 'category', $category_actual);
            
                    if($num_of_category == 0){
                        $cntr_obj4 = new Mastercntr();
                        $cntr_obj4->createCategory($category_actual, $c__desc);
                        $_SESSION['add_category_token'] = admin__csrf__token(16);
                        header('location: ./categories.php?category_created');
                    }else {
                        unset($category_actual); 
                        unset($c__desc);
                        header('location: ./categories.php?category_exist');
                    }
            
                 }else {
                    header('location: ./categories.php?category_dubmit = rejected');
                 }


        
        

    }elseif(isset($_REQUEST['delete'])){
        $postblog = $_REQUEST['checkposts'];
        $cntr_obj5 = new Mastercntr();
        $len__of__postsarray = count($postblog);
     
        if($len__of__postsarray > 0){
            foreach($postblog as $key => $blog){ 
                $cntr_obj5->delete('blogpost', $blog) ;
            }
            header('location: ./editpost.php?deleted');
        }else{
            header('location: ./editpost.php?not_selected');
        }


      }elseif (isset($_REQUEST['edit_c'])) {
          $cntr2 = new Mastercntr2();
          $key_of_the_category = $_REQUEST['edit_c'];
          $category_slug = $_REQUEST['category_slug'];

          $cntr2->upadte_pp_and_cv('blogpost_meta', 'category', $category_slug, 'id', $key_of_the_category);

      }elseif (isset($_REQUEST['delete_C'])) {
        $key_of_the_category = $_REQUEST['delete_C'];
        $cntr = new Mastercntr();
        $cntr->anOtherdelete('blogpost_meta', 'id', $key_of_the_category);

      }elseif(isset($_POST['updatebtn'])){
          if (hash_equals($csrf_admin_generator_for_site_titles, $_REQUEST['sub__title_token'])) {
            
          
        //individual
        $logo            = $_POST['logo'];
        $headtext        = $_POST['headtext'];
        $headerdes       = $_POST['headerdes'];
        $headerimage     = $_POST["headerimage"];
        $aboutdes        = $_POST['aboutdes'];
        //services
        $service         = $_POST['service'];
        
        $servicedes  = $_POST['servicesdes'];
        //blog
        $blogheading = $_POST['blogheading'];
        $blogdescription = $_POST['blogdescription'];
        //contact
        $contact =   $_POST['contact'];
        $contactdescription = $_POST['contactdescription'];
        
        //footer
        $leftline  = $_POST['leftline'];
        $leftdescription = $_POST['leftdescription'];
        $socialheading = $_POST['socialheading'];
        
        
        //copyright text
        
        $copyright = $_POST['copyright'];
      //updating function call
      $ctnrobj1 = new Mastercntr();
      $ctnrobj1->contents($logo, $headtext, $headerdes, $headerimage, $aboutdes, $service, $servicedes, $blogheading, 
      $blogdescription, $contact, $contactdescription, $leftline,
       $leftdescription, $socialheading, $copyright);

       $_SESSION["subtitle_csrf"] = admin__csrf__token(12);
        header("location: ./content.php?work = done&$headerimage");
    }else {
        header("location: ./content.php?work = rejected");
    }
        }elseif (isset($_REQUEST['editcategorydescription'])) {
           
           $token = $_REQUEST["token"];
           $description =  htmlspecialchars(str_replace("'", "\'", $_REQUEST["description"]));
           $id = $_REQUEST["id"];

           if(hash_equals($csrf__protection__for__category_editing, $token)){
              $cntr2 = new Mastercntr2();
              $cntr2->update__more__safely($description, $id, 'blogpost_meta',  'c_short_description');
die($description);
           }else{
               
           }
        }elseif (isset($_REQUEST["gallery__file"])) {
            $gallery__file = $_REQUEST["gallery__file"];
            
            file_exists($gallery__file) ? unlink($gallery__file) : '';
            echo $gallery__file;
        }elseif (isset($_FILES["galleryFile"])) {
            $image__path = "../img/thumbnail/";
           $valid__files_ext = array("jpg", "jpeg", "png", "psd", "pdf", "gif");

           $g_file_name = $_FILES["galleryFile"]["name"];
           $g_file_tmp = $_FILES["galleryFile"]["tmp_name"];
           $g_file_err = $_FILES["galleryFile"]["error"];
           $g_file_size = $_FILES["galleryFile"]["size"];

           $g_file_divi = explode('.',$g_file_name);
           $g_file_ext = strtolower(end($g_file_divi));
           upload__image();
           
        }elseif (isset($_GET["gallery_next"])) {
          // echo "<h1 style='color:green;'>hey</h1>";
          $limit = $_GET["gallery_next"];
          $endlimit = $limit + 49;
          $directory = "../img/thumbnail/";
          $setImg = array();

           if(is_dir($directory)){
            $read__directory = glob($directory.'*.*');
            $num_of_filesgallery = count($read__directory); 
            //$read__directory is an array make it rv before looping so that we get latest images at starting
            rsort($read__directory); 

            $getfirststate__ofarr = $limit < $num_of_filesgallery ? $limit : exit();
            $getlaststate__ofarr = $endlimit < $num_of_filesgallery ? $endlimit : $num_of_filesgallery;
            

            for ($i=$getfirststate__ofarr; $i < $getlaststate__ofarr; $i++) { 
                $extract__value = $read__directory[$i];
                $img = array("img" => $extract__value);
                 array_push($setImg, $img);
            }
            echo json_encode($setImg);
           }else {
               array_push($setImg, array("img" => "no image found"));
               http_response_code(409);
               echo json_encode($setImg);
           }
        }
    }
}
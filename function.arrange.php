<?php
//user registration function
function user_registration($First_Name, $Last_Name, $User_Gender, $User_Namee,
 $user_normal_password, $User_Password, $confirm_Password, $user_token, $rememberme){

 if(!empty($First_Name) && !empty($Last_Name)){
     
  $view_obj_for_user_reg = new Masterview();
  $master2cntr_obj = new Mastercntr2();

 if(filter_var($User_Namee, FILTER_VALIDATE_EMAIL)){
  $user_provided_length = strlen($user_normal_password);

 $password_length = 6;
  if($user_provided_length >= $password_length){
  if($User_Password === $confirm_Password){

if($view_obj_for_user_reg->showrow('users', 'User_Namee', $User_Namee) != 1){
  
  $master2cntr_obj->signup($First_Name, $Last_Name, $User_Gender, $User_Namee, $User_Password, $user_token);
  
             
  $get_user = $view_obj_for_user_reg->selectanthngbyid('users', 'security_token', $user_token);
  $get_theuser__id = $get_user[0]['id'];
  $master2cntr_obj->profile('users_profile', 'user_id', $get_theuser__id);

  header("location: in.php?wait_we_are_redirecting you && token=$user_token && rememberme=$rememberme");
                        
  }else{
  header("location: register.php?the user has been taken");
  }}else{
  header("location: register.php?password not matched");
  }}else{
  header("location: register.php?password is too short");
  }}else{
  header("location: register.php?enter a valid email");
  }}else{
  header("location: regster.php?fill the required field");
   }
 }


 //this function is for loign system
 function user_login_function($user_token){
    $masterview2_ob_1 = new Masterview2();
    if($masterview2_ob_1->userlogin('users', 'security_token', $user_token) == 1){
        $master_view_session_obj = new Masterview();
        foreach ($master_view_session_obj->selectanthngbyid('users', 'security_token', $user_token) as $key => $session_value) {
    
            $_SESSION['id'] = $session_value['id'];
            $_SESSION['First_Name'] = $session_value['First_Name'];
            $_SESSION['Last_Name'] = $session_value['Last_Name'];
            $_SESSION['User_Gender'] = $session_value['User_Gender'];
            $_SESSION['User_Namee'] = $session_value['User_Namee'];
            $_SESSION['User_Password'] = $session_value['User_Password'];
            $_SESSION['security_token'] = $session_value['security_token'];
            $_SESSION['is_verified'] = $session_value['is_verified'];
            $_SESSION['type_of_user'] = $session_value['type_of_user'];

        }}}

        function admin__csrf__token(int $len){
            $admin__csrftoken = random_bytes(bin2hex($len));
            return $admin__csrftoken;
         }

function store_user_cookie($rememberme, $user_token){
    //start_the_cookie
    if($rememberme == "start_the_cookie" && isset($_SESSION["id"])){
        if(!isset($_COOKIE['Gridweb_user'])){
            setcookie('Gridweb_user', $user_token, time() + (86400 * 150));
        }
    }
}

function session__checking(){
    if(!isset($_SESSION["id"])){
        if(isset($_COOKIE['Gridweb_user'])){
            $user_cookie_token = $_COOKIE['Gridweb_user'];
            user_login_function($user_cookie_token);
        }
    }
}



//this function is for uploading users cuver pic and profile pic
function upload_pp_cv($file_name, $file_error, $file_size, $file_tmp_name, $directory, $sessionid, $table_data, $table_column1){
    
    $file_divide = explode('.', $file_name);
    $dividing_extension = strtolower(end($file_divide));
    $valide_that_ext = array("jpg", "jpeg", "png", "pdf", "psd");

    if(in_array($dividing_extension, $valide_that_ext, TRUE)){
        if($file_error == 0){
           if($file_size <= 100000000000){
            $file_encripted_name = uniqid('').'.'.$dividing_extension;
            $file_dest = "$directory/".$file_encripted_name;
               move_uploaded_file($file_tmp_name, $file_dest);
               $mastercntr3_obj = new Mastercntr2();
               $mastercntr3_obj->uploading($sessionid, $file_encripted_name, $table_data, 'user_id', 'file_meta_data');
               $mastercntr3_obj->upadte_pp_and_cv('users_profile', $table_column1, $file_encripted_name, 'user_id', $sessionid);
               header("location: profile.php?id=$sessionid");
           }else{
            header("location: profile.php?id=$sessionid&&too_much");
           }
        }else{
            header("location: profile.php?id=$sessionid&&something_wrong");
        }
    }else{
        header("location: profile.php?id=$sessionid&&not_valid");
    }

}

/*This function is for Making uploaded profile picture your current.
    Profile picture same thing with cover picture*/

function Update_cover_and_profile_pic_mini($pro_file_meta_data, $column){
    $Mastercntr_update_object_sec = new Mastercntr2();
$Mastercntr_update_object_sec->upadte_pp_and_cv('users_profile', $column, $pro_file_meta_data, 'user_id', $_SESSION['id']);

}

/*This function is for deleting your profile and cover photos*/
function task_to_task($directory, $pro_file_meta_data, $tableee){
    $mastercntr_fir = new Mastercntr();
    $mastercntr_fir->anOtherdelete($tableee, 'file_meta_data', $pro_file_meta_data);
    $removing_multi_type = chop($tableee, 's');

    if(file_exists($directory.$pro_file_meta_data)){
    unlink($directory.$pro_file_meta_data);
}
    $masterview_for_file_checking = new Masterview();
    foreach ($masterview_for_file_checking->selectanthngbyid('users_profile', 'user_id', $_SESSION['id']) as $key => $session_of) {
     $file_of = $session_of["$removing_multi_type"];
     $file_of_p = $session_of["profile_picture"];
     $file_of_c = $session_of["cover_picture"];

    if($pro_file_meta_data === $file_of){
     Update_cover_and_profile_pic_mini(" ", $removing_multi_type);
        }
        $gender = strtolower($_SESSION['User_Gender']).'.png';
        if($pro_file_meta_data === $file_of_p){
            Update_cover_and_profile_pic_mini("$gender", 'profile_picture');
        }

        if($pro_file_meta_data === $file_of_c){
            Update_cover_and_profile_pic_mini("info.jpg", 'cover_picture');
        }


    }

   
}



function show_profile_picture(int $id){

            
    $view = new Masterview();
foreach ( $view->selectanthngbyid('users_profile', 'user_id', $id) as $key => $value) {
    $profile_pictures_dir = 'profile.pictures/';
    $cover_dir_as_profile_pics = 'coverrr.pictures/';
       $profile_picture = $value['profile_picture'];
       
       if(strlen($profile_picture) < 2){
        $vieww = new Masterview();
        foreach ($vieww->selectanthngbyid('users', 'id', $id) as $key => $usrvalue) {
            
            $gender = $usrvalue['User_Gender'];
        
           if($gender == 'Male'){
               echo $profile_pictures_dir.'male.png';
           }elseif ($gender == 'Female') {
               echo $profile_pictures_dir.'female.png';
           }else{
               echo $profile_pictures_dir.'Other.png';
           }
        }
       }else{
           if(file_exists($profile_pictures_dir.$profile_picture)){
               echo $profile_pictures_dir.$profile_picture;
           }else{
               echo $cover_dir_as_profile_pics.$profile_picture;
           }
       }
   }}


   //this function is used for arranging the reaction system

   function reaction_arrange($reaction_cccc, $blog_post_id){
    $masterviw__for_reaction = new Masterview2();
        $num_of_reaction_checking = $masterviw__for_reaction->row_fetching_with_and_operator('reaction', 'post_id', $blog_post_id, 'user_id', $_SESSION['id']);
        if($num_of_reaction_checking == 1){
            $fetch_that_reaction = $masterviw__for_reaction->fetch_with_double_condtioning('reaction', 'post_id', $blog_post_id, 'user_id', $_SESSION['id']);
            foreach ($fetch_that_reaction as $key => $reaction_check) {
                $like_or_dislike = $reaction_check['rection_type'];
                if($like_or_dislike == $reaction_cccc){
                    echo ' reacted';
                break; 
            }}}}

            //reaction function 
            function let_users_react($poId, $uId, $reType){
                $mastercnt__for_reaction = new Mastercntr2();
                $masterviw__for_reaction = new Masterview2();
            
                $num_of_reaction_checking = $masterviw__for_reaction->row_fetching_with_and_operator('reaction', 'post_id', $poId, 'user_id', $uId);
                if($num_of_reaction_checking != 1){
                    $mastercnt__for_reaction->insert_that_cant_be_injected($poId, $uId, $reType);
                }else{
                    $fetch_that_reaction = $masterviw__for_reaction->fetch_with_double_condtioning('reaction', 'post_id', $poId, 'user_id', $uId);
                    foreach ($fetch_that_reaction as $key => $reaction_value) {
                        $reaction_type_fetched = $reaction_value["rection_type"];
                        if ($reaction_type_fetched == $reType) {
                            $mastercnt__for_reaction->delete_with_and_op('reaction', 'post_id', $poId, 'user_id', $uId);
                        }else{
                            $mastercnt__for_reaction->update_with_and_op('reaction', 'rection_type', $reType, 'post_id', $poId, 'user_id', $uId);
            
                        }
                        
                    }
                    
            
                }
            }


            //count total likes and dislikes

            function total_amount_of_reactions($post, $type_of_reaction){
                $master_view_for_reaction_checking = new Masterview2(); 
                $total_re = $master_view_for_reaction_checking->row_fetching_with_and_operator('reaction', 'post_id', $post, 'rection_type', $type_of_reaction);
                echo $total_re;
            }

            //reaction labels dec function
            function reaction_label_dec($reaction_label_plur, $reaction_label_sing, $post, $type_of_reaction){
                $master_view_for_reaction_checking_s = new Masterview2(); 
                $checking = $master_view_for_reaction_checking_s->row_fetching_with_and_operator('reaction', 'post_id', $post, 'rection_type', $type_of_reaction);
                if($checking > 1){ echo ' '.$reaction_label_plur; }else{echo ' '.$reaction_label_sing; }  
            }


            function active__page(string $path, string $className){
                if($_SERVER['PHP_SELF'] == $path){
                  echo ' '.$className;
                }
              
              }


//category mess
            function category_mess($id, $making_category_keys_array){
                $view_obj_for_eding_category = new Masterview();
                foreach ($view_obj_for_eding_category->selectanthngbyid('blogpost_category', 'blogpost_id', $id) as $key => $blogpostid) {
                            $blogids = $blogpostid['blogpost_id'];
                            $category_cntrr = new Mastercntr();
                            $category_cntrr->anOtherdelete('blogpost_category', 'blogpost_id', $blogids);
                        }

                        if(count($making_category_keys_array) > 0){
                            $exolding_category_keys_array = explode(',', $making_category_keys_array);
                            $view_obj_for_eding_categoryse = new Mastercntr();
                            $view_obj_for_eding_categoryse->cateygorymethod($exolding_category_keys_array, $id);
                        }
            }

//content update
            function update_stringloacal_content($uniq__name_of_file, $id){
               $master2ctnrrrr = new Mastercntr2();
               $master2ctnrrrr->upadte_pp_and_cv('blogpost', 'thumbnail', $uniq__name_of_file, 'id', $id);
     
            }

            function upload_img_file($thumbnailerror, $thumbnailsize, $uniq__name_of_file, $directory,
             $thumbnailtmp, $return_file, $return_type, $id){
                if($thumbnailerror == 0){
                    if ($thumbnailsize <= 400000000000) {
                        $file_destination = "$directory/".$uniq__name_of_file;
                        move_uploaded_file($thumbnailtmp, $file_destination);
                    
                        header("location: $return_file$return_type=$id");
                    }else {
                        header("$return_file?file_size_too_big");
                    }
                }else{
                    header("$return_file?error");
                }
            }

            function header__image(string $filename, string $first__path, string $second_path){
                $image__path_no_one = $first__path.$filename;
                $image__path_no_two = $second_path.$filename;
               echo file_exists($image__path_no_one) ? $image__path_no_one : $image__path_no_two;
            }
            
            
           function upload__image(){
            global $image__path;
            global $valid__files_ext;
            global $g_file_name;
            global $g_file_tmp;
            global $g_file_err;
            global $g_file_size;
            global $g_file_ext;
 
            if (in_array($g_file_ext, $valid__files_ext)) {
             if ($g_file_err == 0) {
              if ($g_file_size <= 400000000000) {
 
                  $g_file_name = uniqid("")."grid_gallery.".$g_file_ext;
                  $path = $image__path.$g_file_name;
                  move_uploaded_file($g_file_tmp, $path);
                 
                  gallery_data(true, $g_file_name);
                 }else {
                  $alter__ntmsg = gallery__backup_message('file is too big');
                  gallery_data(false, $alter__ntmsg);
                 }
             }else {
              $alter__ntmsg = gallery__backup_message('File cant be uploaded!!!');
              gallery_data(false, $alter__ntmsg);
             }
          
 
       }else{
         $alter__ntmsg = gallery__backup_message('file not valid');
          gallery_data(false, $alter__ntmsg);
        
       }
            }
            
            function gallery__backup_message(string $message){
                return "<h3 class='file__not__valid'><strong>Sorry!!! </strong>$message</h3>";
            }


            function alternative__message($msg1, $msg2){
                if(isset($msg1)){ 
                    return $msg1; 
                   }else{
                   return $msg2;
               }
            }

            
function fetch_last_id(string $db_table){
    $masterView_for_blog = new Masterview();
    foreach ($masterView_for_blog->fetchBlogpost($db_table, 1) as $key => $b_value_for_b_p) {
    return $b_value_for_b_p['id'];
 }}
 
 function bio__data(string $type, string $bio){
    $data__array = array("type" => $type,"biodata" => $bio);
    echo json_encode($data__array);
}

function gallery_data(bool $valid, string $dataset__value){
    $gallery__data = array("valid" => $valid, "dataset__value" => $dataset__value);
    echo json_encode($gallery__data);
}

function author___info(int $author__id, string $desired___value){
$view = new Masterview();
$get__info = $view->selectanthngbyid('users_profile', 'user_id', $author__id);
foreach ($get__info as $key => $value) {
   return $value[$desired___value];
}
}

//This function is used to dealing with quotes


function deal_with_quotes(string $data){
    $get_data = addslashes(htmlentities($data));
    return $get_data;
}

function decode_quotes(string $data){
        $get_data = stripslashes($data);
        return $get_data;
}
    
function deal_with_quotes_without_htmlentities(string $data){
    $get_data = addslashes($data);
    return $get_data;
}
//total_images__forgallery function used for showing total number of images of admin gallery
function total_images__forgallery(){
    global $num_of_filesgallery;
    echo "<p class='total__images'>";
    echo "Total";
    echo $num_of_filesgallery > 1 ? ' images ' : ' image ';
    echo " left : <strong id='number__of_files_in_gallery'>$num_of_filesgallery</strong> </p>";
}

   //This function is for comments and its a  very very important
   function comment($id, $csrftoken){
    $viewobj1 = new Masterview();
    foreach ($viewobj1->cmnttitle('comments', 'post_id', $id) as $key => $commentactual) { 
        $user_key = $commentactual['user_key']; 
        $commentID = $commentactual['id'];
        ?>
    <div  class="comment__label-section" <?php if(isset($_SESSION['id'])){ 
    if($user_key == $_SESSION['id']){ echo "data-comment-block=$commentID";  } }?>>
         <div class="actual__comment--block">
    <?php 
    $view_obj_for_user = new Masterview();
    foreach ($view_obj_for_user->selectanthngbyid('users', 'id', $user_key) as $key => $user_details) { 
        $user_ID = $user_details['id'];
        $fname = $user_details['First_Name'];
        $lname = $user_details['Last_Name'];
        ?>
     <div class="cmnt_arrange_box">
    <div class="user-block-for-comment-section">
    <a href="profile.php?id=<?php echo $user_ID; ?>"><img src="<?php show_profile_picture($user_key); ?>" alt="<?php echo $fname.' '.$lname; ?>" class="profile_shortcurt_image cmnter_profile_pivture"></a>
    
    <a class="u_link" href="profile.php?id=<?php echo $user_ID; ?>">
    <h3 class="user-detail-in-comment" style="text-align: center;">
    
    <b><span><?php echo $fname; ?></span>
    <span> <?php echo $lname; if(isset($_SESSION['id']) == true){
        if($user_key == $_SESSION['id']){ 
            echo '<span style="font-weight:600;color:red;">(you)</span>';
         } 
    } ?>
    </span>
    </b>
    </h3>
    </a>
    </div>
    <?php if(isset($_SESSION['id'])){ 
        if($_SESSION['id'] == $user_key){ ?>
        <div class="button-group">
        <input type="hidden" id="update__and__deletecsrf__token" value="<?php echo $csrftoken; ?>">
        <button class="edit-btn edit edit-event" data-commentlabel="<?php echo $commentactual['comment']; ?>"
         data-check="<?php  echo $commentID; ?>" onclick="commentEdit(event)"><i class="fas fa-pen editcmnt"></i></button>
        <a class="delete-btn delete" onclick="deleteComment(event)" data-comment-delete="<?php echo $commentID; ?>"><i class="far fa-trash-alt deletecmnt"></i></a>
    </div>
       <?php }} ?>
    
    </div>
    
        <?php } ?>
    <div class="comment__description comment__description2">
    <div class="comment">
    <p data-id-for-up-comment=<?php  echo $commentID; ?> class="comment__label"><?php echo $commentactual['comment']; ?></p>
    </div>
    <div class="comment date" data-read=<?php echo $commentID; ?> >
    <p class="Comment-date"><?php echo $commentactual['comment_date']; ?></p>
    
    </div>
    <?php
    
    if(isset($_SESSION["id"])){ if($user_key === $_SESSION["id"]){ ?>
                 <div class="edit_textrea" data-comment="<?php  echo $commentID; ?>"></div>
                                  <?php }} ?>
    </div>
    </div>      
    </div>
    
    <?php   } } ?>
 
 <?php

    function adminCheck(string $warnning__text){ ?>
  <div style="
    width: 100%;
    min-height: 100vh;
    display: grid;
    place-items: center;
">
<div
   style="text-align:center;"
><h1><?php echo $warnning__text; ?></h1>
  <h1 id="kick__out" style="
  background: #f7f7f7;
  padding: 0.5em 1em;
  border-radius: 50%;">
5</h1></div>
  </div>
 <?php  } ?>
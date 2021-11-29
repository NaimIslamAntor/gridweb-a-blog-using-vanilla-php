<?php
session_start();
require_once('ooprequirements.php');
include_once('function.arrange.php');

if(isset($_SESSION['id']) && isset($_SESSION['User_Namee']) && isset($_SESSION['security_token'])){
    $session_id = $_SESSION['id'];
    include 'csrftoken.php';

if(isset($_REQUEST['ppsubmit'])){
if(hash_equals($upload__token, $_REQUEST["csrf__upload__token"])){
    

    $file = $_FILES["user_profile_picture"];
    
    $file_name = $_FILES["user_profile_picture"]["name"];
    $file_type = $_FILES["user_profile_picture"]["type"];
    $file_tmp_name = $_FILES["user_profile_picture"]["tmp_name"];
    $file_error = $_FILES["user_profile_picture"]["error"];
    $file_size = $_FILES["user_profile_picture"]["size"];
    
    

    $directory = 'profile.pictures';
    $table_data = 'profile_pictures';
    $table_column1 = 'profile_picture';

    upload_pp_cv($file_name, $file_error, $file_size, $file_tmp_name,
     $directory, $_SESSION['id'], $table_data, $table_column1);
   
    }else{
        header("location: profile.php?id=$session_id&&Request=rejected");
    }
}elseif(isset($_REQUEST['bbpicsubmit'])){
    if(hash_equals($upload__token, $_REQUEST["csrf__upload__token"])){
    $file = $_FILES["user_profile_picture"];
    $file_name = $_FILES["user_profile_picture"]["name"];
    $file_type = $_FILES["user_profile_picture"]["type"];
    $file_tmp_name = $_FILES["user_profile_picture"]["tmp_name"];
    $file_error = $_FILES["user_profile_picture"]["error"];
    $file_size = $_FILES["user_profile_picture"]["size"];
    
    $directory = 'coverrr.pictures';
    $table_data = 'cover_pictures';
    $table_column1 = 'cover_picture';

    upload_pp_cv($file_name, $file_error, $file_size, $file_tmp_name,
    $directory, $_SESSION['id'], $table_data, $table_column1);
}else{
    header("location: profile.php?id=$session_id&&Request=rejected");
}
}elseif(isset($_REQUEST["profile"]) && isset($_REQUEST["update__pp_and_cp__token"])){
    if(hash_equals($upload__token, $_REQUEST["update__pp_and_cp__token"])){

    $pro_file_meta_data = $_REQUEST["proval"];
    $column = 'profile_picture';
    $table = 'profile_pictures';
    Update_cover_and_profile_pic_mini($pro_file_meta_data, $column);
    header("location: profile.php?id=$session_id");
    //uploading($table, $_SESSION['id'], 'file_meta_data', 'user_id', $_SESSION['id']);
}
}elseif(isset($_REQUEST["cover"]) && isset($_REQUEST["update__pp_and_cp__token"])){
    if(hash_equals($upload__token, $_REQUEST["update__pp_and_cp__token"])){
    $pro_file_meta_data = $_REQUEST["proval"];
    $column = 'cover_picture';
    Update_cover_and_profile_pic_mini($pro_file_meta_data, $column);
    header("location: profile.php?id=$session_id");
    }
}elseif (isset($_REQUEST["e"]) && isset($_REQUEST["update__pp_and_cp__token"])) {
    if(hash_equals($upload__token, $_REQUEST["update__pp_and_cp__token"])){
    $directory = $_REQUEST['directory'];
    $pro_file_meta_data = $_REQUEST['proval'];
    $tableee = $_REQUEST['tableee'];

    task_to_task($directory, $pro_file_meta_data, $tableee);
    header("location: profile.php?id=$session_id");
    }
    
}elseif (isset($_REQUEST["commenting"]) && isset($_REQUEST["comment__csrf__token"])) {

if(hash_equals($csrftoken__forposting_comments, $_REQUEST["comment__csrf__token"])){

    $post_id = $_REQUEST["post_id"];
    $comment = str_replace("'", "\'", $_REQUEST["comment"]);
    $user_key = $_SESSION['id'];
    $date = getdate(Date("U"));
    $comment_date = "$date[mday] $date[month] $date[year]";
    //commenting method call
     $cntr_obj2 = new Mastercntr();
     $cntr_obj2->comments($post_id, $user_key, $comment, $comment_date);

     comment($post_id, $csrftoken__forposting_comments);
    }
}elseif (isset($_REQUEST["click"]) && $_REQUEST["click"] === "forUpdate" && isset($_REQUEST["edittoken"])) {
    if (hash_equals($csrftoken__forposting_comments, $_REQUEST["edittoken"])) {
        
    $cmntVal = $_REQUEST["cmntVal"];
    $cmntId = $_REQUEST["cmntId"];

    $mastercntr_ajax_object = new Mastercntr2();
    $mastercntr_ajax_object->upadte_pp_and_cv('comments', 'comment', $cmntVal, 'id', $cmntId);
}

}elseif (isset($_REQUEST["comment_id"]) && isset($_REQUEST["token"])) {
    if(hash_equals($csrftoken__forposting_comments, $_REQUEST["token"])) {
        
    $id = $_REQUEST["comment_id"];
    $masterview_delete_object = new Mastercntr();
    $masterview_delete_object->anOtherdelete('comments', 'id', $id);
}
}elseif(isset($_REQUEST["reaction"]) && isset($_REQUEST["reactioncsrf__token"])){
    if(hash_equals($reaction__token, $_REQUEST["reactioncsrf__token"])){

    $poId = $_REQUEST["poId"];
    $uId = $_REQUEST["uId"];
    $reType = $_REQUEST["reType"];
    let_users_react($poId, $uId, $reType);
}
}elseif(isset($_REQUEST["bioRequest"]) && isset($_REQUEST["biotoken"])) {
    if ($_SESSION["type_of_user"] == "superadmin" || $_SESSION["type_of_user"] == "admin") {
        $bio = htmlentities(html_entity_decode(htmlspecialchars_decode(str_replace("'", "\'", $_REQUEST["bio"]))));

        $id = $_SESSION["id"];
        if (hash_equals($upload__token, $_REQUEST["biotoken"])) { 
            $cntr2 = new Mastercntr2();
            $modified___bio = $_SESSION["First_Name"]." ".$_SESSION['Last_Name']."_______++++---".$bio;
            $cntr2->update__bio($modified___bio, $id); 

            bio__data("Yes", $bio);
        }else{
            bio__data("No", "Your csrf token isnot valid!!!");
        }
    }
    
    
    }
    
    }
<?php include 'header.php';

if(isset($_SESSION['id']) && isset($_SESSION['User_Namee']) && isset($_SESSION['security_token'])
&& isset($_REQUEST['id'])){
$id = $_REQUEST['id']; ?>

<section class="pp_section"><div class="pp_container"><?php $masterview = new Masterview();
foreach ($masterview->selectanthngbyid('users_profile', 'user_id', $id) as $key => $uvalue) {
$profile_pic = strlen($uvalue['profile_picture']);
$cover_pic = strlen($uvalue['cover_picture']);
$profile_picture_dir = 'profile.pictures/'; $cover_picture_dir = 'coverrr.pictures/'; 
?>

<div class="pp_box" style="background-image: url(<?php if($cover_pic < 2){  echo $cover_picture_dir.'info.jpg';
 }else{ if(file_exists($cover_picture_dir.$uvalue['cover_picture'])){
echo $cover_picture_dir.$uvalue['cover_picture']; }else{ echo $profile_picture_dir.$uvalue['cover_picture']; } } ?>)">
<div class="profile"><img src="<?php $masterview1 = new Masterview();
foreach ($masterview1->selectanthngbyid('users', 'id', $id) as $key => $userrvalue) {
  $user___type = $userrvalue["type_of_user"];
$gender = $userrvalue['User_Gender']; if($profile_pic < 2){ if($gender == 'Male')
{ echo $profile_picture_dir.'male.png'; }else if($gender == 'Female'){ echo $profile_picture_dir.'female.png'; }else{ echo $profile_picture_dir.'Other.png';
}}else{ if(file_exists($profile_picture_dir.$uvalue['profile_picture'])){ echo $profile_picture_dir.$uvalue['profile_picture'];
}else{ echo $cover_picture_dir.$uvalue['profile_picture']; 
} } ?>" alt="<?php echo $userrvalue['First_Name'].' '.$userrvalue['Last_Name']; ?>" class="profile_picture">

    
<?php if($_SESSION['id'] == $id){ echo '<i class="fas fa-pencil-alt ppend"></i>'; } ?> </div>
<?php if($_SESSION['id'] == $id){ echo '<div class="bacK_edit"><i class="fas fa-pencil-alt backedit"></i></div>'; } ?>

<h1 class="user_f_and_l_name"><?php echo $userrvalue['First_Name'].' '.$userrvalue['Last_Name']; ?></h1>
</div>
<?php
if($user___type == "superadmin" || $user___type == "admin"){ 
  $bioinfo = explode("_______++++---", $uvalue["bio"]);
  $bio = $bioinfo[1];
  ?>
<div class="bio__boxof__author"><h2 <?php   if($id == $_SESSION["id"]){ ?> ondblclick="updateBio(event)"
data-biotoken="<?php echo $upload__token; ?>"
<?php   } ?> id="bioauthor" class="biotext"><?php echo $bio; ?></h2></div><?php } ?>

<?php } if($_SESSION['id'] == $id){ ?> <script type="text/javascript"><?php require_once("./js/scriptforbio.js"); ?></script>
<div class="pp_update_box">
<form class="Pro_file_pic_updater" enctype="multipart/form-data" action="in2.php" method="post"><h3 class="text"></h3>
<i class="far fa-times-circle exit"></i><div class="pp_file"><center>
<input id="csrf_token_for_upload_pp_cp" type="hidden" name="csrf__upload__token" value="<?php echo $upload__token; ?>">
<input type="file" name="user_profile_picture">
<br><br>
<button id="upbtn" class="increasebutton" type="Submit" name="ppsubmit">UPLOAD</button></center></div>
</form>
</div>
<?php } ?>
</div>
<?php
if(isset($_REQUEST["not_valid"])){echo "<h1 class='warning'>Picture isn't valid <br>please upload a valid picture!</h1>";
}else if(isset($_REQUEST["something_wrong"])){echo "<h1 class='warning'>Something is wrong please try again now. <br>Or later</h1>";
}else if(isset($_REQUEST["too_much"])){echo "<h1 class='warning'>The file is too big file max<br>is 10MB!!!</h1>";}
?>
</section>

<section class="pp_se_section"><div class="pp_se_container">
          <?php $Mster1 = new Masterview(); if($Mster1->showrow('profile_pictures', 'user_id', $id) > 0){ ?>
<div class="p_box_fi"><div class="profile_gallery">

<img src="<?php if(file_exists($profile_picture_dir.$uvalue['profile_picture'])) {echo $profile_picture_dir.$uvalue['profile_picture']; }else{
echo $cover_picture_dir.$uvalue['profile_picture'];} ?>" alt="" class="gallery_element"> </div></div>
<?php } $Mster2 = new Masterview(); if($Mster2->showrow('cover_pictures', 'user_id', $id) > 0){ ?>
<div class="p_box_se"><div class="profile_gallery cover">
<img src="<?php if(file_exists($cover_picture_dir.$uvalue['cover_picture'])){ echo $cover_picture_dir.$uvalue['cover_picture'];
}else{ echo $profile_picture_dir.$uvalue['cover_picture'];
} ?>" alt="<?php echo $uvalue['cover_picture']; ?>" class="gallery_element">
</div>
</div>      
<?php }  ?></div></section><?php   } ?>

<h1 class="gallery_type"></h1><section class="gallery_section"></section>

<div class="val_wrapper"> <?php $masterview_p = new Masterview();
foreach ($masterview_p->selectanthngbyid('profile_pictures', 'user_id', $id) as $key => $pvalue) { ?>
<input class="p_input" type="hidden" value="profile.pictures/<?php echo $pvalue['file_meta_data']; ?>"> <?php  } ?></div>
<div class="c_val_wrapper"> <?php $masterview_p2 = new Masterview();
foreach ($masterview_p2->selectanthngbyid('cover_pictures', 'user_id', $id) as $key => $pvalue) { ?>
<input class="c_input" type="hidden" value="coverrr.pictures/<?php echo $pvalue['file_meta_data']; ?>"> <?php  } ?></div>
<a href="in.php?logout">Log Out</a> 
<?php
}else{ header('location: http://localhost/gridweb?you have to login to visit this page'); } 
?>
<?php
 include 'footer.php';
?>
<script type="text/javascript"><?php  require_once("./js/profilescript.js"); ?></script>
<noscript>Please enable javascript of your browser to access this page properly</noscript>

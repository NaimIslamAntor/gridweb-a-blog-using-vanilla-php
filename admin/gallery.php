<?php require_once('admin-sidebar.php'); ?>
<?php if(isset($user__status)){
if($user__status == "superadmin" || $user__status == "admin") { ?>
<section id="gallery__section">

<?php

$directory = "../img/thumbnail/";
    //get the length of directory
 
$length_of_directorytext = strlen($directory);
    //read the ../img/thumbnail/directory using PHP glob function

try {
   if(is_dir($directory)){
   $read__directory = glob($directory.'*.*');
   $num_of_filesgallery = count($read__directory); 
   //$read__directory is an array make it rv before looping so that we get latest images at starting
   rsort($read__directory); 
   ?>
<!-- file uploading form -->
<div class="fileform__holder">
<form id="uploadForm" enctype="multipart/form-data">
<input type="file" id="galleryFile" name="galleryFile[]" multiple required>
<button type="submit" id="file__uploaderbtn"  class="upload__btnfor_gallery"><i class="fas fa-cloud-upload-alt do_not__distrub"></i></button>
</form>
</div>
<!-- this code is for showing progress on file upload -->
<!-- <div id="progressBar" class="progressbar__modal">
<div class="progress__bar">
<div class="progress">0</div>
<div class="precentage__icon">%</div>
</div>
</div> -->

<h1 class="section_label"><?php echo "<strong>".$_SESSION['First_Name']."'s</strong>"; ?> Gallery</h1><?php total_images__forgallery(); ?>
<center class="uploadbtn__parent"><button id="uploadImage" class="upload__btnfor_gallery">Upload</button></center>
<div class="gallery__container" data-dirlength="<?php echo $length_of_directorytext; ?>">
<?php if ($num_of_filesgallery > 0) {
foreach ($read__directory as $key => $image__path) { 
        //get name of those files by slicing the directory using PHP substr function.
$name_of_image = substr($image__path, $length_of_directorytext); ?>
<div class="gallery__item" onclick="popLightBox(event)" data-image="<?php echo $name_of_image; ?>"><img src="<?php echo $image__path; ?>" alt="<?php echo $name_of_image; ?>" class="gallery__image"></div>
<?php 
if ($key === 49) { break; }

}}else { echo "<h1 class='no_file'>There are no images in your gallery</h1>"; } ?></div>
<center><button type="button" id="loadGalleryBtn" class="upload__btnfor_gallery load__btn">Load More</button></center>
<div id="lightbox__handler"></div>
<script type="text/javascript"><?php
require_once('./js/gallery.js'); 
//gallery.js file is needed for uploadgallery.js so be patience to edit those.
require_once('./js/uploadgallery.js'); 
require_once($_SERVER["DOCUMENT_ROOT"]."/gridweb/admin/js/loadgallery.js");
?>

</script>
<!-- <script src="<?php //echo $_SERVER['DOCUMENT_ROOT'].'/gridweb/admin/js/loadgallery.js'; ?>"></script> -->
<?php }else{ throw new Exception("Something wrong happened");
}} catch (Exception $th) { echo "<h1 class='exception__ofgallery'>$th</h1>"; }
?>

</section>

<?php } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>

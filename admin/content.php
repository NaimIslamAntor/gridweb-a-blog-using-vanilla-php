<?php require_once('admin-sidebar.php'); ?>
<?php

if (isset($user__status)) {
    if ($user__status == "superadmin" || $user__status == "admin") { 
        $header_bg_path_one = "../img/"; $header_bg_path_two = "../img/thumbnail/";
        ?>
        
<div class="content__box--site">
<div class="content__label--and-input">
<form action="./adminaction.php" class="content_form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="sub__title_token" value="<?php echo  $csrf_admin_generator_for_site_titles; ?>">       
<?php $view_content_obj = new Masterview();
    foreach ($view_content_obj->globalshowview('content') as $key => $content) { ?>

        <label for="logo">Your Text Logo</label>
<input type="text" id="logo" name="logo" value="<?php echo $content['textlogo']; ?>" autocomplete="off">
<label for="headertext">Your Header Text</label>
<input type="text" id="headertext" name="headtext" value="<?php echo $content['headertext']; ?>" autocomplete="off">
<label for="headerdescription">Header Description</label>
<textarea name="headerdes" id="headerdescription" cols="40" rows="12" style="resize:none;"><?php echo $content['headerdescription']; ?></textarea>
<label for="bginput">Header Background</label>
<input type="text" id="bginput" name="headerimage" value="<?php echo $content['headerbg']; ?>"><br><br>
<img src="<?php  header__image($content['headerbg'], $header_bg_path_one, $header_bg_path_two); ?>" alt="header-image" id="bg">
<label for="aboutdescription">Your About Description</label>
<textarea name="aboutdes" id="aboutdescription" cols="40" rows="12"><?php echo $content['aboutdescription']; ?></textarea>
<!-- <label for="abbg">About Background</label>
<img src="../img/<?php //echo $content['aboutbg']; ?>" alt="" id="abbg"> -->
<label for="servicelabel">Service Heading</label>
<input type="text" name="service" id="servicelabel" value="<?php echo $content['servicesheading']; ?>">
<label for="servicedes">Service Description</label>
<textarea name="servicesdes" id="servicedes" cols="40" rows="12"><?php echo $content['servicesdescription']; ?></textarea>
<label for="bloglabel">Blog Heading</label>
<input type="text" name="blogheading" id="bloglabel" value="<?php echo $content['blogheading']; ?>">
<label for="blogedes">Blog Description</label>
<textarea name="blogdescription" id="blogedes" cols="40" rows="12"><?php echo $content['blogdescription']; ?></textarea>
<label for="contactlabel">Contact Heading</label>
<input type="text" name="contact" id="contactlabel" value="<?php echo $content['contactheading']; ?>">
<label for="contactdes">Contact Description</label>
<textarea name="contactdescription" id="contactdes" cols="40" rows="12"><?php echo $content['contactdescription']; ?></textarea>
<label for="leftlabel">footer Left Line</label>
<input type="text" name="leftline" id="leftlabel" value="<?php echo $content['footerleftheadline']; ?>">
<label for="leftdes">Footer Left Description</label>
<textarea name="leftdescription" id="leftdes" cols="40" rows="12"><?php echo $content['footerleftdescription']; ?></textarea>
<label for="sociallabel">Social Heading</label>
<input type="text" name="socialheading" id="sociallabel" value="<?php echo $content['socialheading']; ?>">
<label for="daedline">Copyright Text</label>
<textarea name="copyright" id="daedline" cols="40" rows="12"><?php echo $content['deadline']; ?></textarea>
<?php } ?>

<button name="updatebtn" type="submit" class="btn-content">UPDATE</button>
</form>
</div>

</div>

<?php  } } ?>

<?php require_once('admin-sidebar-footer.php'); ?>
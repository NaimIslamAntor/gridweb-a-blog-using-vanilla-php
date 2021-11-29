<?php require_once('admin-sidebar.php'); ?>
<?php

if(isset($user__status)){
  if ($user__status == "superadmin" || $user__status == "admin") { ?>

<?php
 if(isset($_GET['edit_post']));

       $postno = $_GET['edit_post'];
   
        $edit_view_obj = new Masterview();
        foreach ($edit_view_obj->selectanthngbyid('blogpost', 'id', $postno) as $key => $data) { 
               //$title = decode_quotes($data['title']);  ?>
<div class="post__container">
<form class="form__manager" method="POST" action="./adminaction.php" enctype="multipart/form-data">
<input type="hidden" name="admin_csrftoken_edit" value="<?php echo $csrf_admin_generator_for_edit_post; ?>">
<div class="img">
<input type="file" name="thumbnail">
<img src="../img/thumbnail/<?php echo $data['thumbnail']; ?>" class="myimg">
<input type="hidden" value="<?php echo $data['thumbnail']; ?>" name="attached_img_file">
<br><br>
<div>
<input type="text" name="alt" placeholder="Alt Tag" class='alt-tag' value="<?php echo decode_quotes($data['alt']); ?>" >

<input onchange="modifiedTags(event, '#post__tags')" type="text" name="tags" placeholder="post Tags" class='alt-tag' id="post__tags"  value="<?php echo decode_quotes($data['postTags']); ?>">
</div>
</div>
<input type="text" placeholder="Post Title" class="post_title" name="title"
 value="<?php echo decode_quotes($data['title']); ?>" required autocomplete="off">

<input type="text" placeholder="Post Excerpt" class="post_title excerpt" name="excerpt" 
value="<?php echo decode_quotes($data['excerpt']); ?>"  required autocomplete="off">

<textarea name="editor" class="post__editor" required autocomplete="off">
<?php echo  decode_quotes($data['postcontent']); ?></textarea>
<?php //fetching all categories using globalshowview method
$view_post_objrrr = new Masterview();
$blogpost_category_row = $view_post_objrrr->showrow('blogpost_category', 'blogpost_id', $postno);
if($blogpost_category_row < 1){ ?>
<br>
<br>
<h2 style="color: red;text-transform:uppercase;">This post has no category!!!</h2>
<br>
<?php }
 $view_post_obj = new Masterview();
          foreach ($view_post_obj->globalshowview('blogpost_meta') as $key => $categories) {
            $category = $categories['id'];
                ?> 

<input  <?php  //fetching selected category for current post
 $view_post_objooo = new Masterview();
foreach ($view_post_objooo->selectanthngbyid('blogpost_category', 'blogpost_id', $postno) as $key => $keyval) {
          $category_check_id = $keyval['category_id'];

if($category == $category_check_id){ echo "Checked"; } } ?> 
 type="checkbox" name="post__category[]" value="<?php echo $category; ?>">
             
<label for="post__category"><?php echo $categories['category']; ?></label><br>
<?php } ?>

<input type="hidden" value="<?php echo $data['id']?>" name="edit_post">
<input type="submit" value="Edit" class="submit--btn" name="edit">
</form>

<?php  } ?>
<?php } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>

<?php require_once('admin-sidebar.php'); ?>

<?php

if(isset($user__status)){
   if($user__status == "superadmin" || $user__status == "admin"){ ?>
      
<div class="post__container">
<form class="form__manager" method="POST" action="./adminaction.php" enctype="multipart/form-data">
<input type="hidden" name="admin_csrf" value="<?php echo $csrf_admin_generator; ?>">
<div class="img">
<input type="file" name="thumbnail">
<input type="text" name="alt" placeholder="Alt Tag" class='alt-tag'>

<input onchange="modifiedTags(event, '#post__tags')" type="text" name="tags" placeholder="post Tags" class='alt-tag' id="post__tags" " value>
</div>
<input type="text" placeholder="Post Title" class="post_title" name="title" required autocomplete="off">
<input type="text" placeholder="Post Excerpt" class="post_title excerpt" name="excerpt" required autocomplete="off">
<textarea name="editor" class="post__editor" required autocomplete="off"></textarea>
<?php
   $view_post_obj = new Masterview();
foreach ($view_post_obj->globalshowview('blogpost_meta') as $key => $categories) { ?>
<input type="checkbox" name="post__category[]" value="<?php echo $categories['id']; ?>">
<label for="post__category"><?php echo $categories['category']; ?></label><br>
<?php } ?>

<input type="submit" value="Post" class="submit--btn" name="submit">
</form>
</div>

<?php } } ?>

<?php require_once('admin-sidebar-footer.php'); ?>
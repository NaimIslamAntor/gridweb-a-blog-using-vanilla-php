<?php require_once('admin-sidebar.php'); ?>
<?php

if(isset($user__status)){
  if ($user__status == "superadmin" || $user__status == "admin") { ?>

<div class="comment__box">
<table class="table">
  <tr  class="table__header table-row">
 
    <th>Post id</th>
    <th>Post title</th>
    <th>Post Tags</th>
  </tr>
  <?php 
  
  $view_tags_obj = new Masterview();
  foreach ($view_tags_obj->globalshowview('blogpost') as $key => $blogcontent) { ?>
<tr class="table-row">
    <td><?php echo $blogcontent['id']; ?></td>
    <td><?php echo $blogcontent['title']; ?></td>
    <td><?php echo $blogcontent['postTags']; ?></td>
  </tr>
 
  <?php } ?>


  
 
  </table>

</div>
<?php } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>
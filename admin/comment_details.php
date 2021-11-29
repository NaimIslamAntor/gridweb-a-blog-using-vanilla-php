<?php require_once('admin-sidebar.php'); ?>
<?php

if(isset($user__status)){
  if($user__status == "superadmin" || $user__status == "admin"){ ?>

<div class="comment__box">
<table class="table">
  <tr  class="table__header table-row">
    <th>Comment No</th> <th>Post title</th> <th>Comments</th> <th>Who</th>
  </tr>
  <?php
  $viewobj1 = new Masterview();
  foreach($viewobj1->selectcmnt('comments') as $comnt => $comment){
  $commentId = $comment['post_id']; 
  $user_id = $comment['user_key'];
 
 $viewobj2 = new Masterview();
  foreach($viewobj2->cmnttitle('blogpost','id', $commentId) as $ptitle => $post){ ?> 
<tr class="table-row">
    <td><?php echo $commentId; ?></td>
    
    <td> <?php echo $post['title']; ?></td>
    <td><?php echo $comment['comment']; ?></td>
    <td><?php 
    $viewobj3 = new Masterview(); 
    foreach ($viewobj3->selectanthngbyid('users', 'id', $user_id) as $key => $user_value) { ?>
      <a href="../profile.php?id=<?php echo $user_value['id']; ?>" class="user__on_comment e_and_d__link"><?php echo $user_value['First_Name'].' '.$user_value['Last_Name']; ?></a>
   <?php }
    ?></td>
    
  </tr>
  <?php  } } ?>
  </table>
</div>

<?php } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>






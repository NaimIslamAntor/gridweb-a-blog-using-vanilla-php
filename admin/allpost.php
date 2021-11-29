<?php require_once('admin-sidebar.php'); ?>

<?php

if(isset($user__status)){
  if($user__status == "superadmin" || $user__status == "admin"){ ?>

<table class="table" style="overflow:scroll;">

        <tr class="table__header table-row">
         <th>Post No</th>
           <th>Title</th>
           
          <th>views</th>
        </tr>
  
  <?php      $viewobjposts = new Masterview();  //showing blogs details
          foreach($viewobjposts->selectcmnt('blogpost') as $key => $post){ 
            $blog = $post['id']; ?>
            <tr class="table-row">
         <td><a target="_blank" href="../descriptionblog.php?post=<?php echo $blog; ?>"  class="post__link"><?php echo $blog; ?></a></td>
         <td><?php echo decode_quotes($post['title']); ?></td>
           <td style="text-align:center;"><?php echo $post['views'];?></td>
  </tr>
         <?php } ?>

  </table>
  <?php } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>
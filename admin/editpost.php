<?php require_once('admin-sidebar.php'); ?>
<?php

if(isset($user__status)){
    if($user__status == "superadmin" || $user__status == "admin"){ ?>
<form  action="./adminaction.php" method="POST" class="post__editibg__actionform">

<!-- <div class="action__container">
       <select name="post__action" id="post__action">
       <option value="delete__multiple__posts">Delete</option>
       </select>
       <button name="check" type="submit">Action</button>
</div> -->

<table class="table edit_delete__post">

    <thead>
        <tr class="table__header table-row">
        <th class="blank__column"></th>
        <th>Title</th>
        <th class="blank__column"></th>
        </tr>
    </thead>
    <tbody>
       <?php    $viewonj_for_edit = new Masterview();
              foreach ($viewonj_for_edit->selectcmnt('blogpost') as $key => $post) { 
                $blog = $post['id']; 
              
                ?>

                <tr class="table-row">
    <td class="blank__column"><input type="checkbox" name="checkposts[]" value="<?php echo $blog; ?>" class="marking__post"></td>
    <td><?php echo decode_quotes($post['title']); ?></td>
    <td class="blank__column"><a class="e_and_d__link editpostlink" href="edit.php?edit_post=<?php echo $blog; ?>">Edit</a></td>
</tr>
    <?php } ?>
    </tbody>

</table>
<center><button 
id="deletepost__actionbtn" name="delete" 
type="submit">Delete</button></center>
</form>



<?php  } } ?>
<?php require_once('admin-sidebar-footer.php'); ?>
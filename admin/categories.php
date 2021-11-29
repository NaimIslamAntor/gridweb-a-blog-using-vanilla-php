<?php require_once('admin-sidebar.php'); ?>
<div id="category__wrapper">
<?php

if(isset($user__status)){
  if($user__status == "superadmin" || $user__status == "admin"){ ?>

<table class="table" style="overflow: scroll;text-align: center;">

  <tr class="table__header table-row">
    <th>Categories List</th>
    <th>Posts</th>
    <th>Action</th>
  </tr>
 
<?php
//fetching categories and number of posts per categories start here
        $viewobj_category_slug = new Masterview();
        foreach ($viewobj_category_slug->globalshowview('blogpost_meta') as $key => $categories) {
          $cateyid = $categories['id']; 
          $viewobj_category_num = new Masterview();
          $num_rows = $viewobj_category_num->showrow('blogpost_category', 'category_id', $cateyid); ?>
<tr class="table-row">
    <td class="first_td_node"><span data-description-of-category="<?php echo $categories['category'].'-------------------------'.$categories['c_short_description'].'-------------------------'.$categories['id'].'-------------------------'.$csrf__protection__for__category_editing; ?>" 
    class="td_cat_label edit__description_of_category"><?php echo $categories['category']; ?></span></td>
    <td><?php echo $num_rows; ?></td>
    <td><a class="e_and_d__link" href="#"
     onclick="deleteCategory(event, <?php echo $cateyid; ?>)">Delete</a> or 
     <a class="e_and_d__link" href="#" onclick="editCategory(event, <?php echo $cateyid; ?>)">Edit</a></td>
  </tr>
      <?php  }
       //fetching categories and number of posts per categories end here 
       ?>
 
  </table>
<br><br><br>

<form class="category__form"  action="./adminaction.php" method="POST">
<h1 class="e_and_d__link" style="text-align: center;" >Create Your Category</h1>
<input type="hidden" name="admin_category__token" value="<?php echo $csrf_admin_generator_for_category__adding; ?>">
<input type="text" placeholder="Category name" class="post_title cp__input" name="category_name" required autocomplete="off">
<textarea placeholder="Category Description" name="c__desc"  rows="10" class="category__description" required autocomplete="off"></textarea>
<br>
<br>
<input type="submit" value="Create" class="submit--btn" name="submitcategory">
<br><br><br>
</form>
<div class="spin_parent">
<div class="loadingio-spinner-rolling-r0syn5r7h9j"><div class="ldio-aa34gtelyo9">
<div></div>
</div></div></div>
<?php } } ?>
</div>
<?php require_once('admin-sidebar-footer.php'); ?>
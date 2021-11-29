<?php
require_once('header.php');

 if(isset($_REQUEST['category'])){
   $c_id = $_REQUEST['category'];
   $category_name = null;

   if(isset($_REQUEST['category_name'])){
    $category_name = $_REQUEST['category_name'];
   }
   
   $e_message = "Category name is missing from the url";
   
   $view = new Masterview();
   $num_of_posts = $view->showrow('blogpost_category', 'category_id', $c_id);
   if($num_of_posts > 0){
?>

<section class="category__base_section">
    <h1 class="category__heading"><?php echo alternative__message($category_name, $e_message);  ?></h1>
           <div class="category__base_container">
               <?php $m_view = new Masterview();
               foreach ($m_view->selectanthngbyid('blogpost_category', 'category_id', $c_id) as $key => $c_value) {
                   $blogpost_id = $c_value['blogpost_id'];
                          foreach ($m_view->selectanthngbyid('blogpost', 'id', $blogpost_id) as $key => $b_value) { ?>
               
               <div class="category__base_post">
                   <a class="c_p__link" href="./in.php?post=<?php echo $b_value['id']; ?>">
                   <div class="thumbnail__image_block">
                       <img src="./img/thumbnail/<?php echo $b_value['thumbnail']; ?>" alt="<?php echo $b_value['alt']; ?>" class="thumbnail__image">
                   </div>
                   </a>
                   <div class="title__block">
                   <a  class="c_p__link" href="./in.php?post=<?php echo $b_value['id']; ?>">
                       <h3 class="title_c"><?php echo decode_quotes($b_value['title']); ?></h3>
                          </a>
                   </div>
               </div>
               <?php }} ?>
           </div>
</section> 
<?php }else{ ?>
           <div class="caregory__post_alternative">
               <div class="alternative__image">
                   <img src="./img/opps.svg" alt="opps" class="alternative__img">
               </div>
               <h1 class="alternative__heading">Sorry currently we have no posts in <strong class="c__strong">
                   <?php echo alternative__message($category_name, $e_message);  ?></strong> category</h1>
                
           </div>
    <?php } } ?>
<?php  require_once('footer.php');   ?>
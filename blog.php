<?php require_once("header.php"); ?>
<?php if(isset($_REQUEST['page'])){ $blog__page = htmlspecialchars($_REQUEST['page']);

if(!empty($blog__page) && is_numeric($blog__page)){
$our_view_tow_object = new Masterview2(); $our_view_tow_object_two = new Masterview();

$num_of_row_of_b = $our_view_tow_object->fetch_row_fastly('blogpost','id');

$a__num = ceil($num_of_row_of_b/10);

if($blog__page > 0 && $blog__page <= $a__num){
    $cut_it_out = ($blog__page * 10)-10;

    $gridblog_dependency = array(
        'page' => $blog__page,
        'latest_post' => $cut_it_out,
    ); 
    $active__page__Dependency = $gridblog_dependency['page'];
    
    ?>
<section id="blog">
       <div class="blog__breadcomb">
       <a href="http://localhost/gridweb/" class="bread__nav-link">Home / </a>
       <a href="blog.php?page=1" class="bread__nav-link">Blog</a>
       </div> <div class="blog__pagecontainer">

<?php foreach ($our_view_tow_object->grid__pagination_query('blogpost', 'id', 10, $cut_it_out) as $key => $post_value) { 
    $post_id = $post_value['id'];  $author_id = $post_value['author'];
    $num_of_comments =  $our_view_tow_object_two->showrow('comments', 'post_id', $post_id); ?>
    
              <div class="post__holder"> <div class="post__image">
                      <img src="./img/thumbnail/<?php echo $post_value['thumbnail']; ?>" alt="<?php echo $post_value['alt']; ?>" class="postimage">
                     <div class="reaction__and_author">
                     <div class="reaction__holder">
                          <span class="reaction__spam post_like">
                          <i class="fas fa-thumbs-up total__likes"></i><span class="number__oflike">(<?php total_amount_of_reactions($post_id, 'like'); ?>)</span>
                          </span>
                          <span class="reaction__spam post_dislike">
                          <i class="fas fa-thumbs-down total__dislikes"></i><span class="number__ofdislike">(<?php total_amount_of_reactions($post_id, 'dislike'); ?>)</span>
                          </span>
                          <span class="reaction__spam post_dislike comment__nums">
                          <i class="fas fa-comment-alt total__comments"></i><span class="number__ofdislike numsss_of_comment">(<?php echo $num_of_comments; ?>)</span>
                          </span>
                      </div>
                      <div class="author">
                      <h3 class="gridauthor">
                      <?php foreach ($our_view_tow_object_two->selectanthngbyid('users', 'id', $author_id) as $key => $author_value) {
                          $author__fullname = $author_value['First_Name']." ".$author_value['Last_Name']; ?>

                              <img src="<?php  show_profile_picture($author_id); ?>" alt="<?php echo $author__fullname; ?>" class="author__image">
                          <span class="author__shortinfo">by <strong>
                          <?php echo $author__fullname; } ?>
                          </strong></span></h3>
                  </div></div>
                </div>
                <div class="post__shortcontent">
                    <a href="./in.php?post=<?php echo $post_id ?>"><h5 class="posttitle"><?php echo  decode_quotes($post_value['title']); ?></h5></a>
                </div>
                </div><?php } ?></div> <div class="grid__posts__pagination_container">

  <?php
  if($active__page__Dependency > 1){ ?>
<a href="blog.php?page=<?php echo $gridblog_dependency['page']-1; ?>" class="grid__pagination__link">Prev</a><?php } ?>

<?php

//This code is for managging blog pagination.
//starting with two undifiend varriables and.
//changing the state based upon the url and the number of pages.

$page__starting__point;
$page__ending__point;

if($a__num <= 5 && $blog__page <= 5){
    $page__starting__point = 1;
    $page__ending__point = 5;
    if($a__num < $page__ending__point){
        $page__ending__point = $a__num; }

}elseif($a__num > 5 && $blog__page < 4){
    $page__starting__point = 1;
    $page__ending__point = 5;

}elseif ($a__num > 5 && $blog__page >= 4) {

    $page__starting__point = $blog__page - 2;
    $page__ending__point = $blog__page + 2;  

    if($page__ending__point > $a__num){

        $page__ending__point = $a__num;
        $page__starting__point = $page__ending__point - 4;
    }}
//pagination logic ends here. 
?>

<?php for ($i=$page__starting__point; $i <= $page__ending__point; $i++) { ?> 
<a 

 href="blog.php?page=<?php echo $i; ?>" class="pagination grid__pagination__link
  <?php if($active__page__Dependency == $i){
echo "active__blog_page"; } 


?> "><?php echo $i; ?></a> 

<?php  }  ?>
<?php if($a__num != $gridblog_dependency['page']){ ?>

<a href="blog.php?page=<?php echo $gridblog_dependency['page']+1; ?>" class="grid__pagination__link">Next</a><?php } ?>
</div></section>

<?php } }  } ?>
<script src="./js/blog.js"></script>
<?php require_once("footer.php"); ?>
<?php require_once('header.php');
        
    if(isset($_GET['post'])){ $blog = $_GET['post']; $master__view_for_fetchrow = new Masterview();

        $post_exist_or_not = $master__view_for_fetchrow->showrow('blogpost', 'id', $blog);
        if($post_exist_or_not == 1){

        $viewblog = new Masterview();
        foreach ($viewblog->selectanthngbyid('blogpost','id', $blog) as $key => $actual_Post) {
            $author = $actual_Post['author']; ?>
            
            <div class="spin_parent">
<div class="loadingio-spinner-rolling-r0syn5r7h9j">
    <div class="ldio-aa34gtelyo9">
<div></div>
</div></div></div>
<section class="title__section">
    <h1 class="title__post"><?php echo decode_quotes($actual_Post['title']); ?></h1>
    <div class="date__category--tags">
        <span class="siblings sib1"><?php echo $actual_Post['date']; ?></span>
        <span class="siblings category_friend">Category : </span>
        <?php
        //for category  

        $viewobjcat1 = new Masterview();
     foreach ($viewobjcat1->selectanthngbyid('blogpost_category', 'blogpost_id', $blog) as $key => $blogpos_id_catching) {
         $category_id = $blogpos_id_catching['category_id'];
                $viewobjcat2 = new Masterview();
        foreach ($viewobjcat2->selectanthngbyid('blogpost_meta', 'id', $category_id) as $key => $category_label) {
            $category_label_val = $category_label['category']; ?>
  
                   
        <span class="siblings category_sibling"><?php echo $category_label_val.",";  ?>
         
         
         </span>
        <?php } } ?>
        <span class="siblings">Tags : <?php echo decode_quotes($actual_Post['postTags']); ?></span>
        <?php 
        //fetching views for blogposts
              $masterview_obj_for_view = new Masterview();
              $firing_view_counts_num = $masterview_obj_for_view->showrow('views', 'postId', $blog);
         ?>
    <span style="text-align:center;" class="siblings view"><?php if($firing_view_counts_num > 1 )
        { echo "views : ".$firing_view_counts_num; }else{
            echo "view : ".$firing_view_counts_num;
        }?></span>
        
    </div>
</section>

<section class="content__section">
    <div class="img--features">
       <div class="img__author_infooo">
       <img src="./img/thumbnail/<?php echo $actual_Post['thumbnail']; ?>"
        alt="<?php echo decode_quotes($actual_Post['alt']); ?>" class="features-thumbnail">
       <div class="author__info_post_grid">
           <div class="author__profilepic">
               <h3 class="is_author">Author: </h3>
               <img src="<?php show_profile_picture($author); ?>" alt="grid-author" class="author__pic">
               <?php
              $bio__info = author___info($author, "bio"); 
              $bio__info_break = explode("_______++++---", $bio__info);
              $author__name = $bio__info_break[0];
              $author__bio = $bio__info_break[1];
               ?>
               <h3 class="a__name"><?php echo $author__name; ?></h3>
           </div>
           <div class="author__bio">
         
              <?php echo $author__bio; ?>
           </div>
       </div>
       </div>      
    </div>
    <form  class="reaction">
    <input type="hidden" id="reactioncsrf__token" name="reactioncsrf__token" value="<?php echo $reaction__token; ?>">
    <button <?php if(isset($_SESSION['id'])){?> data-total="total_likes" data-totalop="total_dislikes" data-reaction-class-op="dislike" onclick="react(event, <?php echo $_SESSION['id']; ?>, 'like', <?php echo $blog; ?>)" 
        <?php } else { ?>  onclick="login(event, 'liking')" <?php } ?> 
    class="react like<?php if (isset($_SESSION['id'])) { reaction_arrange('like', $blog); } ?>"><i class="fas fa-thumbs-up"></i></button>


    <button  <?php if(isset($_SESSION['id'])){?> data-total="total_dislikes" data-totalop="total_likes" data-reaction-class-op="like" onclick="react(event, <?php echo $_SESSION['id']; ?>, 'dislike', <?php echo $blog; ?>)" 
        <?php } else { ?>  onclick="login(event, 'disliking')" <?php } ?> 
        class="react dislike<?php if (isset($_SESSION['id'])) { reaction_arrange('dislike', $blog);} ?>"><i class="fas fa-thumbs-down"></i></button>
    </form>
    
    <div class="reaction_count">
        <h5 class="count like_count"><span id="total_likes" >
        <?php total_amount_of_reactions($blog, 'like'); ?></span><span class="reaction_type"><?php 
        reaction_label_dec('Likes', 'Like', $blog, 'like'); ?></span></h5>

        <h5 class="count dislike_count"><span id="total_dislikes">
        <?php total_amount_of_reactions($blog, 'dislike'); ?></span><span class="reaction_type">
        <?php reaction_label_dec('Dislikes', 'Dislike', $blog, 'dislike'); ?></span></h5>

    </div>
    <div class="content---blog">
        <?php echo decode_quotes($actual_Post['postcontent']); ?>
    </div>
</section>

<section class="blog">
    <div class="blog__container">
        
      <?php      $masterviewongrel1 = new Masterview();
    foreach ($masterviewongrel1->selectanthngbyid('blogpost_category', 'blogpost_id', $blog) as $key => $blogpos_id_catching) {
                $category_id = $blogpos_id_catching['category_id'];
                $masterviewongrel2 = new Masterview();
    foreach ($masterviewongrel2->selectanthngbyid('blogpost_category', 'category_id', $category_id) as $key => $reco_data) {
                $blogpost_id = $reco_data['blogpost_id'];
                $masterviewongrel3 = new Masterview();
    foreach ($masterviewongrel3->selectanthngbyid('blogpost', 'id', $blogpost_id) as $key => $reco_blogpost) {
                    $post = $reco_blogpost['id'];
                       
         if($post == $blog){?>
                     
<div class="blog__main" style="display:none;">
</div>
<?php }else{?>
    <div class="blog__main">
            <div class="blog__box">
                <div class="blog__thumbnail">
                <a href="in.php?post=<?php echo $post; ?>">
                    <img src="./img/thumbnail/<?php echo $reco_blogpost['thumbnail']; ?>" alt="<?php echo $reco_blogpost['alt']; ?>" class="post__thumbnail">
                     </a>
                </div>
                <div class="blog__content">
                <a href="in.php?post=<?php echo $post; ?>">
                    <h2 class="post__title">
                    
                    <?php echo decode_quotes($reco_blogpost['title']); ?>
                    </h2>
                    </a>
                    <a href="in.php?post=<?php echo $post; ?>">
                    <p class="post_excerpt"><?php echo decode_quotes($reco_blogpost['excerpt']); ?>
                    </p>
                     </a>
                    <a href="in.php?post=<?php echo $post; ?>" class="btn">Read More</a>
                </div>
            </div>
        </div>
             <?php   }} } } ?>
               
    </div>
</section>

<?php

if(isset($_SESSION['id'])){?>
<section class="comment__section">
    <form method="POST" action="./in2.php">
    <input type="hidden" name="comment__csrf__token" id="comment__csrf__token" value="<?php echo $csrftoken__forposting_comments; ?>">
        <div class="comment__description">
            <textarea id="comment" name="comment" class="comment__class" placeholder="Write Your's Comment"></textarea>
        </div>
        <input id="post_id" type="hidden"  value="<?php echo $blog; ?>">
        <center><input onclick="postComment(event)" type="submit" value="POST"  class="comment__button"></center>
        <br>
    </form>
    <div id="done"></div>
</section>
<?php }else{?>
<div style="text-align: center;">
<a href="http://localhost/gridweb/register.php">Sign Up</a><span> or </span> 
<a href="http://localhost/gridweb/#login">Log in</a> <span>for posting a comment</span>
</div>
<?php } ?>
<?php $viewobj3 = new Masterview();
$num_of_cmnts = $viewobj3->showrow('comments', 'post_id', $blog);?>
<h2 class="total__comments"><span>Total : </span><span class='num_of_comments'><?php echo $num_of_cmnts; ?></span></h2>
<section class="comment-section">
<?php  comment($blog, $csrftoken__forposting_comments);   echo '</section>'; 

 }}else{
     include 'post_doesnot_exist.php';
 }}   
?>
<?php
if(isset($_SESSION["id"])){ ?>
            <script src="js/postComment.js"></script> 
            <script src="js/comment.js"></script>
            <script src="js/deletecomment.js"></script> 
            <?php }else{ ?>
          <script src="js/commentarr.js"></script>
          <?php  } ?> 
          <script src="js/reaction.js"></script>
          <script src="js/fixingissues.js"></script>

          <noscript>You need to enable your browser's javascript to enjaoy all features</noscript>
<?php
require_once('footer.php'); 
?>


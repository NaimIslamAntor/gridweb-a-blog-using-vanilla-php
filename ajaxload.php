<?php 
require_once('oop/configoop.php');
require_once('oop/master.model.php');
require_once('oop/master.cntr.php');
require_once('oop/master.view.php');

$limit = $_POST['limitvalue'];

     $blogview_obj = new Masterview();
     foreach ($blogview_obj->fetchBlogpost('blogpost', $limit) as $key => $blog__post) {
         $post = $blog__post['id'];
          $posttitle = $blog__post['title']; ?>
    
    <div class="blog__main">
            <div class="blog__box">
            <?php $data = 1; ?>
            <a href="in.php?post=<?php echo $post; ?>"><div class="blog__thumbnail">
                    <img src="./img/thumbnail/<?php echo $blog__post['thumbnail']; ?>" alt="<?php echo $blog__post['alt']; ?>" class="post__thumbnail">
                </div></a>
                <div class="blog__content">
                <a href="in.php?post=<?php echo $post; ?>"><h2 class="post__title">
                        <?php echo $blog__post['title']; ?>
                    </h2></a>
                    
                    <a href="in.php?post=<?php echo $post; ?>"><p class="post_excerpt"><?php echo $blog__post['excerpt']; ?></p></a>
                    <a href="in.php?post=<?php echo $post; ?>" class="btn">Read More</a>

                </div>
            </div>
            
        </div>
        
     <?php   } ?>
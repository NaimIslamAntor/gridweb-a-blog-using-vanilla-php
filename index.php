
<?php 
require_once('header.php');
?>

<?php
$header_bg_path_one = "./img/";
// $header_bg_path_one = __DIR__."/img/";
 $header_bg_path_two = "./img/thumbnail/";
// $header_bg_path_two = __DIR__."/img/thumbnail/";
// $header_bg_path_two = dirname(__FILE__)."/img/thumbnail/";

$showingobj2 = new Masterview();
foreach($showingobj2->globalshowview('content') as $show => $content){ ?>


<main class="main">
<div class="bgfull" style="background-image: linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),
url(<?php header__image($content['headerbg'], $header_bg_path_one, $header_bg_path_two); ?>);">
    <div class="textab">
        <h1><?php echo $content["headertext"]; ?></h1>
        <p><?php echo $content["headerdescription"]; ?></p>
    </div>
</div>

 <section class="services">
     <h1 class="service__section--heading"><?php echo $content["servicesheading"]; ?></h1>
    <p class="service__section_sammarry"><?php echo $content["servicesdescription"]; ?></p>
    <div class="servicess__container">
        <div class="main__box">
            <div class="service__box">
            <i class="fas fa-desktop"></i>
            <div class="content__box">
                <h1 class="service__headline">Web Design</h1>
                <p class="service__content">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Reprehenderit eveniet eligendi, adipisci soluta dicta nulla optio architecto incidunt fugit nam atque harum omnis ipsa doloremque laudantium nemo ea recusandae alias.</p>

            </div>
        </div>
        </div>

        <div class="main__box">
            <div class="service__box">
                <i class="fas fa-code"></i>
            <div class="content__box">
                <h1 class="service__headline">Web Development</h1>
                <p class="service__content">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Reprehenderit eveniet eligendi, adipisci soluta dicta nulla optio architecto incidunt fugit nam atque harum omnis ipsa doloremque laudantium nemo ea recusandae alias.</p>

            </div>
        </div>
        </div>

        <div class="main__box">
            <div class="service__box">
                <i class="fas fa-laptop"></i>
            <div class="content__box">
                <h1 class="service__headline">WordPress</h1>
                <p class="service__content">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Reprehenderit eveniet eligendi, adipisci soluta dicta nulla optio architecto incidunt fugit nam atque harum omnis ipsa doloremque laudantium nemo ea recusandae alias.</p>

            </div>
        </div>
        </div>
    </div>
</section>

<section class="blog" id="blog__section">
<h1 class="service__section--heading blog---heading"><?php echo $content["blogheading"]; ?></h1>
    <p class="service__section_sammarry blog--sammarry"><?php echo $content["blogdescription"]; ?></p>
    <div class="blog__container" id="blogcontainer">


            <?php $blog_view_obj = new Masterview();
            foreach($blog_view_obj->fetchBlogpost('blogpost', 9) as $blog => $blog__post){
                $post = $blog__post['id'];
                $posttitle = $blog__post['title'];
                ?>
<div class="blog__main">
            <div class="blog__box"><a href="in.php?post=<?php echo $post; ?>"><div class="blog__thumbnail">
                    <img src="./img/thumbnail/<?php echo $blog__post['thumbnail']; ?>" alt="<?php echo $blog__post['alt']; ?>" class="post__thumbnail"></div></a>
                <div class="blog__content"><a href="in.php?post=<?php echo $post; ?>"><h2 class="post__title">
                        <?php echo decode_quotes($blog__post['title']); ?></h2></a>
                    <a href="in.php?post=<?php echo $post; ?>"><p class="post_excerpt"><?php echo decode_quotes($blog__post['excerpt']); ?></p></a><a href="in.php?post=<?php echo $post; ?>" class="btn">Read More</a>
                </div></div></div><?php  } ?>
    </div>
        <center><button class="increasebutton" id="loadcliking">Load More</button></center>
        <span id="login"></span></section><?php } ?>

<?php if(isset($_SESSION['id'])){ ?>  <?php }else{ ?>
    <p  style='text-align:center;margin-top:10px;'>Don't have an accout
    <a href="http://localhost/gridweb/register.php"> Click Here</a></p>
<?php }  ?>

<section class="categories__section">
        <div class="categories__container">
        <?php
        session__checking();
        
        ?>
        <div class="c__heading--block"><h1 class="categories__heading service__section--heading">Categories</h1>
         <p class="categories__subheading">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p></div>
         <?php $view_for_categories = new Masterview(); 
                     foreach ($view_for_categories->globalshowview('blogpost_meta') as $key => $c_value) {
                         $c__id = $c_value['id'];
                        $amount_of_posts = $view_for_categories->showrow('blogpost_category', 'category_id', $c__id); ?>

        <div class="category__parent"><div class="category__name"> <div class="category__slug__and--icon__divider">
                <span>  <a href="./categorybase.php?category=<?php echo $c__id; ?>&category_name=<?php echo $c_value['category']; ?>" class="category__link"><?php echo $c_value['category']; ?></a>
                <span>(<?php echo $amount_of_posts; ?>)</span></span>
                  <i class="fas fa-plus category-plus" onclick="readCategoryShortDescription(event)"></i>
                  </div></div>
              <div class="category__short__description"><p class="c__short-description"><?php echo $c_value['c_short_description']; ?>
             </p></div></div> <?php  } ?>
        </div> </section>

<?php require_once('footer.php');

?>




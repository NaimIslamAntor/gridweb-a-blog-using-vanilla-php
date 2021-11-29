<?php 
require_once('ooprequirements.php');
$showingobj3 = new Masterview();
foreach($showingobj3->globalshowview('content') as $show => $content){ ?>
<footer class="footer"><div class="footer__container"><div class="footer__item"><div class="some__description">
<h3 class="reason--why"><?php echo $content["footerleftheadline"]; ?></h3><p class="reason"><?php echo $content["footerleftdescription"]; ?>
</p></div></div>
<div class="recent__post--serch-section"><form class="Search--form"  method="GET" action="http://localhost/gridweb/search/">
<input name="query" type="text" placeholder="Serch" class="search" autocomplete="off" required><button  type="submit" class="Search--btn">Search</button></form>
<div class="recent__post"><ul class="recent__post--label">

<?php   $blog_obj2 = new Masterview();
foreach($blog_obj2->fetchBlogpost('blogpost', 6) as $blogs => $blog__post){ 
 $blog = $blog__post['id']; ?>

<a class="anqaur__link" href="descriptionblog.php?post=<?php echo $blog; ?>"><li class="recent--type"><img src="./img/thumbnail/<?php echo $blog__post['thumbnail']; ?>" 
alt="<?php echo decode_quotes($blog__post['alt']); ?>" class="recent--img"><p class="post--title"><?php echo decode_quotes($blog__post['title']); ?></p></li></a>
<?php } ?>
</ul></div></div>
<div class="link__item">
<h4 class="social__label"><?php echo $content["socialheading"]; ?></h4>
<ul class="social_links">
<li><a href="#">FaceBook</a></li>
<li><a href="#">InstaGram</a></li>
<li><a href="#">TwiTter</a></li>
<li><a href="#">LinkedIn</a></li>
<li><a href="#">MySpace</a></li>
</ul></div></div>
</footer>
<div class="footertext"><p class="copright__text"><?php echo $content["deadline"]; ?></p>  </div>
<?php   } ?>
</main>
    <script src="js/file.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/load.js"></script>
    <script src="./admin/js/adminlogin.js"></script>
<script>
//ajax post load
$(document).ready(function(){
    var limit = 9;
    $("#loadcliking").click(function(){
        limit = limit + 3;
        $("#blogcontainer").load("ajaxload.php",
        {
            limitvalue:limit
        });
    });

});

</script>


</body>
</html>

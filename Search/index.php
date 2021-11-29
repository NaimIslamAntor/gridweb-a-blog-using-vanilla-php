<?php
session_start();
require_once('../ooprequirements.php');
include_once('../function.arrange.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   <?php
   include "style.css";
   ?>
    </style>
</head>
<body>

<div class="search_bar" style="display:flex;justify-content:center;padding-bottom:3em;">
<form action="http://localhost/gridweb/search/" method="GET">

<div class="search_cont">
    <h1 style="text-align:center;"><a style="color:#000;" href="http://localhost/gridweb">Gridweb</a></h1>
<div  class="searchhhh" style="display:flex;">
<input class="searchbar-input" type="text" name="query" placeholder="Search" value="<?php
if(isset($_REQUEST['query'])){
    $add__slash = deal_with_quotes($_REQUEST['query']);
    echo decode_quotes($add__slash);
}
?>">
<button class="serach-btn" typr="submit"  >Search</button>
</div>
</div>

</form>

</div>
<?php if(isset($_REQUEST['query'])){
     $query = deal_with_quotes($_REQUEST['query']);
     if(strlen($query) >= 3){

            $masterviewr_finding_reults = new Masterview2();
            $results = $masterviewr_finding_reults->search_result('blogpost', 'title', 'excerpt', 'postcontent', 'postTags',
            $query);
            if($results > 0){ ?>
            <h1 style="text-align:center"><?php if($results > 1){
    echo $results." results found";
}else{
    echo $results." result found";
}?></h1>

<section class="search_section">
    <div class="search__container">
    <?php  $masterview_for_finding = new Masterview2();
        foreach ($masterview_for_finding->search('blogpost', 'title', 'excerpt', 'postcontent', 'postTags',
         $query) as $key => $serach_content) {
            
            ?>
                 <div class="blog__main" style="padding-bottom:1.5em;">
            <div class="blog__box">
                <div class="blog__thumbnail">
                <a href="../in.php?post=<?php echo $serach_content['id']; ?>">
                    <img src="../img/thumbnail/<?php echo $serach_content['thumbnail']; ?>" alt="<?php echo $serach_content['alt']; ?>" class="post__thumbnail">
                    </a>
                </div>
                <div class="blog__content">
                <a href="../in.php?post=<?php echo $serach_content['id']; ?>">
                    <h2 class="post__title"><?php echo $serach_content['title']; ?>                       
                    </h2>
                    </a>
                    <a href="../in.php?post=<?php echo $serach_content['id']; ?>"><p class="post_excerpt">
                    <?php echo $serach_content['excerpt']; ?>
                    </p></a>
                    
                    
                </div>
            </div>
           
        </div>

        <?php  } }else{ echo "<h1 style='
               text-align:center;
               color:red;
               font-weight:600;
            '>No Results Found!</h1>"; } }else { ?>
               
                <figure class="search__divbackup__container">
                <img src="../img/opps.svg" alt="Opps!!!" class="search__backhupmessage">
                <h1 class="empty__backup">Write something proper for searching!!!</h1>
                </figure>
                
               
         <?php   } } ?>

    </div>
</section>

</body>
</html>
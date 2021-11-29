<?php
session_start();
require_once('ooprequirements.php'); 
include_once('function.arrange.php');
session__checking();


?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My first web application</title><link rel="stylesheet" href="css/style.css" type="text/css"><link rel="stylesheet" href="css/style3.css" type="text/css">
<link rel="stylesheet" href="css/style2.css" type="text/css"><link rel="stylesheet" href="./admin/css/style.css" type="text/css"><link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="css/blog.css" type="text/css">
<link rel="stylesheet" href="./icon/fontawesome/css/all.min.css"></head><body><?php
$showingobj1 = new Masterview();

foreach($showingobj1->globalshowview('content') as $show => $content){ ?>
<header class="header"><div class="container__menu"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div></div>
<div class="logo"><h1><a style="color:#000;" href="http://localhost/gridweb/"><?php echo $content["textlogo"]; ?></a></h1></div>
<nav class="nav">
<?php $page__mainbase = '/gridweb/'; $class__name = 'active'; ?>
<ul class="menu"><?php   if(isset($_SESSION['id'])){ ?>
     
<?php  if($_SESSION['type_of_user'] == 'superadmin' || $_SESSION['type_of_user'] == 'admin'){ ?>
<li><a target="__blank" href="http://localhost/gridweb/admin/">Go to Admin Panel</a></li> <?php } ?>
<li class="header__list<?php active__page($page__mainbase.'profile.php', $class__name); ?>"><a  href="profile.php?id=<?php echo $_SESSION['id']; ?>">
<div class="enter_profile">           
<img id="profile_load"
 src="<?php show_profile_picture($_SESSION['id']); ?>" alt="<?php echo $_SESSION['First_Name'].' '.$_SESSION['Last_Name']; ?>" class="profile_shortcurt_image">
</div></a></li>
<?php } ?>

<li class="header__list<?php active__page($page__mainbase.'index.php', $class__name); ?>"><a href="http://localhost/gridweb/">Home</a></li>
<li class="header__list<?php active__page($page__mainbase.'people.php', $class__name); ?>"><a href="people.php">People</a></li><li><a href="#">Services</a></li>
<li class="header__list<?php active__page($page__mainbase.'blog.php', $class__name); ?>"> 
    <a href="blog.php?page=1">Blog</a>
    
    </li><li><a href="#">Contact</a></li>
<?php if(!isset($_SESSION['id'])){?><li><a href="#" onclick="popUp(event, 'gridweb__admin')">Log in</a></li>
   <?php }else{ ?> <a href="in.php?logout">Log Out</a> <?php } ?>
</ul></nav></header>
<?php  } ?>
   
<?php if(!isset($_SESSION['id'])){ 

    if(!isset($_SESSION["login_token"])){
        $_SESSION["login_token"] = admin__csrf__token(30);
    }
    $login__token = hash_hmac("sha256", "This is login csrf token", $_SESSION["login_token"], false);
    ?>
 <section id="gridweb__admin">

  <form class="admin__container" action="./in.php" method="POST">
  <input type="hidden" name="login__token" value="<?php echo $login__token; ?>">
  <i class="fas fa-times time__icon" onclick="popUp(event, 'gridweb__admin')"></i>
    <h1 class="web_title">Login</h1>
    <div class="admin__input username">

    <input onchange="checkThisInput(event, 'username')" class="basic__input"  autocomplete="off" 
    required type="email" id="username" name="username" placeholder="Username">
    </div>
    <div class="admin__input password">
        <input onchange="checkThisInput(event, 'password')" class="basic__input"  autocomplete="off"
         required type="password" id="password" name="userpassword" placeholder="Password">
      <span id="hide_show"><i class="far fa-eye-slash eye_ind"></i></span>
    </div>
    <div class="remember__me_btn">
    <input onclick="makeCheck(event)" type="checkbox" id="remember__me" name="rememberme" value="">
    <label class="rem_label" for="remember__me">Remember Me</label>
    </div>
    <button type="submit" class="login__button" name="loginbtn">Log In</button>
    </form>

    </div></section> 

    <?php } ?>

<?php

if(isset($_SESSION['id'])){
    include 'csrftoken.php';
    }
    

?>
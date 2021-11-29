<?php 
session_start();
require_once('../ooprequirements.php');
include_once('../function.arrange.php');
session__checking();
$user__status;
//http://localhost/gridweb/admin/index.php/sdfsdf-dsfdsf-sdfsdf
if(isset($_SESSION['type_of_user'])){
    $user__status = $_SESSION['type_of_user'];
        if($user__status == "superadmin" || $user__status == "admin"){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" type="text/css">

    <!-- <link rel="stylesheet" href="http://localhost/gridweb/admin/css/style.css" type="text/css"> -->

    <link rel="stylesheet" href="../icon/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/gallery.css" type="text/css">
    <title>Admin Panel</title>
</head>
<body id="adminBody">
    <header class="header__admin">
    <span class="menu__icon"><i class="fas fa-bars"></i></span>
    </header>
    <nav class="admin__nav">
    <?php $path_mainbase = '/gridweb/admin/'; $className = 'active__pageadmin'; ?>
    <ul class="admin__menu">
    <li class="sidebar__list<?php active__page($path_mainbase.'index.php', $className); ?>" ><a href="http://localhost/gridweb/admin/"><span class="dash--icon"><i class="fas fa-tachometer-alt"></i></span>Dashboard</a></li>
    <li id="dropdown__listparent"><button onclick="dropDownMaker('post_drop_down')" class="posts_li toggle__post-button"><span class="dash--icon"><i class="fas fa-mail-bulk"></i></span>Posts<i class="fas fa-caret-down"></i></button>
       <ul class="post_drop_down">

           <li class="sidebar__list<?php active__page($path_mainbase.'addpost.php', $className); ?>" ><a href="addpost.php">Add New</a></li>
           <li class="sidebar__list<?php active__page($path_mainbase.'allpost.php', $className); ?>" ><a href="allpost.php">All Posts</a></li>
           <li class="sidebar__list<?php active__page($path_mainbase.'editpost.php', $className);
           active__page($path_mainbase.'edit.php', $className); ?>" ><a href="editpost.php">Edit Posts</a></li>
           <li class="sidebar__list<?php active__page($path_mainbase.'categories.php', $className); ?>" ><a href="categories.php">Categories</a></li>
           <li class="sidebar__list<?php active__page($path_mainbase.'tags.php', $className); ?>" ><a href="tags.php">Tags</a></li>

       </ul>

   </li>
   <li class="sidebar__list<?php active__page($path_mainbase.'gallery.php', $className); ?>" ><a href="gallery.php"><span class="dash--icon"><i class="fab fa-envira"></i></span>Gallery</a></li>
    <li class="sidebar__list<?php active__page($path_mainbase.'comment_details.php', $className); ?>" ><a href="comment_details.php"><span class="dash--icon"><i class="far fa-comment-alt"></i></span>Comments</a></li>
    <li  class="sidebar__list<?php active__page($path_mainbase.'content.php', $className); ?>" ><a href="content.php"><span class="dash--icon"><i class="fas fa-chalkboard"></i></span>State</a>

   </li>
    </li>
    <li><a class="logout__btn" href="../in.php?logout">Logout</a></li>
    </ul>
    </nav>
    <?php require_once("./admincsrf.php"); ?>
  <?php  }else{ 

  $warnning__text  = "Sorry Dear this page isn't available for you!";
   adminCheck($warnning__text);
   
   }}else{ 
   $warnning__text  = "You are not logged in!";
   adminCheck($warnning__text);
   ?>
   


 <?php } ?>

<?php

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';


?>
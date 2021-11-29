<?php

if(!isset($_SESSION['csrf__for_admin'])){
    $_SESSION['csrf__for_admin'] = admin__csrf__token(30);
  }
  $csrf_admin_generator = hash_hmac('sha256', $_SESSION['id'], $_SESSION['csrf__for_admin'] ,false);

  if(!isset($_SESSION['admin_edit_post'])){
    $_SESSION['admin_edit_post'] = admin__csrf__token(24);
  }
  $csrf_admin_generator_for_edit_post = hash_hmac('sha256', $_SESSION['id'], $_SESSION['admin_edit_post'] ,false);

  if(!isset($_SESSION['add_category_token'])){
    $_SESSION['add_category_token'] = admin__csrf__token(16);
  }
  $csrf_admin_generator_for_category__adding = hash_hmac('sha256', $_SESSION['id'], $_SESSION['add_category_token'] ,false);
  
  if(!isset($_SESSION["subtitle_csrf"])){
    $_SESSION["subtitle_csrf"] = admin__csrf__token(12);
  }

  $csrf_admin_generator_for_site_titles= hash_hmac('sha256', $_SESSION['id'], $_SESSION["subtitle_csrf"] ,false);

  if(!isset($_SESSION["category_editing__token"])){
    $_SESSION["category_editing__token"] = admin__csrf__token(14);
  }
  $csrf__protection__for__category_editing =  hash_hmac('sha256', $_SESSION['id'], $_SESSION["category_editing__token"] ,false);
<?php
session_start();
require_once('ooprequirements.php');
include_once('function.arrange.php');


//all method start here
if(isset($_GET['post'])){
    $blog = $_GET['post'];
    
    //view method call
        $viewValue = 1;
        $cntr_obj6 = new Mastercntr();
        $cntr_obj6->views($blog, $viewValue);
    
        header("location: descriptionblog.php?post=$blog"); 


    
//content updating
}elseif(isset($_REQUEST['registerbutton'])){
    if(!isset($_SESSION["id"]) && !isset($_SESSION["User_Namee"])){

        $signup__csrftoken = hash_hmac("sha256", "This token is for signup form to add you",
           $_SESSION["signup__token"],false);

        if (hash_equals($signup__csrftoken, $_REQUEST['signup__token'])) {

            $First_Name = htmlentities($_REQUEST["First_Name"]);
            $Last_Name = htmlentities($_REQUEST["Last_Name"]);
            $User_Gender = $_REQUEST['gender'];
            $User_Namee = htmlentities(strtolower($_REQUEST['User_Namee']));
            $user_normal_password = htmlentities($_REQUEST["User_Password"]);
            $User_Password = sha1(md5(htmlentities($_REQUEST["User_Password"])));
            $confirm_Password = sha1(md5(htmlentities($_REQUEST["confirm_Password"])));
            $user_token = sha1(md5($User_Namee)).$User_Password;
            $rememberme = $_REQUEST["rememberme"];
  
            user_registration($First_Name, $Last_Name, $User_Gender, $User_Namee,
            $user_normal_password, $User_Password, $confirm_Password, $user_token, $rememberme);
  
        }else{
            header("location: ./register.php?register_submit = rejected"); 
    }
    }else {
        header("location: http://localhost/gridweb/?You are already logged in");
    }


      }elseif(isset($_REQUEST['loginbtn'])){
            
        if (!isset($_SESSION['id']) && !isset($_SESSION['User_Namee'])) {

        $check_login__token = hash_hmac("sha256", "This is login csrf token", $_SESSION["login_token"], false);
        if (hash_equals($check_login__token, $_REQUEST["login__token"])) {
        
        $user_token = sha1(md5(htmlentities(strtolower($_REQUEST['username'])))).sha1(md5(htmlentities($_REQUEST['userpassword'])));
        $rememberme = $_REQUEST["rememberme"];
            
        user_login_function($user_token);
        store_user_cookie($rememberme, $user_token);
            
        if(isset($_SESSION['id'])){
             header("location: profile.php?id=".$_SESSION['id']);
        }else{
            
          //updating the csrf key which is stored in session varriable
         $_SESSION["login_token"] = admin__csrf__token(30);
         header("location: http://localhost/gridweb/?Username and password are not matched");
         }
         }else {
                header("location: http://localhost/gridweb/?login = rejected");
            }
        }else {
            header("location: http://localhost/gridweb/?login = already");
        }


    }elseif(isset($_REQUEST['token'])){
          $token = $_REQUEST['token'];
          $rememberme = $_REQUEST['rememberme'];

          user_login_function($token);
          store_user_cookie($rememberme, $token);
          header("location: profile.php?id=".$_SESSION['id']);

    }elseif(isset($_GET['logout'])){

          setcookie('Gridweb_user', $session_value['security_token'], time() - (86400 * 180));
          session_unset();
          session_destroy();
          
          header('location: http://localhost/gridweb/?logout_successful');
    }else{
    header('location: http://localhost/gridweb/?wrong_idea');
    
}


 
<?php require_once('header.php'); 

if(!isset($_SESSION["id"])){ 
    if(!isset($_SESSION["signup__token"])){
        $_SESSION["signup__token"] = admin__csrf__token(64);
    }
    $signup__csrftoken = hash_hmac("sha256", "This token is for signup form to add you",
    $_SESSION["signup__token"],false);
    ?>

<!-----------Contact Section Start------------------>
<section class="contact" style="margin-top: 80px;">
    <h1 class="service__section--heading blog---heading">Register</h1>
    <p class="service__section_sammarry blog--sammarry">You can easily Register from here</p>
    <div class="contact__div">
        <form action="in.php" method="POST">
        <?php
        //This field is private and it's not permitted to type from user.
        //signup__csrftoken token is helpful to prevent random csrf attack.
        ?>
        
        <input type="hidden" name="signup__token" value="<?php echo $signup__csrftoken; ?>">
        <div class="attachment--input">
            <input name="First_Name" type="text" class="Text__name" placeholder="First Name" autocomplete="off" required >
            <input name="Last_Name" type="text" class="Text__name" placeholder="Last Name" autocomplete="off" required >
        </div>
        <div class="gender_container" style="width: 61%;margin: 1em auto;">
   <label class="container">Male
  <input type="radio" checked="checked" name="gender" value="Male">
  <span class="checkmark"></span>
</label>
<label class="container">Female
  <input type="radio" name="gender" value="Female">
  <span class="checkmark"></span>
</label>
<label class="container">Other
  <input type="radio" name="gender" value="Other">
  <span class="checkmark"></span>
</label>
   </div>
        <div class="email__div">
            <input name="User_Namee" type="email" class="email--input" placeholder="Username" autocomplete="off" required>
        </div>
  
        <div class="email__div">
            <input name="User_Password" type="password" class="email--input" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="email__div">
            <input name="confirm_Password" type="password" class="email--input" placeholder="Confirm Password" autocomplete="off" required>
        </div>
        <label class="container remember">Remember me
      <input id="logged_or__not" type="checkbox" name="rememberme" value="">
      <span id="lets_logged_in" class="checkmark"></span>
       </label>
  
        <button name="registerbutton" style="cursor:pointer" class="btn btn-contact" type="submit">Next</button>

    </form>

    
    <p style='text-align:center;margin-top:10px;'>Already Have An Account
    <a href="http://localhost/gridweb/#login"> Click Here</a></p>
    </div>
</section>

<!-----------Contact Section End------------------>
<?php require_once('footer.php'); ?>
<?php }else{
    header('location: http://localhost/gridweb/?You are already logged in!');
} ?>
<?php
// session_start();
include 'header.php';
?>


<div class="people_container">
<h1 class="people_heading">You can find people over here</h1>
       <div class="people__mini-container">
          <?php
          
          $msterview_object = new Masterview();
          foreach ($msterview_object->selectcmnt('users') as $key => $user) { 
              $user_id = $user['id'];
              $user_gender = $user['User_Gender'];
              ?>
              
           <div class="people">
           <div class="people_profile_pic">
                       <a href="profile.php?id=<?php echo $user_id; ?>" class="people_profile_link">
                       <img src="<?php show_profile_picture($user_id); ?>" alt="sdfsdf" class="profile_shortcurt_image people_pro">
                       </a>
                   </div>
               <div class="people_name" data-id="<?php echo $user_id; ?>">
                   <h3 class="people_actualname">
                      <a href="profile.php?id=<?php echo $user_id; ?>" class="people_profile_link link">
                      <?php echo $user['First_Name'].' '.$user['Last_Name']; ?>
                      </a> 
                   </h3>
               </div>
               <div class="action">
                   <a href="" class="follow_btn">
                   <i class="fas fa-plus"></i>
                   </a>
               </div>
           </div>
         

           <?php  } ?>

 
</div>
</div>


<?php
include 'footer.php';
?>


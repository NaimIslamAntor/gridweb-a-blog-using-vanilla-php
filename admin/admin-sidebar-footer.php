<script src="./js/alternativeadmin.js"></script>
<?php
if(isset($user__status)){
    if($user__status == "superadmin" || $user__status == "admin"){ ?>

<script src="../js/admin.js"></script>
<script src="./editor/ckeditor/ckeditor.js"></script>
<script src="./js/categories.js"></script>
<script>CKEDITOR.replace( 'editor' );</script>
<script src="./js/editpost.js"></script>

</body>
</html>
<?php  } } ?>
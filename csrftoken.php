<?php

    if(!isset($_SESSION["upload__profile__and__cover"])){
        $_SESSION["upload__profile__and__cover"] = admin__csrf__token(64);
      }
      $ucsrfdata = "upload your profile pictures and cover pictures";
    $upload__token = hash_hmac("sha256", $ucsrfdata, $_SESSION["upload__profile__and__cover"],false);
    
    if(!isset($_SESSION["commentcsrf__token"])){
        $_SESSION["commentcsrf__token"] = admin__csrf__token(32);
    }
     $data_for_commentscsrf = "KEep caLm and POsT ComMenTs";
    $csrftoken__forposting_comments = hash_hmac("sha256", $data_for_commentscsrf, $_SESSION["commentcsrf__token"]);

    if (!isset($_SESSION["reaction__token"])) {
        $_SESSION["reaction__token"] = admin__csrf__token(38);
    }

    $reaction__token = hash_hmac("sha256", 'you can like or dislike', $_SESSION["reaction__token"]);

    ?>
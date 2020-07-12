<?php session_start();?>
<?php include "db.php";?>
<?php include "./admin/functions.php";?>

<?php
echo "Test";

 echo loggedInUserId();

 if(userLikeThisPost(1)){
     echo "User liked it";
 }else{
     echo "Did not like it";
 }


//echo password_hash('secret', PASSWORD_BCRYPT, array('cost'=>10));

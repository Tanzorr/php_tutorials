<?php include "db.php"?>

<?php
    if(isset($_POST['login'])){
        var_dump($_POST);
      $username =  $_POST['username'];
       $password = $_POST['password'];

       $username = mysqli_real_escape_string($connect,$username);
       $password = mysqli_real_escape_string($connect,$password);

       $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

       $select_user_query = mysqli_query($connect, $query);

       if(!$select_user_query){
           die("QUERY FAILED".mysqli_error($connect));
       }

        while ($row = mysqli_fetch_array($select_user_query)){
           echo $db_id =$row['user_id'];
        }

    }



?>

<?php  session_start();?>
<?php include"db.php";?>
<?php

    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);


        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

        $select_user_query = mysqli_query($connect, $query);

        if (!$select_user_query) {
            die("QUERY FAILED" . mysqli_error($connect));
        }

        while ($row = mysqli_fetch_array($select_user_query)) {
            $db_user_id = $row['user_id'];
            $db_user_name = $row['user_name'];
            $db_user_password = $row['user_password'];
            $db_user_first_name = $row['user_first_name'];
            $db_user_last_name = $row['user_last_name'];
            $db_user_role = $row['user_role'];
        }


            if ($username === $db_user_name && password_verify($password, $db_user_password) == 1) {
                $_SESSION['username'] = $db_user_name;
                $_SESSION['firstname'] = $db_user_first_name;
                $_SESSION['lastname'] = $db_user_last_name;
                $_SESSION['user_role'] = $db_user_role;
                header("Location:../admin");
            } else {
                header("Location:../index.php");

            }
    }





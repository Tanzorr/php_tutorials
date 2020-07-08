<?php

function escape($string){
    global $connect;
    return mysqli_real_escape_string($connect, trim($string));
}
function confirm($result){
    global  $connect;
    if(!$result){
        die('QUERY FAILED'.mysqli_error($connect));
    }
}
function redirect($location){
    header("Location:".$location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']===strtoupper($method)){
        return true;
    }
    return  false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return  false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}


function users_online(){
    if (isset($_GET['onlineusers'])){
        global $connect;
        if (!$connect){
            session_start();
            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;
            $query ="SELECT * FROM users_online WHERE session ='$session'";
            $send_query = mysqli_query($connect, $query);
            $count = mysqli_num_rows($send_query);
            if ($count ==NULL){
                mysqli_query($connect, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            }else{
                mysqli_query($connect, "UPDATE users_online SET time = '$time' WHERE  session = '$session'");
            }
            $users_onlline = mysqli_query($connect, "SELECT * FROM users_online WHERE  time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_onlline);
        }


    }//get request isset


}
users_online();



function insert_categories(){
    global $connect;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title =="" || empty($cat_title)){
            echo "Theis field should not be empty";
        }else{
            $stmt = mysqli_prepare( $connect,"INSERT INTO categories(cat_name) VALUE (?)");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            mysqli_stmt_execute($stmt);
            if(!$stmt){
                die('QUERY FAILED'.mysqli_error($connect));
            }

        }
        mysqli_stmt_close($stmt);
    }
}

function findAllCategories(){
    global $connect;
    $query = "SELECT * FROM categories";
    $select_categories=
        mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_categories)){
        $cat_id =$row['cat_id'];
        $cat_title = $row['cat_name'];
        echo "<tr>";
        echo "<td>{$row['cat_id']}</td>";
        echo"<td>{$cat_title}</td>";
        echo"<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo"<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $connect;
    if (isset($_GET['delete'])){
        echo  $the_cat_id=$_GET['delete'];
        $query= "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connect,$query );
        header("Location:categories.php");
    }
}

function recordCount($table){
   global $connect;
    $query = "SELECT * FROM $table";
    $select_all_post = mysqli_query($connect,$query);
    $result = mysqli_num_rows($select_all_post);
    confirm($result);
    return $result;
}

function checkStatus($table, $column, $status){
    global $connect;
    $query = "SELECT * FROM $table WHERE $column = '{$status}'";
    $result = mysqli_query($connect,$query);
    confirm($result);
    return  mysqli_num_rows($result);
}

function is_admin($username = ''){
    global $connect;
    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connect, $query);
    confirm($result);
    $row  = mysqli_fetch_array($result);
    if($row['user_role']=='admin'){
        return true;
    }else{
        return false;
    }
}

function email_exists($email){
    global $connect;
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connect, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {

        return false;

    }
}

function is_exist($value,$philds, $table){
    global  $connect;
    $query = "SELECT $philds FROM $table WHERE $philds = '{$value}'";
    $result = mysqli_query($connect, $query);
    confirm($result);
    $row = mysqli_num_rows($result);

    if ($row>0){
        return true;
    }else{
        return false;
    }
}



function register_user($username, $email, $password){
    global $connect;
    if(is_exist($username,"user_name","users")){
            $message ="User ".$username." exists";
        }else{
            $username = mysqli_real_escape_string($connect,$username);
            $email =  mysqli_real_escape_string($connect,$email);
            $password =  mysqli_real_escape_string($connect,$password);
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>10));
                $query = "INSERT INTO `users`( `user_name`, `user_password`, `user_email`, `user_role`) 
                      VALUES ('{$username}','{$password}','{$email}','subscriber')";
                $register_user_query = mysqli_query($connect,$query);
                confirm($register_user_query);
        }
}

function login_user($username, $password){
    global  $connect;
    $username =trim($username);
    $password =trim($password);
    $username = mysqli_real_escape_string($connect, $username);
    $password = mysqli_real_escape_string($connect, $password);
    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $select_user_query = mysqli_query($connect, $query);
     confirm($select_user_query);
    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_password = $row['user_password'];
        $db_user_first_name = $row['user_first_name'];
        $db_user_last_name = $row['user_last_name'];
        $db_user_role = $row['user_role'];

        if ($username === $db_user_name && password_verify($password, $db_user_password) == 1) {
            $_SESSION['username'] = $db_user_name;
            $_SESSION['firstname'] = $db_user_first_name;
            $_SESSION['lastname'] = $db_user_last_name;
            $_SESSION['user_role'] = $db_user_role;
            // var_dump($_SESSION);
            redirect("/cms2/admin");
        } else {
            return false;
        }
    }
    return  true;
}


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
            $query = "INSERT INTO categories(cat_name)";
            $query.="VALUE('$cat_title')";
            $create_category_query = mysqli_query($connect,$query);

            if(!$create_category_query){
                die('QUERY FAILED'.mysqli_error($connect));
            }
        }
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
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connect, $query);
    confirm($result);
    $row  = mysqli_fetch_array($result);
    if($row['user_role']=='admin'){
        return true;
    }else{
        return false;
    }
}

<?php

function confirm($result){
    global  $connect;
    if(!$result){
        die('QUERY FAILED'.mysqli_error($connect));
    }

}











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


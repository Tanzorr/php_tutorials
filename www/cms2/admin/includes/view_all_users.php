<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>id</td>
        <td>UserName</td>
        <td>FirstName</td>
        <td>LastName</td>
        <td>Email</td>
        <td>Image</td>
        <td>Role</td>

    </tr>
    </thead>
    <tbody>
    <?php

    $query = "SELECT * FROM users";
    $select_users=
        mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];



        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_first_name}</td>";


//        $query = "SELECT * FROM categories WHERE  cat_id ={$post_category_id}";
//        $select_categories_id = mysqli_query($connect,$query);
//
//        confirm($select_categories_id);
//
//        while ($row = mysqli_fetch_assoc($select_categories_id)){
//           $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_name'];
//            echo "<td>{$cat_title}</td>";
//        }

        echo "<td>{$user_last_name}</td>";
        echo "<td>{$user_email}</td>";
//
//        $query ="SELECT * FROM posts WHERE post_id = $comment_post_id";
//        $select_pst_id_query = mysqli_query($connect,$query);
//        confirm($select_pst_id_query);
//        while ($row = mysqli_fetch_assoc($select_pst_id_query)){
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//        }
        echo "<td>{$user_image}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
       echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
       echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
       ?>
        <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $user_id; ?>">
       <?php
       echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
       ?>
        </form>
       <?php
        echo "</tr>";

    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role ='admin' WHERE user_id =$the_user_id";
    $change_to_admin_query =mysqli_query($connect,$query);
    header("Location:users.php");
}

if (isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role ='subscriber' WHERE user_id =$the_user_id";
    $change_to_subscriber_query =mysqli_query($connect,$query);
    header("Location:users.php");
}


if (isset($_GET['delete'])){
    if (isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
            $the_user_id = mysqli_real_escape_string($connect,$_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_query =mysqli_query($connect,$query);
            header("Location:users.php");
        }

    }

}


?>
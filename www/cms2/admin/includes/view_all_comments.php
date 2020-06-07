<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <td>id</td>
        <td>Author</td>
        <td>Comment</td>
        <td>Email</td>
        <td>Status</td>
        <td>In Responce to</td>
        <td>Date</td>
        <td>Approve</td>
        <td>Unaapprove</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>
    <?php

    $query = "SELECT * FROM comments";
    $select_comments=
        mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_emeil = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];



        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";


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



        echo "<td>{$comment_emeil}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td>Some Title</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id='>Approve</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id='>Unaprrove</a></td>";
        echo "<td><a href='posts.php?delete='>Delete</a></td>";
        echo "</tr>";

    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query =mysqli_query($connect,$query);
}


?>
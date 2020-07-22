<?php
    if (isset($_POST['checkBoxArray'])){
            foreach($_POST['checkBoxArray'] as $postValueId){
              echo  $bulk_options = $_POST['bulk_options'];
                switch ($bulk_options){
                    case 'published':
                        $query = " UPDATE posts SET post_status = '{$bulk_options}'
                            WHERE post_id = '{$postValueId}' ";
                        $update_to_published_status = mysqli_query($connect,$query);
                       confirm($update_to_published_status);

                        break;

                    case 'draft':
                        $query = " UPDATE posts SET post_status = '{$bulk_options}'
                            WHERE post_id = '{$postValueId}' ";
                        $update_to_published_status = mysqli_query($connect,$query);
                        confirm($update_to_published_status);
                        break;

                    case 'clone':
                        $query = "SELECT * FROM posts WHERE post_id= '{$postValueId}'";
                        $select_posts=
                            mysqli_query($connect, $query);
                        confirm($select_posts);
                        while ($row = mysqli_fetch_assoc($select_posts)) {
                            $post_id = $row['post_id'];
                            $post_author = $row['post_author'];
                            $post_title = $row['post_title'];
                            $post_category_id = $row['post_category_id'];
                            $post_content = $row['post_content'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_comments_count = $row['post_comments_count'];
                            $post_date = $row['post_date'];
                            $post_view_count = $row['post_view_count'];
                        }
                        $query = "INSERT INTO `posts`( `post_category_id`, `post_title`, `post_author`, `post_image`,
                                       `post_content`, `post_date`, `post_tags`, `post_status`)
                          VALUES ({$post_category_id},'{$post_title}','{$post_author}','{$post_image}','{$post_content}',
                          '{$post_date}','{$post_tags}','{$post_status}')";
                                    $create_post_query = mysqli_query($connect, $query);
                                    confirm($create_post_query);
                        break;

                    case 'delete':
                        $query = " DELETE FROM posts  WHERE post_id = '{$postValueId}' ";
                        $update_to_published_status = mysqli_query($connect,$query);
                        confirm($update_to_published_status);
                        break;
                }

            }
    }

?>
<?php include("delite_modal.php");?>
<form action="" method="post">
    <table class="table table-bordered table-hover">

            <div id="bulkOptionsContainer">
                <div class="row">
                    <div class="col-lg-2 col-xs-8">
                        <select name="bulk_options" id="">
                            <option value="">Select Options</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="clone">Clone</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-xs-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                        <a href="./posts.php?source=add_post" class="btn btn-primary">Add New</a>
                    </div>

                </div>
            </div>



    <thead>
    <tr>
        <td><input id="selectAllboxes" type="checkbox"></td>
        <td>id</td>
        <td>Users</td>
        <td>Title</td>
        <td>Category</td>
        <td>Status</td>
        <td>Image</td>
        <td>Tags</td>
        <td>Comments</td>
        <td>Status</td>
        <td>View Count</td>
        <td>Date</td>
        <td>View</td>
        <td>Edit</td>
        <td>Delete</td>

    </tr>
    </thead>
    <tbody>
    <?php

    $query = "SELECT * FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
    $select_posts=
        mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        if(!$post_author){
            $post_author =$post_user;
        }
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments_count = $row['post_comments_count'];
        $post_date = $row['post_date'];
        $post_view_count = $row['post_views_count'];
        $cat_title = $row['cat_title'];
        echo "<tr>";?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'
            value='<?php echo $post_id;?>'></td>
        <?php
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";
        $cat_title = $row['cat_name'];
            echo "<td>{$cat_title}</td>";
            echo "<td>{$post_status}</td>";
        echo "<td><img src='../images/{$post_image}' width='100' alt='{$post_image}'/></td>";
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id =$post_id";
        $comment_count_query =mysqli_query($connect,$query);
        $row = mysqli_fetch_array($comment_count_query);
        $comment_id = $row['comment_id'];
        $count_comment = mysqli_num_rows($comment_count_query);
        echo "<td><a href='post_comments.php?id=$post_id'>{$count_comment}</a></td>";
        echo "<td>{$post_status}</td>";
        echo "<td><a href='posts.php?reset=$post_id'>{$post_view_count}</a></td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a class='btn btn-success' href='../post.php?p_id={$post_id}'>View</a></td>";
        echo "<td><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        ?>
        <form method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <?php
            echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
            ?>
        </form>
        <?php
       // echo "<td><a onclick=\" javascript: return confirm('Are you shoure you whan to delete')\" href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "</tr>";

    }
    ?>
    </tbody>
</table>
</form>

<?php
if (isset($_POST['delete'])){
    $the_post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query =mysqli_query($connect,$query);
    header('Location: posts.php');
}

if (isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count =0 WHERE post_id = {$the_post_id}";
    $reset_query =mysqli_query($connect,$query);
    header('Location: posts.php');
}


?>

<script>
    $(document).ready(function () {
       $(".delete_link").on("click", function () {
           let id = $(this).attr("rel")
          let  delete_url = `posts.php?delete=${id}`;
           $(".modal_delete_link").attr("href",delete_url);
           $("#myModal").modal('show')
       })
    })
</script

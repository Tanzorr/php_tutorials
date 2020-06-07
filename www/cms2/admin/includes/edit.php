<?php

if (isset($_GET['p_id'])){
 $the_post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts=
    mysqli_query($connect, $query);
while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_content =$row['post_content'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comments_count = $row['post_comments_count'];
    $post_date = $row['post_date'];


  }
    if(isset($_POST['update'])){

        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id']=1;

        $post_image =$_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content =$_POST['post_content'];
        $post_tags =$_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_date = date('d-m-y');
        $post_comment_count =4;

        move_uploaded_file($post_image_temp,"../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

            $select_image = mysqli_query($connect,$query);
            while ($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }

        }


        $query = "UPDATE `posts` SET 
                        `post_category_id`={$post_category_id},
                        `post_title`='{$post_title}',
                        `post_author`='{$post_author}',
                        `post_image`='{$post_image}',
                        `post_content`='{$post_content}',
                        `post_date`='{$post_date}',
                         `post_tags`='{$post_tags}',
                          `post_comments_count`=$post_comment_count,
                         `post_status`='{$post_status}'
                         WHERE post_id = $the_post_id";
    }

    $update_post = mysqli_query($connect, $query);

    confirm($update_post);
}
?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $post_title;?>"  name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category" id="" >

                        <?php

                        $query = "SELECT * FROM `categories`";
                        $select_categories = mysqli_query($connect,$query);


                        confirm($select_categories);

                        while($row = mysqli_fetch_assoc($select_categories )) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_name'];


                            echo "<option value='$cat_id'>{$cat_title}</option>";


                        }
                        ?>


        </select>

    </div>


    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">

            <!--            --><?php
            //
            //            $users_query = "SELECT * FROM users";
            //            $select_users = mysqli_query($connection,$users_query);
            //
            //            confirmQuery($select_users);
            //
            //
            //            while($row = mysqli_fetch_assoc($select_users)) {
            //                $user_id = $row['user_id'];
            //                $username = $row['username'];
            //
            //
            //                echo "<option value='{$username}'>{$username}</option>";
            //
            //
            //            }
            //
            //            ?>


        </select>

    </div>





<!--     <div class="form-group">-->
<!--       <label for="title">Post Author</label>-->
<!--        <input type="text" value="--><?php //echo $post_author;?><!--"class="form-control" name="author" >-->
<!--    </div>-->



    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        <img width="100" src="../images/<?php echo $post_image;?>"  atl="<?php echo $post_image;?>"">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" value="<?php echo $post_tags;?>" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content" id="body" cols="30" rows="10">
         <?php echo $post_content;?>
        </textarea>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Publish Post">
    </div>


</form>



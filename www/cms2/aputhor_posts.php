<?php  include "./includes/db.php";
session_start();
error_reporting(E_ALL);
?>

<?php  include "./includes/header.php"?>


    <!-- Navigation -->
<?php include "./includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div class="article">
                <h1 class="page-header">
                    By <?php echo $_GET['author'];?>
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php


                if (isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];
                }



                $query = "SELECT * FROM posts WHERE post_author ='{$the_post_author}'";
                $select_posts_query = mysqli_query($connect, $query);
                if(!$select_posts_query){
                    die('QUERY FAILED'.mysqli_error($connect));
                }


                while ($row = mysqli_fetch_assoc($select_posts_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];


                    ?>
                    <h2>
                        <a href="#"><?php  echo $post_title; ?></a>
                    </h2>

                    <p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                    <hr>
                    <p><?php  echo $post_content; ?></p>

                <?php   }

                ?>
            </div>

            <hr>
            <!-- Comments Form -->
            <?php
            if(isset($_POST['create_comment'])){
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                    $query = "INSERT INTO `comments`( `comment_post_id`, `comment_author`, `comment_email`, 
                                                     `comment_content`, `comment_date`, `comment_status`)
                               VALUES ( {$the_post_id}, '{$comment_author}' ,'{$comment_email}' ,'{$comment_content}'
                                            ,now(),'approved' )";
                    $create_comments = mysqli_query($connect,$query);

                    if(!$create_comments){
                        die('QUERY FAILED'.mysqli_error($connect));
                    }


                    $query ="UPDATE posts SET post_comments_count = post_comments_count+1 
                             WHERE post_id =  $the_post_id";
                    $update_comments_count = mysqli_query($connect,$query);
                    if(!$update_comments_count){
                        die('QUERY FAILED'.mysqli_error($connect));
                    }

                }else{
                    echo "<script>alert('Fields cnanot be empty')</script>";
                }



            }

            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"?>
    </div>




    <!-- /.row -->
    <!-- Footer -->

<?php include "./includes/footer.php"?>
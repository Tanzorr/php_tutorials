<?php  include "./includes/db.php";
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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                if (isset($_GET['p_id'])){
                    echo $the_post_id = $_GET['p_id'];
                }



                $query = "SELECT * FROM posts WHERE post_id ={$the_post_id}";
                $slect_all_posts_query = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_assoc($slect_all_posts_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];


                    ?>
                    <h2>
                        <a href="#"><?php  echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php  echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php  echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                    <hr>
                    <p><?php  echo $post_content; ?></p>
                    <a class="btn btn-primary mb-5" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
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

                    $query = "INSERT INTO `comments`( 
                                                     `comment_post_id`,
                                                    `comment_author`, 
                                                    `comment_email`, 
                                                    `comment_content`,
                                                     `comment_date`, 
                                                     `comment_status`) 
                                                      VALUES (
                                                      $the_post_id,
                                                      '{$comment_author}'
                                                      ,'{$comment_email}'
                                                      ,'{$comment_content}'
                                                      ,now()
                                                      ,'unapproved'
                                                      )";
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

            }

            ?>

                    <div class="well comment_form">

                        <h4>Leave a Comment:</h4>
                        <form action="#" method="post" role="form">

                            <div class="form-group">
                                <label for="Author">Author</label>
                                <input type="text" name="comment_author" class="form-control" name="comment_author">
                            </div>

                            <div class="form-group">
                                <label for="Author">Email</label>
                                <input type="email" name="comment_email" class="form-control" name="comment_email">
                            </div>

                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>



            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <?php


            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} 
               AND comment_status = 'approved'
                ORDER BY comment_id DESC";
            $select_comments=
                mysqli_query($connect, $query);

            if(!$select_comments){
                die('QUERY FAILED'.mysqli_error($connect));
            }

            while ($row = mysqli_fetch_assoc($select_comments)) {

                $comment_author = $row['comment_author'];

                $comment_content = $row['comment_content'];

                $comment_date = $row['comment_date'];?>


          <?php  //}
            ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content ?>
                </div>
            </div>
            <?php } ?>
                </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"?>
       </div>




    <!-- /.row -->
    <!-- Footer -->

<?php include "./includes/footer.php"?>
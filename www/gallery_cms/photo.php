<?php include("includes/header.php"); ?>
<?php
if (empty($_GET['id'])){
    redirect("index.php");
}
$photo=  Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {
   $author = trim($_POST['author']);
   $body =  trim($_POST['body']);
   $new_comment = Comment::create_comment($photo->id, $author, $body);
   if ($new_comment && $new_comment->save()){

       redirect("photo.php?id={$photo->id}");
   }else{
       $message = "The was some problems saving";
   }
}else{
    $author ="";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);
?>


<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path();?>" alt="">

                <hr>

                <!-- Post Content -->
                <p>
                    <?php echo $photo->description;?>
                </p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author </label>
                            <input type="text" class="form-control" name="author"/>
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                foreach ($comments as $comment){
                    ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author;?></h4>
                       <?php echo $comment->body;?>
                    </div>
                </div>

               <?php }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <?php include("includes/sidebar.php"); ?>

            </div>

        </div>
        <!-- /.row -->

<?php include("includes/footer.php"); ?>